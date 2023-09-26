<?php

namespace App\Models;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'name',
        'started_at',
        'ended_at',
        'is_active'
    ];

    /**
     * Model Relationships.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Model Methods.
     */
    public static function findByDate($date)
    {
        // return self::whereDate('started_at',"<=",$date)->whereDate('ended_at',">=",$date)->first();
        
        // Check if the date given falls between the range of a semester
        $semester = self::whereDate('started_at',"<=",$date)->whereDate('ended_at',">=",$date)->first();
        // if not, check if it falls on a vacation
        if(empty($semester) && $date<now() && $date>= AcademicYear::first_date() ){
            // The semster for the particular vacation
            $semester = self::whereDate('ended_at',"<=",$date)->orderBy('ended_at','desc')->first();
            // Appedn the word vacation to the semester name
                $semester ['name'] = $semester->name." Vacation";
                return $semester;
        }
            // if falls within a semster range
            return $semester;
    }
}
