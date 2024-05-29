<?php

namespace App\Policies;

use App\Models\Term;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TermPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the term can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the term can view the model.
     */
    public function view(User $user, Term $model): bool
    {
        return true;
    }

    /**
     * Determine whether the term can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the term can update the model.
     */
    public function update(User $user, Term $model): bool
    {
        return true;
    }

    /**
     * Determine whether the term can delete the model.
     */
    public function delete(User $user, Term $model): bool
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
     * Determine whether the term can restore the model.
     */
    public function restore(User $user, Term $model): bool
    {
        return false;
    }

    /**
     * Determine whether the term can permanently delete the model.
     */
    public function forceDelete(User $user, Term $model): bool
    {
        return false;
    }
}
