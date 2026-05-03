<?php

namespace App\Policies;

use App\Models\Resources\Procedure;
use App\Models\User;

class ProcedurePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view.procedure');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Procedure $procedure): bool
    {
        return $user->hasPermissionTo('view.procedure');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create.procedure');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Procedure $procedure): bool
    {
        return $user->hasPermissionTo('update.procedure');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Procedure $procedure): bool
    {
        return $user->hasPermissionTo('delete.procedure');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Procedure $procedure): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Procedure $procedure): bool
    {
        return false;
    }
}
