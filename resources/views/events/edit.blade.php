<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-6 p-6">
        <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-blue-600">&larr; Back to activity</a>

        <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Edit activity</h1>
            <p class="mt-1 text-sm text-gray-500">Update the details below. Fields marked with * are required.</p>

            {{-- Show all validation errors in one place --}}
            @if ($errors->any())
                <div class="mt-4 rounded-lg bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('events.update', $event) }}" class="mt-6 space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700">Event title *</label>
                    <input id="title" name="title" type="text" required maxlength="150"
                           value="{{ old('title', $event->title) }}"
                           class="mt-1 w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">Description *</label>
                    <textarea id="description" name="description" rows="4" required maxlength="2000"
                              class="mt-1 w-full rounded-lg border-gray-300">{{ old('description', $event->description) }}</textarea>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700">Category *</label>
                        <select id="category_id" name="category_id" required class="mt-1 w-full rounded-lg border-gray-300">
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}" @selected(old('category_id', $event->category_id) == $c->id)>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="location_id" class="block text-sm font-semibold text-gray-700">Location *</label>
                        <select id="location_id" name="location_id" required class="mt-1 w-full rounded-lg border-gray-300">
                            @foreach ($locations as $l)
                                <option value="{{ $l->id }}" @selected(old('location_id', $event->location_id) == $l->id)>{{ $l->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-3">
                    <div>
                        <label for="event_date" class="block text-sm font-semibold text-gray-700">Date *</label>
                        <input id="event_date" name="event_date" type="date" required
                               value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}"
                               class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-semibold text-gray-700">Start time *</label>
                        <input id="start_time" name="start_time" type="time" required
                               value="{{ old('start_time', substr($event->start_time, 0, 5)) }}"
                               class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-semibold text-gray-700">End time *</label>
                        <input id="end_time" name="end_time" type="time" required
                               value="{{ old('end_time', substr($event->end_time, 0, 5)) }}"
                               class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-semibold text-gray-700">Participant limit *</label>
                    <input id="capacity" name="capacity" type="number" min="1" max="500" required
                           value="{{ old('capacity', $event->capacity) }}"
                           class="mt-1 w-full rounded-lg border-gray-300 sm:w-40">
                    <p class="mt-1 text-xs text-gray-500">Cannot be lower than the number of students who already joined.</p>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white">Save changes</button>
                    <a href="{{ route('events.show', $event) }}" class="rounded-lg px-5 py-2 font-semibold text-gray-600 ring-1 ring-gray-300">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>