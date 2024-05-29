<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MenuItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the menuItem can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the menuItem can view the model.
     */
    public function view(User $user, MenuItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the menuItem can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the menuItem can update the model.
     */
    public function update(User $user, MenuItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the menuItem can delete the model.
     */
    public function delete(User $user, MenuItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the menuItem can restore the model.
     */
    public function restore(User $user, MenuItem $model): bool
    {
        return false;
    }

    /**
     * Determine whether the menuItem can permanently delete the model.
     */
    public function forceDelete(User $user, MenuItem $model): bool
    {
        return false;
    }
}
