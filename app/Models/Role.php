<?php

namespace App\Models;

use App\Models\User;
use App\Models\Share;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    // Get Preacher(s)
    public static function preachers(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'preacher');
        })->get();
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

    // Edification Ministry Members
    public static function edification_ministry_members(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'edification_ministry_member');
        })->get();
    }

    // Get evangelism Ministry members
    public static function evangelism_ministry_members(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'evangelism_ministry_member');
        })->get();
    }

    // Get Finance Ministry Members
    public static function finance_ministry_members(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'finance_ministry_member');
        })->get();
    }

    // Get Organising Ministry members
    public static function organising_ministry_members(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'organising_ministry_member');
        })->get();
    }

    // Get Welfare Mnistry Members
    public static function welfare_ministry_members(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'welfare_ministry_member');
        })->get();
    }

    // Get Zonal Reps
    public static function zonal_reps(){
        return User::whereHas('roles', function ($query) {
            $query->where('slug', 'zone_rep');
        })->get();
    }

    // Get All Ministry Members
    public static function ministry_members(){
        return User::
        whereHas('roles', function ($query) {
            $query->where('slug', 'edification_ministry_member');
        })
        ->orWhereHas('roles', function ($query) {
            $query->where('slug', 'evangelism_ministry_member');
        })
        ->orWhereHas('roles', function ($query) {
            $query->where('slug', 'finance_ministry_member');
        })
        ->orWhereHas('roles', function ($query) {
            $query->where('slug', 'organising_ministry_member');
        })
        ->orWhereHas('roles', function ($query) {
            $query->where('slug', 'welfare_ministry_member');
        })
        
        ->get();
    }

    // Get All Ministries (minus - zonal reps and preacher)
    public static function ministries(){
        return self::where('slug','!=','preacher')->where('slug','!=','zone_rep')->where('slug','!=','residence_rep')->with('users')->get();
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

    // Retrieve Account Sessions for a role
    public function account_sessions(){
        return $this->morphMany(Account::class,'accountable');
    }

    // Retrieve Shared Items
    public function received_items(){
        return $this->morphMany(Share::class,'receivable');
    }

    // Retrieve Sent Items
    public function sent_items(){
        return $this->morphMany(Share::class,'sendable');
    }
}
