<?php

namespace App\Models;

use App\Models\User;
use App\Models\Biodata;
use App\Models\Program;
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
