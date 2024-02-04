<?php

namespace App\Models;

use App\Models\User;
use App\Models\Guest;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'person_id',
        'is_user',
        'is_present',
        'checked_by',
        // 'reason',
    ];


    // Find the related user in the instanace
    public function user(){
        return $this->belongsTo(User::class,'person_id');
    }

    // Find The Related Guest
    public function guest(){
        return $this->belongsTo(Guest::class,'person_id');
    }

    // Find who the related instance was checked or created by
    public function created_by(){
        return $this->belongsTo(User::class,'checked_by');
    }

    // Find the related Attendnace Session
    public function attendance(){
        return $this->belongsTo(Attendance::class);
    }

    // Find the residence of the related user's instance at the time
    public function residence(){
        return $this->user->profile_at($this->attendance->semester->academic_year_id)->residence;
    }



}
