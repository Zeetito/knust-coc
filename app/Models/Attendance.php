<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendance extends Model
{
    use HasFactory;

    // The type of service should be added to the table so that we could query later, how many times an
    // individual has attended a particular servie, say evening service

    protected $fillable = [
        'meeting_type',
        'venue',
        'checked_by',
       
    ];

    // public function members(): hasMany{
    //     return $this->hasMany(User::class,'attendance_users','attendance_id','user_id')
    //     ->withPivot('user_id')
    //     ;
    // }

    public function members(): BelongsToMany
{
    return $this->belongsToMany(User::class, 'attendance_users', 'attendance_id', 'user_id')
        ->withPivot('user_id','checked_by')
        ->withTimestamps();
}
    
    public function user_marked_by($user) {
        return User::find($user);
    }

    public function meeting(): BelongsTo {
        return $this->belongsTo(Meeting::class,"meeting_type");
    }

    
}
