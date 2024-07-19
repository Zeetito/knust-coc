<?php

namespace App\Models;

use App\Models\SpecialProgramRoom;
use App\Models\SpecialProgramResidence;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecialProgramParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialProgramRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'special_program_residence_id',
        'floor',
        'size',
        'gender',
    ];

    // RELATIONSHIPS
        // Get the residence
        public function residence(){
            return $this->belongsTo(SpecialProgramResidence::class);
        }

        // Get the participants
        public function participants(){
            return $this->hasMany(SpecialProgramParticipant::class);
        }

    // FUNCTION
        // Check the gender
        public function gender(){
            return $this->gender == 'm' ? 'Male' : 'Female';
        }

    // STATIC FUNCTIONS
    // Get all male_assigned rooms
    public function male_assigned_rooms(){
        return SpecialProgramRoom::where('gender','m');
    }

    // Get all female_assigned rooms
    public function female_assigned_rooms(){
        return SpecialProgramRoom::where('gender','f');
    }




}
