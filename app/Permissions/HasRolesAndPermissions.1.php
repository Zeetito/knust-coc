


    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }

        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function withdrawPermissionsTo( ... $permissions ) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions( ... $permissions ) {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionTo($permission_slug) {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
    // public function hasPermissionThroughRole($permission) {
    //     foreach ($permission->roles as $role){
    //         if($this->roles->contains($role)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    public function hasRole( ... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    // public function roles() {
    //     return $this->belongsToMany(Role::class,'role_users');
    // }

    // public function permissions() {
    //     return $this->belongsToMany(Permission::class,'permission_users');
    // }

    protected function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    protected function getAllPermissions(array $permissionSlugs) {
        return Permission::whereIn('slug',$permissionSlugs)->get();
    }

    // Assign all permissions
    public function assignAllPermissions()
    {
        $permissions = Permission::all();
        $this->permissions()->sync($permissions);
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
    public function giveRole(Role $role){
       
        $this->roles()->attach($role->id);
    }

    // Remove Role to model
    public function removeRole(Role $role){
   
        $this->roles()->detach($role->id);
    }

     // Assign PErmission to model
     public function givePermission(Permission $permission){
       
        $this->permissions()->attach($permission->id);
    }

    // Remove Permission from model
    public function removePermission(Permission $permission){
   
        $this->permissions()->detach($permission->id);
    }


}
