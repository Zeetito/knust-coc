<?php

namespace App\Models;

use App\Models\User;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestRequest extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'guest_id',
        'body',
        'is_draft',
        'table_name',
        'status'
    ];

    protected $casts = [
        'body' => 'array',
    ];

    // Guest Relation
    public function guest(){
        return $this->belongsTo(Guest::class)->first();
    }

    // Assigned User
    public function assigned_user(){
        if($this->assigned_to != null){
            return User::find($this->assigned_to);
        }
    }

    // Check if request has been assigned
    public function is_assigned(){
        return $this->assigned_to != null;
    }
}
