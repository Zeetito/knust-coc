<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'date', => created_at
        'service_name',
        'venue',
       
    ];

    public function users(): hasManyThrough{
        return $this->hasManyThrough(User::class,'attendance_users','attendance_id','user_id');
    }

    
}
