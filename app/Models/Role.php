<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory,HasRolesAndPermissions;

    protected $fillable = ['name', 'slug', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class , 'role_users');
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }

}
