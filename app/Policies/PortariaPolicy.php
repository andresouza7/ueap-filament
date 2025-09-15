<?php

namespace App\Policies;

use App\Models\Portaria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PortariaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole('urh|gab|consu|dinfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Portaria $portaria): bool
    {
        return $user->hasAnyRole('urh|gab|consu|dinfo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole('urh|gab|consu|dinfo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Portaria $portaria): bool
    {
        return $user->hasAnyRole('urh|gab|consu|dinfo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Portaria $portaria): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Portaria $portaria): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Portaria $portaria): bool
    {
        return $user->hasRole('dinfo');
    }
}
