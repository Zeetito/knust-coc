<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    //
    public function store(AttendanceRequest $request){
        $attendance = Attendance::create($request->validated());

        return new AttendanceResource($attendance);
    }

    public function index(){
        return AttendanceResource::collection(Attendance::all());
    }

}
