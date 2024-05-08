<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
        $roles = Role::ministry_members_level()->get();

        return $model->is($user) || $user->hasAnyOf($roles);

    }

    public function update_profile(User $user, User $model): bool
    {
        //
        $roles = Role::ministry_members_level()->get();

        return $model->is($user) || ($user->hasAnyOf($roles) && $model->biodata == null);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }

    public function check(User $user, User $model): bool
    {
        // The person who checked can uncheck the user as well
        return $model->is($user) || $user->hasPermissionTo(['check_user']);
    }
}
