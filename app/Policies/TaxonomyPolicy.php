<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Taxonomy;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaxonomyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the taxonomy can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the taxonomy can view the model.
     */
    public function view(User $user, Taxonomy $model): bool
    {
        return true;
    }

    /**
     * Determine whether the taxonomy can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the taxonomy can update the model.
     */
    public function update(User $user, Taxonomy $model): bool
    {
        return true;
    }

    /**
     * Determine whether the taxonomy can delete the model.
     */
    public function delete(User $user, Taxonomy $model): bool
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
     * Determine whether the taxonomy can restore the model.
     */
    public function restore(User $user, Taxonomy $model): bool
    {
        return false;
    }

    /**
     * Determine whether the taxonomy can permanently delete the model.
     */
    public function forceDelete(User $user, Taxonomy $model): bool
    {
        return false;
    }
}
