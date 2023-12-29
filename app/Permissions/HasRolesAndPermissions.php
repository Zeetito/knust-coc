<?php

namespace App\Permissions;

use App\Models\Role;
use App\Models\User;
use App\Models\Semester;
use App\Models\Permission;

trait HasRolesAndPermissions
{
    public function hasPermissionTo(array $permission_slugs)
    {
        $permissions = [];
        foreach ($permission_slugs as $slug) {
            $permissions[] = Permission::findBySlug($slug);
        }

        foreach ($permissions as $permission) {
            if (($this->hasPermissionThroughRole($permission) || $this->hasPermission($permission)) === false) {
                return false;
            }
        }

        return true;

    }

    public function hasRoleAs(array $role_slugs){
        foreach($role_slugs as $slug){
            $instance = $this->roles->where('slug',$slug)->first();
            if(!$instance){
                return false;
            }
        }
        return true;
    }

    public function hasPermissionThroughRole($permission)
    {
        // return $permission;
        // foreach ($permissions as $permission) {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true; // User has this permission through a role.
            }
        }

        return false;
        // }
    }

    public function hasPermission($permission)
    {

        if ($this->permissions->where('slug', $permission->slug)->count() == 1) {
            return true;
        }

        // }
        // If all pass
        return false;
    }

    protected function getAllPermissions(array $permissionSlugs)
    {
        return Permission::whereIn('slug', $permissionSlugs)->get();
    }

    // If has role
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    // If has any Role at All
    public function hasAnyRole(){
        return $this->roles->count() > 0;
    }

    // Assign all permissions
    public function assignAllPermissions()
    {
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $this->permissions()->attach($permission->id,['academic_year_id'=>Semester::active_semester()->academicYear->id, 'created_at'=>now(),'updated_at'=>now()]);
        }
    }

    // Assign specific permission to
    public function assignPermissions($permissionSlugs)
    {
        // Call the getAllPermissions function to retrieve permission models.
        $permissions = $this->getAllPermissions($permissionSlugs);

        // Check if any permissions were found.
        if ($permissions->isEmpty()) {
            // Handle the case where no valid permissions were found.
            return 'No valid permissions found.';
        }

        // Assign the retrieved permissions to the user.
        $this->givePermissionsTo(...$permissions);

        return 'Permissions assigned successfully.';
    }

    // Assign Role to model
    public function giveRole(Role $role)
    {

        $this->roles()->attach($role->id,['academic_year_id'=>Semester::active_semester()->academicYear->id, 'created_at'=>now(),'updated_at'=>now()]);
    }

    // Remove Role to model
    public function removeRole(Role $role)
    {

        $this->roles()->detach($role->id);
    }

    // Assign PErmission to model
    public function givePermission(Permission $permission)
    {

        $this->permissions()->attach($permission->id,['academic_year_id'=>Semester::active_semester()->academicYear->id, 'created_at'=>now(),'updated_at'=>now()]);
    }

    // Remove Permission from model
    public function removePermission(Permission $permission)
    {

        $this->permissions()->detach($permission->id);
    }

    // USER SPECIFIC

    // User has any of given roles
    public function hasAnyOf($roles)
    {
        foreach ($roles as $role) {
            // echo $this->roles;
            if ($this->roles->contains('slug', $role->slug)) {
                return true;
            }
        }

    }
}
