<?php

namespace App\Models;

use App\Models\User;
use App\Models\SpecialProgramResidence;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecialProgramParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'semester_id',
        'user_id'
    ];

    // RELATIONSHIPS
    // Get user
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // Get particiapnts
    public function participants(){
        return $this->hasMany(SpecialProgramParticipant::class);
    }

    // Get residences
    public function residences(){
        return $this->hasMany(SpecialProgramResidence::class);
    }

    // Get Male Participants
    public function male_participants(){
        return $this->participants->where('gender','m');
    }

    // Get Male Participants
    public function female_participants(){
        return $this->participants->where('gender','f');
    }


}
