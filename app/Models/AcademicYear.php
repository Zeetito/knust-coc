<?php

namespace App\Models;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_year',
        'end_year',
    ];

    // RELATIONSHIPS
    public function semesters():HasMany{
        return $this->hasMany(Semester::class);
    }


    // FUNCTION

    static function first_date(){
        return self::all()->sortBy('start_year')->first()->start_year;
    }
    static function last_date(){
        return self::all()->sortByDesc('end_year')->first()->end_year;
    }

    

}
