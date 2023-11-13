<?php

namespace App\Models;

use App\Models\SemesterProgram;
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

    // Get the active Semester
    public static function active_semester()
    {
        return self::where('is_active', 1)->first();
    }

    // Get Semester programs for a particular sem
    public function semester_programs()
    {
        return $this->hasMany(SemesterProgram::class);

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
    public function upcoming_programs()
    {
        return $this->hasMany(SemesterProgram::class)->orderBy('start_date')->where('start_date', '>=', now());
    }

    // Get attendance sessions for a particular semester
    public function attendance_sessions(){
        return $this->hasMany(Attendance::class);
    }

    // Get Academic Period for any date

}
