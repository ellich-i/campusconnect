
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-bold text-gray-800">
                Campus Locations
            </h2>

            <a href="{{ route('admin.dashboard') }}"
                class="text-sm font-semibold text-blue-700 hover:underline">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl space-y-8 px-4 sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-800">
                    Add New Location
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Add official campus places for student activities.
                </p>

                <form action="{{ route('admin.locations.store') }}"
                    method="POST"
                    class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Location Name
                        </label>

                        <input id="name" name="name" type="text"
                            value="{{ old('name') }}"
                            maxlength="150"
                            placeholder="e.g. Campus Library"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Description
                        </label>

                        <textarea id="description" name="description"
                            rows="3" maxlength="1000" required
                            placeholder="Describe this campus location..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="rounded-xl bg-blue-700 px-6 py-3 font-semibold text-white transition hover:bg-blue-800">
                        Add Location
                    </button>
                </form>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 p-6">
                    <h3 class="text-lg font-bold text-slate-800">
                        Existing Locations
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $locations->count() }} location(s) registered
                    </p>
                </div>

                @forelse ($locations as $location)
                    <div class="flex flex-col justify-between gap-4 border-b border-slate-100 p-6 last:border-b-0 sm:flex-row sm:items-center">
                        <div>
                            <h4 class="font-bold text-slate-800">
                                {{ $location->name }}
                            </h4>

                            <p class="mt-1 text-sm text-slate-600">
                                {{ $location->description ?: 'No description provided.' }}
                            </p>

                            <p class="mt-2 text-xs text-slate-500">
                                Used by {{ $location->events_count }} event(s)
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.locations.edit', $location) }}"
                                class="rounded-lg border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 hover:bg-blue-50">
                                Edit
                            </a>

                            <form action="{{ route('admin.locations.destroy', $location) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this location?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="font-semibold text-slate-700">
                            No locations added yet.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Use the form above to add your first campus location.
                        </p>
                    </div>
                @endforelse
            </section>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Manage Locations
            </h1>
            <p class="text-gray-600 mt-1">
                Add and manage locations for campus events.
            </p>
        </div>

        @if (session('status'))
            <div class="p-3 rounded bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-3 rounded bg-red-100 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border rounded-xl p-5 space-y-4">
            <h2 class="text-lg font-semibold">Add New Location</h2>

            <form method="POST"
                  action="{{ route('admin.locations.store') }}"
                  class="space-y-4">
                @csrf

                <div>
                    <label for="name"
                           class="block text-sm font-medium mb-1">
                        Location Name
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        placeholder="e.g. PUP Calauan Main Building"
                        maxlength="150"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                <div>
                    <label for="description"
                           class="block text-sm font-medium mb-1">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        maxlength="1000"
                        required
                        placeholder="Describe where the location is."
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('description') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700"
                >
                    Add Location
                </button>
            </form>
        </div>

        <div class="bg-white border rounded-xl p-5">
            <h2 class="text-lg font-semibold mb-4">Existing Locations</h2>

            @forelse ($locations as $location)
                <div class="flex flex-col sm:flex-row sm:items-center
                            justify-between gap-3 py-4 border-b last:border-b-0">

                    <div>
                        <p class="font-semibold text-gray-800">
                            {{ $location->name }}
                        </p>

                        <p class="text-sm text-gray-600 mt-1">
                            {{ $location->description }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $location->events_count }}
                            {{ $location->events_count === 1 ? 'event' : 'events' }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a
                            href="{{ route('admin.locations.edit', $location) }}"
                            class="text-indigo-600 hover:underline"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.locations.destroy', $location) }}"
                            onsubmit="return confirm('Are you sure you want to delete this location?')"
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
                    No locations added yet. Use the form above to add your first location.
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>

