<?php

namespace App\Policies;

use App\Models\ConsuResolution;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConsuResolutionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole('ascom|dinfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ConsuResolution $consuResolution): bool
    {
        return $user->hasAnyRole('ascom|dinfo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole('ascom|dinfo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ConsuResolution $consuResolution): bool
    {
        return $user->hasAnyRole('ascom|dinfo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ConsuResolution $consuResolution): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ConsuResolution $consuResolution): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ConsuResolution $consuResolution): bool
    {
        return $user->hasRole('dinfo');
    }
}
