<?php

namespace App\Models;

use App\Models\SpecialProgram;
use App\Models\SpecialProgramRoom;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecialProgramParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialProgramResidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    // RELATIONSHIPS
    // Get speical program
    public function special_program(){
        return $this->belongsTo(SpecialProgram::class);
    }

    // Get Rooms
    public function rooms(){
        return $this->hasMany(SpecialProgramRoom::class);
    }

    
    // Get participants
    public function participants(){
        return $this->hasMany(SpecialProgramParticipant::class,'special_program_residence_id');
    }

    // Get Male Participants
    public function male_participants(){
        return $this->participants->where('gender','m');
    }   

    // Get female participants
    public function female_participants(){
        return $this->participants->where('gender','f');
    }
}
