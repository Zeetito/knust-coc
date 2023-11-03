<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'college_id',
        'faculty_id',
        'department_id',
        'type',
        'span',

    ];
    // RELATIONSHIPS

    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    public function college(): belongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function faculty(): belongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function department(): belongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // FUNCTIONS
    // finid program by name
    public static function findProgramByName($name)
    {
        return Program::where('name', $name)->first();

    }
}
