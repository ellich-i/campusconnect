
<x-app-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">

            <a href="{{ route('dashboard') }}"
               class="mb-6 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800">
                <span>&larr;</span> Back to Dashboard
            </a>

            <div class="mb-7 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-800 to-blue-500 px-6 py-9 text-white shadow-lg sm:px-9">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-blue-100">
                    CampusConnect · Student Activities
                </p>
                <h1 class="mb-3 text-3xl font-extrabold sm:text-4xl">Edit Activity</h1>
                <p class="max-w-2xl text-sm leading-7 text-blue-50 sm:text-base">
                    Update your event details and keep participants informed.
                </p>
            </div>

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

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-9">
                <div class="mb-8">
                    <h2 class="text-xl font-extrabold text-slate-800">Event Information</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Update the fields below. Fields marked with * are required.
                    </p>
                </div>

                <form action="{{ route('events.update', $event) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="title" class="mb-2 block text-sm font-bold text-slate-700">Event Title *</label>
                        <input type="text" id="title" name="title"
                               value="{{ old('title', $event->title) }}"
                               maxlength="150" required
                               class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="description" class="mb-2 block text-sm font-bold text-slate-700">Event Description *</label>
                        <textarea id="description" name="description" rows="5"
                                  maxlength="2000" required
                                  class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8 border-t border-slate-100"></div>

                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-slate-800">Category and Location</h2>
                    </div>

                    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="category_id" class="mb-2 block text-sm font-bold text-slate-700">Category *</label>
                            <select id="category_id" name="category_id" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @selected((string) old('category_id', $event->category_id) === (string) $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location_id" class="mb-2 block text-sm font-bold text-slate-700">Location *</label>
                            <select id="location_id" name="location_id" required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                                <option value="">Select a location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}"
                                        @selected((string) old('location_id', $event->location_id) === (string) $location->id)>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-8 border-t border-slate-100"></div>

                    <div class="mb-6">
                        <h2 class="text-xl font-extrabold text-slate-800">Schedule and Capacity</h2>
                    </div>

                    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="event_date" class="mb-2 block text-sm font-bold text-slate-700">Event Date *</label>
                            <input type="date" id="event_date" name="event_date"
                                   value="{{ old('event_date', $event->event_date ? \Illuminate\Support\Carbon::parse($event->event_date)->format('Y-m-d') : '') }}"
                                   required
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('event_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="capacity" class="mb-2 block text-sm font-bold text-slate-700">Maximum Participants *</label>
                            <input type="number" id="capacity" name="capacity"
                                   value="{{ old('capacity', $event->capacity) }}"
                                   min="1" max="500" required
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('capacity')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_time" class="mb-2 block text-sm font-bold text-slate-700">Start Time *</label>
                            <input type="time" id="start_time" name="start_time"
                                   value="{{ old('start_time', $event->start_time ? substr((string) $event->start_time, 0, 5) : '') }}"
                                   required
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('start_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="mb-2 block text-sm font-bold text-slate-700">End Time *</label>
                            <input type="time" id="end_time" name="end_time"
                                   value="{{ old('end_time', $event->end_time ? substr((string) $event->end_time, 0, 5) : '') }}"
                                   required
                                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 outline-none focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                            @error('end_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex min-h-12 items-center justify-center rounded-xl bg-slate-100 px-6 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex min-h-12 items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-bold text-white shadow-md shadow-blue-200 transition hover:bg-blue-700">
                            Save Changes <span aria-hidden="true">&rarr;</span>
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
