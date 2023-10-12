<?php

namespace App\Models;

use App\Models\Biodata;
use App\Models\College;
use App\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class Department extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'name',
        'college_id',
        'faculty_id',
       
    ];


        // RELATIONSHIPS

    // Users
    public function users():hasManyThrough {
        return $this->hasManyThrough(Biodata::class, Program::class);
    }

     // Programs
     public function programs():hasMany {
        return $this->hasMany(Program::class);
    }

      // College
      public function college() :belongsTo {
        return $this->belongsTo(College::class);
    }

}
