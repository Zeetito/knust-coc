<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_year',
        'end_year',
    ];

    // RELATIONSHIPS
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    // FUNCTION

    public static function first_date()
    {
        return self::all()->sortBy('start_year')->first()->start_year;
    }

    public static function last_date()
    {
        return self::all()->sortByDesc('end_year')->first()->end_year;
    }
}
