<?php

namespace App\Models;

use App\Models\User;
use App\Models\Program;
use App\Models\Residence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MembersBiodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'academic_year_id',
        'year',
        'program_id',
        'college_id',
        'residence_id',
        'zone_id',
        'room',
        'year_group_id',
        'country',
        'state',
        'city',
        'local_congregation',
        'ns_status',
        'is_alumini',
    ];

// protected $visible = ['ns_status', /* other attributes */];

    // REALTIONSHIPS
    
    // User
    public function user(){
        return $this->belongsTo(User::class);
    }
    // Zone of User
    public function zone(){
        return $this->belongsTo(Zone::class,'zone_id');
    }

    // Residence Of User
    public function residence(){
        return $this->belongsTo(Residence::class,'residence_id');
    }

    // Program Of User
    public function program(){
        return $this->belongsTo(Program::class);
    }
}
