<?php

namespace App\Models;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];
// RELATIONSHIPS
    public function users():hasManyThrough {
        return $this->hasManyThrough(User::class,Biodata::class,"college_id","id","id","user_id");
    }

    public function programs():HasMany{
        return $this->hasMany(Program::class);
    }

    // departments
    public function departments() :hasMany{
        return $this->hasMany(Department::class);
    }
    
    // faculties
    public function faculties() :hasMany{
        return $this->hasMany(Faculty::class);
    }
    


    // FUNCTIONS

    // Query for UnderGraduage Programs
    public function ug_programs(){
        return $this->programs->where("type","ug");
    }

    // Query for Post Graduate programs
    public function pg_programs(){
        return $this->programs->where("type","pg");
    }



}
