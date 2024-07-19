<?php

namespace App\Models;

use App\Models\SpecialProgram;
use App\Models\SpecialProgramRoom;
use App\Models\SpecialProgramResidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialProgramParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'othername',
        'lastname',
        'email',
        'phone',
        'special_program_room_id',
        'congregation',
        'special_program_residence_id',
       
    ];

    // RELATIONSHIPS
    // Special program
    public function special_program(){
        return $this->belongsTo(SpecialProgram::class);
    }

    // Get Room
    public function room(){
        return $this->belongsTo(SpecialProgramRoom::class,'special_program_room_id');
    }

    // Get residence
    public function residence(){
        return $this->belongsTo(SpecialProgramResidence::class,'special_program_residence_id');
    }
    

}
