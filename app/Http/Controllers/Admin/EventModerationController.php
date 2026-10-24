<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;

class EventModerationController extends Controller
{
    // All events, including cancelled ones
    public function index()
    {
        return view('admin.events.index', [
            'events' => Event::with(['organizer', 'category'])
                ->withCount('participants')
                ->orderByDesc('event_date')
                ->paginate(15),
        ]);
    }

    public function cancel(Event $event)
    {
        $event->cancel();

        return back()->with('status', 'Event cancelled.');
    }

    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);
        $event->delete();

        return back()->with('status', 'Event removed.');
    }
}