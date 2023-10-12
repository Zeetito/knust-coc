<?php

namespace App\Models;

use App\Models\User;
use App\Models\Biodata;
use App\Models\College;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'college_id',
       
    ];

    // RELATIONSHIPS

    // Users
    public function users(){
        // return $this->hasManyThrough(User::class, Program::class);
        $facultyId = $this->id;
        return User::whereHas('program.faculty', function ($query) use ($facultyId) {
            $query->where('id', $facultyId);
        });
    }

    // Programs
    public function programs():hasMany {
        return $this->hasMany(Program::class);
    }
    // College
    public function college() :belongsTo {
        return $this->belongsTo(College::class);
    }

    // Departments
    public function departments() :hasMany {
        return $this->hasMany(Department::class);
    }

}
