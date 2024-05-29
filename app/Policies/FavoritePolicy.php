<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the favorite can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the favorite can view the model.
     */
    public function view(User $user, Favorite $model): bool
    {
        return true;
    }

    /**
     * Determine whether the favorite can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the favorite can update the model.
     */
    public function update(User $user, Favorite $model): bool
    {
        return true;
    }

    /**
     * Determine whether the favorite can delete the model.
     */
    public function delete(User $user, Favorite $model): bool
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
     * Determine whether the favorite can restore the model.
     */
    public function restore(User $user, Favorite $model): bool
    {
        return false;
    }

    /**
     * Determine whether the favorite can permanently delete the model.
     */
    public function forceDelete(User $user, Favorite $model): bool
    {
        return false;
    }
}
