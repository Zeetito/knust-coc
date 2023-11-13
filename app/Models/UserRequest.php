<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
        'type',
        'function',
        'is_draft',
        'table_name',
        'status'
    ];

    protected $casts = [
        'body' => 'array',
    ];

    // RELATIONSHIPS
    public function user(){
        return $this->belongsTo(User::class)->first();
    }


}
