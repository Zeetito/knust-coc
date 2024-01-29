<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable  = [
        'to',
        'subject',
        'body',
        'from',
        'single_user',
        'user_id'
    ];


    // See User who sent 
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Recipient for A single user email
    public function recipient(){
        return User::where('email',$this->to)->first();
        
    }



}
