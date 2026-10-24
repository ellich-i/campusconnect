<x-app-layout>
    <div class="p-6 space-y-3">
        @if (session('status')) <p>{{ session('status') }}</p> @endif

        @foreach ($events as $e)
            <div class="flex gap-3">
                <span>{{ $e->title }} | {{ $e->status }} | by {{ $e->organizer->name }}
                    | {{ $e->participants_count }}/{{ $e->capacity }}</span>
                @if ($e->status === 'open')
                    <form method="POST" action="{{ route('admin.events.cancel', $e) }}">@csrf @method('PATCH')<button>Cancel</button></form>
                @endif
                <form method="POST" action="{{ route('admin.events.destroy', $e) }}">@csrf @method('DELETE')<button>Remove</button></form>
            </div>
        @endforeach

        {{ $events->links() }}
    </div>
</x-app-layout>