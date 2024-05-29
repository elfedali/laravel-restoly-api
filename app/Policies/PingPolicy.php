<?php

namespace App\Policies;

use App\Models\Ping;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ping can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ping can view the model.
     */
    public function view(User $user, Ping $model): bool
    {
        return true;
    }

    /**
     * Determine whether the ping can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the ping can update the model.
     */
    public function update(User $user, Ping $model): bool
    {
        return true;
    }

    /**
     * Determine whether the ping can delete the model.
     */
    public function delete(User $user, Ping $model): bool
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
     * Determine whether the ping can restore the model.
     */
    public function restore(User $user, Ping $model): bool
    {
        return false;
    }

    /**
     * Determine whether the ping can permanently delete the model.
     */
    public function forceDelete(User $user, Ping $model): bool
    {
        return false;
    }
}
