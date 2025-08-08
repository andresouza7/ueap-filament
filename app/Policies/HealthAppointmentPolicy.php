<?php

namespace App\Policies;

use App\Models\HealthAppointment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HealthAppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole('urh|dinfo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HealthAppointment $healthAppointment): bool
    {
        return $user->hasAnyRole('urh|dinfo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole('urh|dinfo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HealthAppointment $healthAppointment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HealthAppointment $healthAppointment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HealthAppointment $healthAppointment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HealthAppointment $healthAppointment): bool
    {
        return false;
    }
}
