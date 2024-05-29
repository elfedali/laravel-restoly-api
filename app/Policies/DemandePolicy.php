<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Demande;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemandePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the demande can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the demande can view the model.
     */
    public function view(User $user, Demande $model): bool
    {
        return true;
    }

    /**
     * Determine whether the demande can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the demande can update the model.
     */
    public function update(User $user, Demande $model): bool
    {
        return true;
    }

    /**
     * Determine whether the demande can delete the model.
     */
    public function delete(User $user, Demande $model): bool
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
     * Determine whether the demande can restore the model.
     */
    public function restore(User $user, Demande $model): bool
    {
        return false;
    }

    /**
     * Determine whether the demande can permanently delete the model.
     */
    public function forceDelete(User $user, Demande $model): bool
    {
        return false;
    }
}
