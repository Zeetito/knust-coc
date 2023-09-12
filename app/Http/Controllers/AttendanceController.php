<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Http\Request;

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
}
