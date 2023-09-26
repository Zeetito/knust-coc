<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_year',
        'end_year',
    ];

    static function first_date(){
        return self::all()->sortBy('start_year')->first()->start_year;
    }
    static function last_date(){
        return self::all()->sortByDesc('end_year')->first()->end_year;
    }

}
