<?php

namespace App\Models;

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
        return self::whereDate('started_at',"<=",$date)->whereDate('ended_at',">=",$date)->first();
    }
}
