<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;

class AttendanceController extends Controller
{
    //
    public function index(){
        return AttendanceResource::collection(Attendance::all());
    }


}
