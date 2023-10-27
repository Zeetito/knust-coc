<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model{
    use HasFactory,HasRolesAndPermissions;

    // protected $hidden = 'pivot';
    
    protected $fillable = ['name', 'slug', 'description'];

    public function roles(){
        return $this->belongsToMany(Role::class, 'permission_roles');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'permission_users');
    }

    // Find permission  by slug
    public static function findBySlug($permission_slug){
        return self::where('slug',$permission_slug)->first();
    }
    
}
