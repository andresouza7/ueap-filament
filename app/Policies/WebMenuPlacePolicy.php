<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebMenuPlace;
use Illuminate\Auth\Access\Response;

class WebMenuPlacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WebMenuPlace $webMenuPlace): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WebMenuPlace $webMenuPlace): bool
    {
        return $user->hasRole('dinfo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WebMenuPlace $webMenuPlace): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WebMenuPlace $webMenuPlace): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WebMenuPlace $webMenuPlace): bool
    {
        return false;
    }
}
