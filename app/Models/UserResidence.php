<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'zone_id',
        'academic_year_id'
    ];

    // Get the Associated User 
    public function user(){
        return $this->belongsTo(User::class);
    }
}
