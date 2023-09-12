<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Othername extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'is_visible',
       
    ];

    // RELATIONSHIPS
    public function user(): belongsTo{
        return $this->belongsTo(User::class);
    }

}
