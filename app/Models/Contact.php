<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'type',
        'ownership',
        'relation',
        'is_main',
        'is_visible',
    ];

    // User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
