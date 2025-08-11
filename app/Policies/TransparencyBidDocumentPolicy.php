<?php

namespace App\Policies;

use App\Models\TransparencyBidDocument;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransparencyBidDocumentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole('diplan|dinfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TransparencyBidDocument $transparencyBidDocument): bool
    {
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
    public function update(User $user, TransparencyBidDocument $transparencyBidDocument): bool
    {
        return $user->hasAnyRole('dinfo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TransparencyBidDocument $transparencyBidDocument): bool
    {
        return $user->hasAnyRole('dinfo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TransparencyBidDocument $transparencyBidDocument): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TransparencyBidDocument $transparencyBidDocument): bool
    {
        return false;
    }
}
