<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    // Discovery page: upcoming OPEN events, with optional filters
    public function index(Request $request)
    {
        $filters = $request->validate([
            'category_id' => ['nullable', 'integer'],
            'location_id' => ['nullable', 'integer'],
            'date' => ['nullable', 'date'],
        ]);

        $events = Event::query()
            ->with(['category', 'location', 'organizer'])
            ->withCount('participants')
            ->where('status', 'open')
            // Compare the raw column (no date() wrapper) so the index can be used
            ->where('event_date', '>=', today())
            ->when($filters['category_id'] ?? null, fn ($q, $id) => $q->where('category_id', $id))
            ->when($filters['location_id'] ?? null, fn ($q, $id) => $q->where('location_id', $id))
            ->when($filters['date'] ?? null, fn ($q, $date) => $q->where('event_date', $date))
            ->orderBy('event_date')
            ->orderBy('start_time')
            ->paginate(9)
            ->withQueryString();

        return view('events.index', [
            'events' => $events,
            'categories' => Category::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('events.create', $this->formData());
    }

    public function store(StoreEventRequest $request)
    {
        // organizer_id comes from the logged-in user, NEVER from the form
        $event = $request->user()->organizedEvents()->create($request->validated());

        return redirect()->route('events.show', $event)->with('status', 'Event created.');
    }

    public function show(Request $request, Event $event)
    {
        $event->load(['organizer', 'category', 'location', 'participants']);

        return view('events.show', [
            'event' => $event,
            'hasJoined' => $event->participants->contains($request->user()),
        ]);
    }

    public function edit(Event $event)
    {
        Gate::authorize('update', $event);

        return view('events.edit', $this->formData() + ['event' => $event]);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        // Ownership is already checked inside UpdateEventRequest::authorize()
        $event->update($request->validated());

        return redirect()->route('events.show', $event)->with('status', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);
        $event->delete();

        return redirect()->route('events.index')->with('status', 'Event deleted.');
    }

    // Soft way to remove an event: keep the record, mark it cancelled
    public function cancel(Event $event)
    {
        Gate::authorize('update', $event);

        // status is not mass-assignable, so we set it directly.
        // The PostgreSQL trigger writes the audit row.
        $event->status = 'cancelled';
        $event->save();

        return redirect()->route('events.show', $event)->with('status', 'Event cancelled.');
    }

    // Dropdown data shared by create and edit
    private function formData(): array
    {
        return [
            'categories' => Category::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
        ];
    }
}