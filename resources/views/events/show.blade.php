<x-app-layout>
    <div class="p-6 space-y-3">
        @if (session('status')) <p>{{ session('status') }}</p> @endif
        @error('join') <p class="text-red-600">{{ $message }}</p> @enderror

        <h1 class="text-xl font-bold">{{ $event->title }}</h1>
        <p>{{ $event->description }}</p>
        <p>{{ $event->event_date->format('M d, Y') }}, {{ substr($event->start_time, 0, 5) }} - {{ substr($event->end_time, 0, 5) }}</p>
        <p>{{ $event->location->name }} | {{ $event->category->name }} | by {{ $event->organizer->name }}</p>
        <p>Status: {{ $event->status }} | Slots left: {{ $event->availableSlots() }} / {{ $event->capacity }}</p>

        @if ($hasJoined)
            <form method="POST" action="{{ route('events.leave', $event) }}">@csrf @method('DELETE')<button>Leave</button></form>
        @else
            <form method="POST" action="{{ route('events.join', $event) }}">@csrf<button>Join</button></form>
        @endif

        {{-- @can only hides buttons. The server still checks the policy. --}}
        @can('update', $event)
            <a href="{{ route('events.edit', $event) }}">Edit</a>
            <form method="POST" action="{{ route('events.cancel', $event) }}">@csrf @method('PATCH')<button>Cancel event</button></form>
        @endcan

        <h2 class="font-bold">Participants ({{ $event->participants->count() }})</h2>
        <ul>
            @foreach ($event->participants as $p)
                <li>{{ $p->name }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>