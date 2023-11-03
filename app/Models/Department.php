<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

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
    public function users()
    {
        return User::join('members_biodatas', 'members_biodatas.user_id', '=', 'users.id')
            ->join('colleges', 'members_biodatas.college_id', '=', 'colleges.id')
            ->where('colleges.id', $this->college_id)
            ->get();
    }

    // Programs
    public function programs(): hasMany
    {
        return $this->hasMany(Program::class);
    }

    // College
    public function college(): belongsTo
    {
        return $this->belongsTo(College::class);
    }
}
