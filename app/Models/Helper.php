<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Helper extends Model
{
    use HasFactory;

    public static function getAcademicPeriod($date)
    {
        // Your function logic here
        // $date = $date->format('Y-m-d');
        $date = "2022-03-02";

        $academic_year = DB::table('academic_years')
        ->where('started_at',"<=",$date)
        ->where('ended_at',">=",$date)
        ->get();

        $semester = DB::table('semesters')
        ->where('started_at',"<=",$date)
        ->where('ended_at',">=",$date)
        ->get();

        return ($academic_year);
    }
}

