<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlumniBiodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year_group_id',
        'country',
        'state',
        'city',
        'congregation',
        'acadeimic_year_id',
    ];

    // REALTIONSHIPS
    
    // User
    public function user(){
        $this->belongsTo(User::class);
    }
}
