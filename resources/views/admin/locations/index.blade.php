
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Campus Locations
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Add and manage locations for campus events.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-blue-600 bg-white text-blue-600 hover:bg-blue-50 transition">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6 space-y-6">

        @if (session('status'))
            <div class="p-3 rounded-lg bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-3 rounded-lg bg-red-100 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-xl p-5 space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Add New Location
            </h3>

            <form method="POST"
                  action="{{ route('admin.locations.store') }}"
                  class="flex flex-col sm:flex-row gap-3">
                @csrf

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Location name"
                    maxlength="150"
                    required
                    class="flex-1 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition"
                >
                    Add Location
                </button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Existing Locations
            </h3>

            @forelse ($locations as $location)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-4 border-b last:border-b-0">

                    <div>
                        <p class="font-semibold text-gray-800">
                            {{ $location->name }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a
                            href="{{ route('admin.locations.edit', $location) }}"
                            class="text-blue-600 hover:underline"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.locations.destroy', $location) }}"
                            onsubmit="return confirm('Delete this location?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 hover:underline"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 py-4">
                    No locations added yet.
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>