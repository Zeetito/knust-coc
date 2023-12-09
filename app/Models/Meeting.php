<?php

namespace App\Models;

use App\Models\DefaultImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function attendance_sessions()
    {
        return $this->hasMany(Attendance::class, 'meeting_type');
    }

    // Default images for each of the meetings
    public function defaultImages(){
        return $this->morphMany(DefaultImage::class,'defaultImageable');
    }

    public function defaultImage(){
        return $this->morphOne(DefaultImage::class,'defaultImageable');
    }



}
