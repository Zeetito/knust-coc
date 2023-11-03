<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'name',
        'started_at',
        'ended_at',
        'is_active',
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
        $semester = self::whereDate('started_at', '<=', $date)->whereDate('ended_at', '>=', $date)->first();
        // if not, check if it falls on a vacation
        if (empty($semester) && $date >= AcademicYear::first_date()) {
            // The semster for the particular vacation
            $semester = self::whereDate('ended_at', '<=', $date)->orderBy('ended_at', 'desc')->first();
            // Appedn the word vacation to the semester name
            $semester['name'] = $semester->name.'-Vacation';

            return $semester;
        }

        // if falls within a semster range
        return $semester;
    }

    // Get Semester programs for a particular sem
    public function semester_programs()
    {

        // Steps
        // 1. Check for programs whose start_date falls between the started of the semester
        // and the started at of the next semester.
        // Get the boundaries

        // Lower Boundary
        $lower_bounday = $this->started_at;
        // Upper Boundary
        $upper_boundary_sem = self::where('started_at', '>', $this->started_at)->first();
        // return "Lower = ".$lower_bounday." Upper = ".$upper_boundary;

        // If upper bounday is null it means the reated semester is the current semester (since there's no other sem after that)
        if (empty($upper_boundary_sem)) {
            return SemesterProgram::whereDate('start_date', '>', $lower_bounday);
        } else {
            $upper_boundary = $upper_boundary_sem->started_at;

            return SemesterProgram::whereDate('start_date', '>', $lower_bounday)
                ->where('end_date', '<', $upper_boundary);
        }

        // return SemesterProgram::where('start_e')
    }

    // query for upcoming programs
    public static function upcoming_programs()
    {
        return SemesterProgram::where('start_date', '>=', now())->get();
    }

    // Get Academic Period for any date

}
