<?php

namespace App\Models;

use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory,HasRolesAndPermissions;

    protected $fillable = ['name', 'slug', 'description','academic_year_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles')
        ;
    }

    // Users who do not have a particular role
    // The Opposite of users relationship
    public function non_users()
    {
        // Get the users who has the particular role
        $users = $this->users()->get();

        // Convert to json array or flatten it
        $users = json_decode($users, true);
        // Strip every attribute leaving just the id of each member who has the role
        $users = array_reduce($users, function ($carry, $item) {
            $carry[] = $item['id'];

            return $carry;
        }, []);

        // Return users who's id are not part of that of users who have the role
        return User::whereNotIn('id', $users);
    }
    // Eg.. Just say $role->non_users()->get() don't forget the get.

    // Users who do not have a particular role
    public function non_permissions()
    {
        // Get the permissions who has the particular role
        $permissions = $this->permissions()->get();

        // Convert to json array or flatten it
        $permissions = json_decode($permissions, true);
        // Strip every attribute leaving just the id of each member who has the role
        $permissions = array_reduce($permissions, function ($carry, $item) {
            $carry[] = $item['id'];

            return $carry;
        }, []);

        // Return permissions who's id are not part of that of permissions who have the role
        return Permission::whereNotIn('id', $permissions);
    }

    // ROLES
    // Get Ministry Members Level Roles
    public static function preacher_level()
    {
        return self::where('slug', 'preacher');
    }

    public static function ministry_members_level()
    {
        return self::preacher_level()
            ->orWhere('slug', 'edification_ministry_member')
            ->orWhere('slug', 'evangelism_ministry_member')
            ->orWhere('slug', 'finance_ministry_member')
            ->orWhere('slug', 'organising_ministry_member')
            ->orWhere('slug', 'welfare_ministry_member');
        // ->get()
    }

    // Get Zonal Reps Level Roles
    public static function zone_reps_level()
    {
        return self::ministry_members_level()->orWhere('slug', 'zone_rep');
    }

    // Get Residence Reps Level Roles
    public static function residence_reps_level()
    {
        return self::zone_reps_level()->orWhere('slug', 'residence_rep');
    }
}
