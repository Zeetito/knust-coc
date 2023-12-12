<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Paginator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        return view('roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }

    // View Users_Roles Forms
    public function create_users_roles(Role $role)
    {
        $non_users = $role->non_users()->paginate(
            $perPage = 25, $columns = ['*'], $pageName = 'Users'
        );

        return view('roles.roles-users.components.non-users.create', ['role' => $role, 'non_users' => $non_users]);
    }

    // Give a user role
    public function give_user_role(Role $role, User $user)
    {
        // Check for the existence of the instance
        $doesntExist = DB::table('role_users')
            ->where('user_id', $user->id)
            ->where('role_id', $role->id)
            ->doesntExist();

        if ($doesntExist) {
            // use the custom giveRole function from the trait file
            $user->giveRole($role);

            // return the updated row
            return '';
        }

        return 'This User Already has role as '.$role->name;
    }

    // USER
    // Remove role from user
    public function remove_user_role(Role $role, User $user)
    {
        // use the custom removeRole function from the trait file
        $user->removeRole($role);

        // return the updated row
        return redirect(route('edit_role', $role))->with('success', 'Role Withdrawn Successfully');
    }

    // Search Non_User_Roles
    public function search_non_user_roles(Role $role, Request $request)
    {
        // Get the string from the ajax
        $string = $request->input('str');

        if (! empty($string)) {
            $str = '%'.$string.'%';
            $users = $role->non_users()
                ->where((DB::raw("CONCAT(firstname,' ', lastname, ' ', username)")), 'like', $str)
                ->orWhere((DB::raw("CONCAT(lastname,' ',firstname, ' ', username)")), 'like', $str)
                ->paginate($perPage = 25, $columns = ['*'], $pageName = 'SearchResults');
        } else {
            $users = $role->non_users()->paginate($perPage = 25, $columns = ['*'], $pageName = 'Users');
        }

        return view('roles.roles-users.components.non-users.search-results', ['non_users' => $users, 'role' => $role]);

    }

    // Conirm Role User Remove\
    public function confirm_role_user_remove(Role $role, User $user)
    {
        $exists = DB::table('role_users')
            ->where('user_id', $user->id)
            ->where('role_id', $role->id)
            ->exists();

        if ($exists) {

            return view('roles.roles-users.components.users.confirm-role-remove', ['user' => $user, 'role' => $role]);
        }
    }

    // PERMISSIONS
    // Create Roles Permissions
    public function create_roles_permissions(Role $role)
    {
        $non_permissions = $role->non_permissions()->paginate(
            $perPage = 25, $columns = ['*'], $pageName = 'Permissions'
        );

        return view('roles.roles-permissions.create', ['role' => $role, 'non_permissions' => $non_permissions]);

    }

    // Give a Role a permission
    public function assign_role_permission(Role $role, Permission $permission)
    {
        // Check for the existence of the instance
        $doesntExist = DB::table('permission_roles')
            ->where('permission_id', $permission->id)
            ->where('role_id', $role->id)
            ->doesntExist();

        if ($doesntExist) {
            // use the custom giveRole function from the trait file
            $role->givePermission($permission);

            // return the updated row
            return '';
        }

        return 'This Role Already has Permission to  '.$pemission->slug;
    }

    // Confirm Permission Role Remove
    public function confirm_role_permission_remove(Role $role, Permission $permission)
    {
        return view('roles.roles-permissions.confirm-permission-remove', ['role' => $role, 'permission' => $permission]);
    }

    // Remove role PErmission
    public function remove_role_permission(Role $role, Permission $permission)
    {
        // use the custom removeRole function from the trait file
        $role->removePermission($permission);

        return redirect(route('edit_role', $role))->with('success', 'Permission Withdrawn Successfully');
    }

    // Search role_non_permissoins
    // PERMISSION
    public function search_role_non_permissions(Request $request, Role $role)
    {
        $non_permissions = Permission::search($request)
            ->get()
            ->intersect($role->non_permissions()->get());

        return view('roles.roles-permissions.search-results', ['non_permissions' => $non_permissions, 'role' => $role]);

    }

    public function fetch_role_users_modal(Request $request, Role $role)
    {
        // $string =  $request->input('str');
        // $str = "%".$string."%";

        $non_users = $role->non_users();

        return $non_users;

        // If the String is not empty
        if (! empty($usersNeeded)) {
            return view('modals.roles.fetched-users', ['users' => $usersNeeded, 'role' => $role]);
        } else {
            return 'No Users to show';
        }

        // return view('modals.attendance.search-results',['attendances'=>$attendances]);
    }
}
