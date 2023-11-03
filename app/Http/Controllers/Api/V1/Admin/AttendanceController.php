<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    //
    // INDEX, SHOW ALL ATTENDANCE RECORDED
    public function index()
    {
        return AttendanceResource::collection(Attendance::all());
    }

    // STORE
    public function store(AttendanceRequest $request)
    {
        $attendance = Attendance::create($request->validated());

        return new AttendanceResource($attendance);
    }

    // UPDATE
    // To Update a Resource,
    public function update(AttendanceRequest $request)
    {
        $attendance->update($request->validated());

        return new AttendanceResource($attendance);
    }
}
