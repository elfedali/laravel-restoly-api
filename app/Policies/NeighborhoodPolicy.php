<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Neighborhood;
use Illuminate\Auth\Access\HandlesAuthorization;

class NeighborhoodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the neighborhood can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the neighborhood can view the model.
     */
    public function view(User $user, Neighborhood $model): bool
    {
        return true;
    }

    /**
     * Determine whether the neighborhood can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the neighborhood can update the model.
     */
    public function update(User $user, Neighborhood $model): bool
    {
        return true;
    }

    /**
     * Determine whether the neighborhood can delete the model.
     */
    public function delete(User $user, Neighborhood $model): bool
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
     * Determine whether the neighborhood can restore the model.
     */
    public function restore(User $user, Neighborhood $model): bool
    {
        return false;
    }

    /**
     * Determine whether the neighborhood can permanently delete the model.
     */
    public function forceDelete(User $user, Neighborhood $model): bool
    {
        return false;
    }
}
