<?php

namespace App\Policies;

use App\Models\TransparencyBid;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransparencyBidPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole('diplan|ucc|dinfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TransparencyBid $transparencyBid): bool
    {
        if ($transparencyBid->type === 'contrato') {
            return $user->hasAnyRole('ucc|dinfo');
        }

        return $user->hasAnyRole('diplan|dinfo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole('diplan|dinfo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TransparencyBid $transparencyBid): bool
    {
        return $user->hasAnyRole('dinfo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TransparencyBid $transparencyBid): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TransparencyBid $transparencyBid): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TransparencyBid $transparencyBid): bool
    {
        return false;
    }
}
