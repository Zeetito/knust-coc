<?php

namespace App\Models;

use App\Permissions\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    use HasFactory,HasRolesAndPermissions;

    // protected $hidden = 'pivot';

    protected $fillable = ['name', 'slug', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_roles');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'permission_users');
    }

    // Find permission  by slug
    public static function findBySlug($permission_slug)
    {
        return self::where('slug', $permission_slug)->first();
    }

    // SEARCH PERMISSIONS
    public static function search(Request $request)
    {
        $string = $request->input('str');
        $str = '%'.$string.'%';

        if (! empty($string)) {
            $permissions = self::where((DB::raw("CONCAT(name, ' ', slug)")), 'like', $str)
                                ->orWhere((DB::raw("CONCAT(slug, ' ',name)")), 'like', $str);

            // Define user collection if empty...
        } else {

            $permissions = self::orderBy('id');

        }
        // Retrieve the needed component

        return $permissions;

    }
}
