<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'accountable_id',
        'semester_id',
        'accountable_type',
        'created_by',
        'type',
    ];

    // Find Ministry Involved
    public function ministry(){
        return $this->belongsTo(Role::class,'accountable_id');
    }

    // Get the Records For An Account Session
    public function records(){
        return $this->hasMany(AccountRecord::class);
    }


}
