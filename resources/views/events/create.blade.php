```php
<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">

            {{-- Back button --}}
            <a href="{{ route('events.index') }}"
               class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800">
                <span>&larr;</span>
                Back to Activities
            </a>

            {{-- Header --}}
            <div class="mb-7 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-800 to-blue-500 px-6 py-9 text-white shadow-lg sm:px-9">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-blue-100">
                    CampusConnect · Student Activities
                </p>

                <h1 class="mb-3 text-3xl font-extrabold sm:text-4xl">
                    Create an Event
                </h1>

                <p class="max-w-2xl text-sm leading-7 text-blue-50 sm:text-base">
                    Bring students together! Create an activity, share your interests,
                    and make vacant campus hours more productive.
                </p>
            </div>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5 text-sm text-red-700">
                    <p class="font-bold">Please check the following fields:</p>

                    <ul class="mt-2 list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-9">

                <div class="mb-8">
                    <h2 class="text-xl font-extrabold text-slate-800">
                        Event Information
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Complete the details below to let other students discover your activity.
                        Fields marked with <span class="font-bold text-red-500">*</span> are required.
                    </p>
                </div>

                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    {{-- Event title --}}
                    <div class="mb-6">
                        <label for="title" class="mb-2 block text-sm font-bold text-slate-700">
                            Event Title <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            maxlength="150"
                            placeholder="e.g. Campus Chess Meetup"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                        >

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-8">
                        <label for="description" class="mb-2 block text-sm font-bold text-slate-700">
                            Event Description <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            maxlength="2000"
                            placeholder="Describe your activity, its purpose, and what participants can expect..."
                            required
                            class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                        >{{ old('description') }}</textarea>

                        <p class="mt-2 text-xs text-slate-400">
                            Maximum of 2,000 characters.
                        </p>

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8 border-t border-slate-100"></div>

                    {{-- Category and location --}}
                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-slate-800">
                            Category and Location
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Choose the activity category and where it will take place.
                        </p>
                    </div>

                    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2">

                        {{-- Category --}}
                        <div>
                            <label for="category_id" class="mb-2 block text-sm font-bold text-slate-700">
                                Category <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="category_id"
                                name="category_id"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >
                                <option value="">Select a category</option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('category_id') == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($categories->isEmpty())
                                <p class="mt-2 text-xs text-amber-600">
                                    No categories available. Ask the administrator to add categories first.
                                </p>
                            @endif

                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div>
                            <label for="location_id" class="mb-2 block text-sm font-bold text-slate-700">
                                Location <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="location_id"
                                name="location_id"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >
                                <option value="">Select a location</option>

                                @foreach ($locations as $location)
                                    <option
                                        value="{{ $location->id }}"
                                        @selected(old('location_id') == $location->id)
                                    >
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($locations->isEmpty())
                                <p class="mt-2 text-xs text-amber-600">
                                    No locations available. Ask the administrator to add locations first.
                                </p>
                            @endif

                            @error('location_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8 border-t border-slate-100"></div>

                    {{-- Schedule and capacity --}}
                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-slate-800">
                            Schedule and Capacity
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Set the event date, starting time, ending time, and maximum number of participants.
                        </p>
                    </div>

                    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2">

                        {{-- Event date --}}
                        <div>
                            <label for="event_date" class="mb-2 block text-sm font-bold text-slate-700">
                                Event Date <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="date"
                                id="event_date"
                                name="event_date"
                                value="{{ old('event_date') }}"
                                min="{{ today()->toDateString() }}"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('event_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Capacity --}}
                        <div>
                            <label for="capacity" class="mb-2 block text-sm font-bold text-slate-700">
                                Maximum Participants <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="capacity"
                                name="capacity"
                                value="{{ old('capacity', 10) }}"
                                min="1"
                                max="500"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            <p class="mt-2 text-xs text-slate-400">
                                Minimum 1 and maximum 500 participants.
                            </p>

                            @error('capacity')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Start time --}}
                        <div>
                            <label for="start_time" class="mb-2 block text-sm font-bold text-slate-700">
                                Start Time <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="time"
                                id="start_time"
                                name="start_time"
                                value="{{ old('start_time') }}"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            @error('start_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- End time --}}
                        <div>
                            <label for="end_time" class="mb-2 block text-sm font-bold text-slate-700">
                                End Time <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="time"
                                id="end_time"
                                name="end_time"
                                value="{{ old('end_time') }}"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                            >

                            <p class="mt-2 text-xs text-slate-400">
                                Must be later than the start time.
                            </p>

                            @error('end_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
                        <a
                            href="{{ route('events.index') }}"
                            class="inline-flex min-h-12 items-center justify-center rounded-xl bg-slate-100 px-6 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-200"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-bold text-white shadow-md shadow-blue-200 transition hover:bg-blue-700"
                        >
                            Create Event
                            <span aria-hidden="true">&rarr;</span>
                        </button>
                    </div>
                </form>
            </div>

            <p class="mt-6 text-center text-xs leading-6 text-slate-400">
                CampusConnect · Connect with your campus community.
            </p>
        </div>
    </div>
</x-app-layout>
```