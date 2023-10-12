<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year',
        'zone_id',
        'residence_id',
        'room',
        'program_id',
        'college_id',
    ];

    public function user():belongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
}
