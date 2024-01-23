<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FP extends Model
{
    use HasFactory;

    protected $fillable = [
        'email'
    ];


    public function user(){
        return User::where('email',$this->email)->first();
    }
    
}
