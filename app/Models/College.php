<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];

    // RELATIONSHIPS
    public function users()
    {
        return User::where('is_student', 1)
            ->join('members_biodatas', 'members_biodatas.user_id', '=', 'users.id')
            ->where('members_biodatas.college_id', $this->id)
            ->get();
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    // departments
    public function departments(): hasMany
    {
        return $this->hasMany(Department::class);
    }

    // faculties
    public function faculties(): hasMany
    {
        return $this->hasMany(Faculty::class);
    }

    // FUNCTIONS

    // Query for UnderGraduage Programs
    public function ug_programs()
    {
        return $this->programs->where('type', 'ug');
    }

    // Query for Post Graduate programs
    public function pg_programs()
    {
        return $this->programs->where('type', 'pg');
    }
}
