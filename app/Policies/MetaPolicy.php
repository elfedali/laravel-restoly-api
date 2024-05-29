<?php

namespace App\Policies;

use App\Models\Meta;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the meta can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the meta can view the model.
     */
    public function view(User $user, Meta $model): bool
    {
        return true;
    }

    /**
     * Determine whether the meta can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the meta can update the model.
     */
    public function update(User $user, Meta $model): bool
    {
        return true;
    }

    /**
     * Determine whether the meta can delete the model.
     */
    public function delete(User $user, Meta $model): bool
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
     * Determine whether the meta can restore the model.
     */
    public function restore(User $user, Meta $model): bool
    {
        return false;
    }

    /**
     * Determine whether the meta can permanently delete the model.
     */
    public function forceDelete(User $user, Meta $model): bool
    {
        return false;
    }
}
