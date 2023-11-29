<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'groupable_id',
        'groupable_type',
        'created_by',
        'visibility',
        'target',
        'academic_year_id',
    ];

    public function groupable(): MorphTo
    {
        return $this->morphTo();
    }
    public function members(){
        return $this->belongsToMany(User::class,'group_users','group_id','user_id')
                    ->where('group_users.is_member',1)        
                ;
    }
}
