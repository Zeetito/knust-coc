<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use App\Models\Semester;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class AttendanceController extends Controller
{
    //   INDEX
    public function index()
    {
        //
        $attendances = Semester::active_semester()->attendance_sessions->sortBy('semester_program_id');
        // $attendances = Semester::active_semester()->sortBy('semester_program_id') latest()->paginate(
        //     $perPage = 5, $columns = ['*'], $pageName = 'AttendanceSessions'
        // );

        // Query for meetings that are active
        return view('attendance.index', ['attendances' => $attendances]);
    }

    // CREATE
    public function create()
    {
        //
    }

    // STORE
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'semester_program_id' => ['required'],
        ]);

        $validated['semester_id'] = Semester::active_semester()->id;

        Attendance::create($validated);

        return redirect(route('attendance'))->with('success','Attendance Session Created Successfully');

    }

    // USERS
    // Show member present for a particular attendance session
    public function show_attendance_users(Attendance $attendance)
    {
        //
        $members = $attendance->users()->paginate(
            $perPage = 50, $columns = ['*'], $pageName = 'AttendanceSessions'
        );

        return view('attendance.attendance-users.show', ['attendance' => $attendance, 'members' => $members]);
    }

    // Check or uncheck User
    public function check_user(Attendance $attendance, User $user)
    {

        DB::table('attendance_users')->insertOrIgnore([
            'attendance_id' => $attendance->id,
            'person_id' => $user->id,
            'is_user' => 1,
            'checked_by' => Auth::user()->id,
        ]);

        return view('attendance.attendance-users.components.users.updated-row', ['member' => $user, 'attendance' => $attendance]);
    }

    // Check or uncheck User
    public function uncheck_user(Attendance $attendance, User $user)
    {
        DB::table('attendance_users')
            ->where('attendance_id', $attendance->id)
            ->where('person_id', $user->id)
            ->where('is_user', 1)
            ->delete();

        return redirect()->back()->with('success', 'Uncheck Successful');
    }

    // Confirm User Uncheck
    public function confirm_uncheck_user(Attendance $attendance, User $user)
    {

        return view('attendance.attendance-users.components.checked-users.confirm-uncheck-user', ['member' => $user, 'attendance' => $attendance]);
    }

    // Search Users who've been checked already
    public function search_attendance_checked_users(Request $request, Attendance $attendance)
    {
        $members = User::search_user($request)
            ->get()
            ->intersect($attendance->members()->get());

        return view('attendance.attendance-users.components.checked-users.search_results', ['members' => $members, 'attendance' => $attendance]);

    }

    // Search User (marked or unmarked) on attendance table
    public function search_attendance_users(Attendance $attendance, Request $request)
    {

        $members = User::search_user($request)->where('is_member', 1)
            ->paginate($perPage = 25, $columns = ['*'], $pageName = 'SearchResults');

        return view('attendance.attendance-users.components.users.search-results', ['members' => $members, 'attendance' => $attendance]);
    }

    // Register User as Visitor
    public function register_user_visitor(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'numeric'],
        ]);
        DB::table('attendance_users')->insertOrIgnore([
            'attendance_id' => $attendance->id,
            'person_id' => $validated['user_id'],
            'is_user' => 1,
            'checked_by' => Auth::user()->id,
        ]);

        return redirect(route('access_attendance_session', $attendance))->with('success', 'Visitor Added Successfully');

    }

    // Register Guest as Visitor
    public function register_guest_visitor(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'guest_name' => ['required', 'min:6'],
            'guest_gender' => ['required', 'max:1'],
            'is_member' => ['required', 'max:1', 'numeric'],
            'local_congregation' => ['required', 'min:2'],
            'contact' => ['nullable', 'max:13', 'min:10'],
            'purpose' => ['nullable', 'min:4'],
        ]);
        // Create A new Guest instance
        $guest = new Guest;
        $guest['fullname'] = $validated['guest_name'];
        $guest['local_congregation'] = $validated['local_congregation'];
        $guest['is_member'] = $validated['is_member'];
        $guest['gender'] = $validated['guest_gender'];
        $guest['contact'] = $validated['contact'];
        $guest['purpose'] = $validated['purpose'];
        $guest->save();

        // Now, Create the attendance_guest instance
        DB::table('attendance_users')->insertOrIgnore([
            'attendance_id' => $attendance->id,
            'person_id' => $guest->id,
            'is_user' => 0,
            'checked_by' => Auth::user()->id,
        ]);

        return redirect(route('access_attendance_session', $attendance))->with('success', 'Visitor Added Successfully');

    }

    // Uncheck Guest
    public function uncheck_guest_visitor(Attendance $attendance, Guest $guest)
    {
        DB::table('attendance_users')
            ->where('attendance_id', $attendance->id)
            ->where('person_id', $guest->id)
            ->where('is_user', 0)
            ->delete();

        return redirect()->back()->with('success', 'Guest Uncheck Successful');

        // return view('attendance.attendance-users.components.users.updated-row', ['member' => $user, 'attendance' => $attendance]);
    }

    // Confirm Uncheck Guest
    public function confirm_uncheck_guest(Attendance $attendance, Guest $guest)
    {
        return view('attendance.attendance-users.components.guests.confim-guest-uncheck', ['guest' => $guest, 'attendance' => $attendance]);
    }

    // ATTENDANCE SESSION
    // Access the attendance session to check user
    public function access_attendance_session(Attendance $attendance)
    {
        $users = User::where('is_member', 1)
            ->paginate(
                $perPage = 25, $columns = ['*'], $pageName = 'Users'
            );

        return view('attendance.attendance-users.create', ['members' => $users, 'attendance' => $attendance]);
    }

    // Cofirm Attendance Switch/toggle
    public function confirm_attendance_switch(Attendance $attendance)
    {
        return view('attendance.components.attendance.confirm-attendance-switch', ['attendance' => $attendance]);
    }

    // Switch Attendance Session on or off
    public function switch_attendance_session(Attendance $attendance)
    {
        if ($attendance->is_active == 1) {
            $attendance['is_active'] = 0;
            $attendance->save();
        } else {
            $attendance['is_active'] = 1;
            $attendance->save();
        }

        return redirect()->back()->with('success', 'Attendance Switched Successfully');
    }

    // Search Attendance session
    public function search_attendance(Request $request)
    {

        $string = $request->input('str');
        $str = '%'.$string.'%';

        // If the String is not empty
        if (! empty($string)) {
            $attendances = Attendance::where(function (Builder $query) {
                $query->select('name')
                    ->from('meetings')
                    ->whereColumn('meetings.id', 'attendances.meeting_type');
            }, 'like', $str)
                ->orWhere('venue', 'like', $str)
                ->latest()->get();
        } else {

            $attendances = Attendance::latest()->paginate($perPage = 5, $columns = ['*'], $pageName = 'attendances');

        }

        return view('attendance.components.attendance.search-results', ['attendances' => $attendances]);

    }

    // Confirm Attendance Reset
    public function confirm_attendance_reset(Attendance $attendance)
    {
        return view('attendance.components.attendance.confirm-attendance-reset', ['attendance' => $attendance]);
    }

    // Reset Attendance
    public function reset_attendance(Attendance $attendance)
    {
        $new_attendance = $attendance;
        $attendance->delete();
        $new_attendance->save();

        return redirect(route('attendance'))->with('success', 'Attendance Session Reset Successful');
    }

    // Confirm Attendance Delete
    public function confirm_attendance_delete(Attendance $attendance)
    {
        return view('attendance.components.attendance.confirm-attendance-delete', ['attendance' => $attendance]);
    }

    // Reset Attendance
    public function delete_attendance(Attendance $attendance)
    {
        $attendance->delete();

        return redirect(route('attendance'))->with('success', 'Deletion Successful');
    }
}
