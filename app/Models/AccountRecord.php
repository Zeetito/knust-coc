<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'info',
        'value',
        'sign',
        'account_id',
        'created_by',
    ];


    // Find the Account Session
    public function account_session(){
        return $this->belongsTo(Account::class,'account_id');
    }

}
