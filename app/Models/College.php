<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
       
    ];

    public function users():HasMany {
        return $this->hasMany(User::class);
    }

    public function programs():HasMany{
        return $this->hasMany(Program::class);
    }

}
