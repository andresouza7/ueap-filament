<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebPage;
use Illuminate\Auth\Access\Response;

class WebPagePolicy
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
    public function view(User $user, WebPage $webPage): bool
    {
        return $user->hasAnyRole('ascom|dinfo');;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole('ascom|dinfo');;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WebPage $webPage): bool
    {
        return $user->hasAnyRole('ascom|dinfo');;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WebPage $webPage): bool
    {
        return $user->hasAnyRole('dinfo');;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WebPage $webPage): bool
    {
        return $user->hasAnyRole('dinfo');;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WebPage $webPage): bool
    {
        return false;
    }
}
