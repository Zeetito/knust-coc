<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    protected $hidden = 'pivot';

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

    // Users who do not have a particular role 
    // The Opposite of users relationship
    public function non_users(){
        // Get the users who has the particular role
        $users = $this->users()->get();

        // Convert to json array or flatten it
        $users = json_decode($users,true);
        // Strip every attribute leaving just the id of each member who has the role
        $users = array_reduce($users, function ($carry, $item) {
            $carry[] = $item['id'];
            return $carry;
        }, []);
        // Return users who's id are not part of that of users who have the role
        return User::whereNotIn('id', $users);
    }
    // Eg.. Just say $role->non_users()->get() don't forget the get.



    public function non_permissions(){
        // Get the permissions who has the particular role
        $permissions = $this->permissions()->get();

        // Convert to json array or flatten it
        $permissions = json_decode($permissions,true);
        // Strip every attribute leaving just the id of each member who has the role
        $permissions = array_reduce($permissions, function ($carry, $item) {
            $carry[] = $item['id'];
            return $carry;
        }, []);
        // Return permissions who's id are not part of that of permissions who have the role
        return Permission::whereNotIn('id', $permissions);
    }

}
