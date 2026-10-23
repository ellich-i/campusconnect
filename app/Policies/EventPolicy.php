<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    // Only the organizer or an admin can edit an event
    public function update(User $user, Event $event): bool
    {
        return $user->id === $event->organizer_id || $user->isAdmin();
    }

    // Organizer can delete only while nobody has joined. Admin can always delete.
    public function delete(User $user, Event $event): bool
    {
        return $user->isAdmin()
            || ($user->id === $event->organizer_id && $event->participants()->doesntExist());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        return false;
    }
}
