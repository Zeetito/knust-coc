<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $attendances = Attendance::latest()->paginate(
            $perPage = 5, $columns = ['*'], $pageName = "AttendanceSessions"
        );
        // Query for meetings that are active
        $meetings = Meeting::where('is_active','=',1)->get()->sortBy('name');
        return view('attendance.index',['attendances'=>$attendances , 'meetings'=>$meetings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'meeting_type'=>['required'],
            'venue' => ['required'],
        ]);

        Attendance::create($validated);
        return redirect(route('attendance'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
        $members = Attendance::find($attendance->id)->members()->paginate(
            $perPage = 50, $columns = ['*'], $pageName = "AttendanceSessions"
        );
        return view('attendance.show',['attendance'=>$attendance , 'members'=>$members]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    // Access the attendance session to check user
    public function access_attendance_session(Attendance $attendance){
        $users = User::paginate(
            $perPage = 25, $columns = ['*'], $pageName = "Users" 
        );

        return view('attendance.attendance-users.create',['members'=>$users, 'attendance'=>$attendance]);
    }

    // Switch Attendance Session
    public function switch_attendance_session(Attendance $attendance){
       if($attendance->is_active == 1){
           $attendance['is_active'] = 0;
           $attendance->save();
           

       }else{
           $attendance['is_active'] = 1;
           $attendance->save();
           
       }

    //    return $attendance->is_active;
       return (view('modals.attendance.updated-row',['attendance'=>$attendance]));
    }


    // Check or uncheck User
    public function check_user(Attendance $attendance, User $user){
        
        // Check if user is already checked or not to know which action to be taken.
        if(auth()->user()->can('update',$user)){

            //    Must Check if user can update that attendance_users instance
                if ($user->is_checked($attendance)){
                    // Uncheck the user here by deleteing the instance
                    DB::table('attendance_users')
                    ->where('attendance_id',$attendance->id)
                    ->where('user_id',$user->id)
                    ->delete();
                    // Return the updated row
                    return view('modals.attendance-users.updated-row',['member'=>$user,'attendance'=>$attendance]);

                }else{
                    // Check the user here
                    DB::table('attendance_users')->insert([
                        'attendance_id' => $attendance->id,
                        'user_id' => $user->id,
                        'checked_by' => Auth::user()->id,
                    ]);
                    return view('modals.attendance-users.updated-row',['member'=>$user,'attendance'=>$attendance]);
                   
                }


            // That code goes here

            // If user Can actually update the instance, then ready to uncheck user

           
            
        }else{

            // Must check if auth user can check the user
              return ("abort");

        }
        // redirect(route('access_attendance_session',$attendance->id))->with('success', $user->firstname.' '.$user->lastname.' Checked');
    }

    // Pop Up model to confirm whether or not to uncheck user
    public function confirm_uncheck_user(Attendance $attendance, User $user){
        
        return view("modals.attendance-users.uncheck-confirmation",['member'=>$user,'attendance'=>$attendance]);
    }

    // Search Attendance session
    public function search_attendance(Request $request){

    $string =  $request->input('str');
    $str = "%".$string."%";

        // If the String is not empty
        if(!empty($string)){
            $attendances = Attendance::where(function (Builder $query) {
                $query->select('name')
                ->from('meetings')
                ->whereColumn('meetings.id', 'attendances.meeting_type')
                ->limit(1);
            }, 'like', $str)->latest()->get();
        }else{
            $attendances = Attendance::latest()->paginate($perPage = 5, $columns = ['*'], $pageName = "attendances" );
            
        }

        return view('modals.attendance.search-results',['attendances'=>$attendances]);        

    }

    // Reset Attendance
    public function reset_attendance(Attendance $attendance){
        $new_attendance = $attendance;
        $attendance->delete();
        $new_attendance->save();
        return(redirect(route('attendance'))->with('success','Attendance Session Reset Successful'));
    }

}
