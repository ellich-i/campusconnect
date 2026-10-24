<x-app-layout>
    <div class="p-6 space-y-4">
        {{-- GET form: filters stay in the URL --}}
        <form method="GET" action="{{ route('events.index') }}" class="flex gap-2">
            <select name="category_id">
                <option value="">All categories</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
            <select name="location_id">
                <option value="">All locations</option>
                @foreach ($locations as $l)
                    <option value="{{ $l->id }}" @selected(request('location_id') == $l->id)>{{ $l->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}">
            <button>Filter</button>
        </form>

        @foreach ($events as $event)
            <div>
                <a href="{{ route('events.show', $event) }}" class="font-bold">{{ $event->title }}</a>
                | {{ $event->event_date->format('M d') }} | {{ $event->location->name }}
                | {{ $event->availableSlots() }} slots left
            </div>
        @endforeach

        {{ $events->links() }}
    </div>
</x-app-layout>