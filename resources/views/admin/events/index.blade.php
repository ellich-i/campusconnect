
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Manage Events
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Review and manage campus events.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-blue-600 bg-white text-blue-600 hover:bg-blue-50 transition">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 space-y-6">

        @if (session('status'))
            <div class="p-3 rounded-lg bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="p-5 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    All Events
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    View event details, cancel open events, or remove events.
                </p>
            </div>

            @forelse ($events as $e)
                <div class="p-5 border-b last:border-b-0 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="space-y-2">
                        <h4 class="font-semibold text-gray-800 text-lg">
                            {{ $e->title }}
                        </h4>

                        <p class="text-sm text-gray-600">
                            Organized by: {{ $e->organizer->name }}
                        </p>

                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="px-3 py-1 rounded-full
                                {{ $e->status === 'open'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($e->status) }}
                            </span>

                            <span class="text-gray-500">
                                Participants: {{ $e->participants_count }}/{{ $e->capacity }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        @if ($e->status === 'open')
                            <form method="POST"
                                  action="{{ route('admin.events.cancel', $e) }}"
                                  onsubmit="return confirm('Cancel this event?')">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="px-4 py-2 rounded-lg bg-yellow-100 text-yellow-800 hover:bg-yellow-200 transition">
                                    Cancel Event
                                </button>
                            </form>
                        @endif

                        <form method="POST"
                              action="{{ route('admin.events.destroy', $e) }}"
                              onsubmit="return confirm('Remove this event permanently?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">
                                Remove Event
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <p class="text-gray-500">
                        No events available.
                    </p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
