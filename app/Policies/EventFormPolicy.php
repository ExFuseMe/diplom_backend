<?php

namespace App\Policies;

use App\Models\EventForm;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventFormPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin']) || $user->hasPermissionTo('list event forms');
    }
    public function view(User $user, EventForm $form): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['admin']) || $user->hasPermissionTo('create event forms');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventForm $form): bool
    {
        return $user->hasRole(['admin']) || $user->hasPermissionTo('update event forms');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventForm $form): bool
    {
        return $user->hasRole(['admin']) || $user->hasPermissionTo('delete event forms');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, EventForm $form): bool
    {
        return $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, EventForm $form): bool
    {
        return false;
    }
}
