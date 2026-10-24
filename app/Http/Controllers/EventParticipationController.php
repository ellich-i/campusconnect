<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventParticipationController extends Controller
{
    public function join(Request $request, Event $event)
    {
        $user = $request->user();

        try {
            DB::transaction(function () use ($event, $user) {
                // Lock this event row. If two students click at the same time,
                // the second one waits here until the first one finishes.
                $locked = Event::whereKey($event->id)->lockForUpdate()->firstOrFail();

                if ($locked->status !== 'open' || $locked->event_date->lt(today())) {
                    throw new \DomainException('This event is not open for joining.');
                }
                if ($locked->organizer_id === $user->id) {
                    throw new \DomainException('You are the organizer of this event.');
                }
                if ($locked->participants()->where('users.id', $user->id)->exists()) {
                    throw new \DomainException('You already joined this event.');
                }
                if ($locked->participants()->count() >= $locked->capacity) {
                    throw new \DomainException('This event is full.');
                }

                // The UNIQUE(event_id, user_id) constraint is the last safety net
                $locked->participants()->attach($user->id);
            });
        } catch (\DomainException $e) {
            return back()->withErrors(['join' => $e->getMessage()]);
        }

        return back()->with('status', 'You joined the event!');
    }

    public function leave(Request $request, Event $event)
    {
        // Detach only removes the logged-in user's own row
        $event->participants()->detach($request->user()->id);

        return back()->with('status', 'You left the event.');
    }
}