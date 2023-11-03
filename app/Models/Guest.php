<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'is_member',
        'local_congregation',
    ];

    // RELATIONSHIPS
    // Programs officiated by the user
    public function programsOfficiated()
    {
        return $this->belongsToMany(SemesterProgram::class, 'officiators_programs', 'officiator_id', 'semester_program_id');
    }

    // FUNCTIONS

}
