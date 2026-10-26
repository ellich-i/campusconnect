
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            Edit Campus Location
        </h2>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <h3 class="text-lg font-bold text-slate-800">
                    Update Location Details
                </h3>

                <form action="{{ route('admin.locations.update', $location) }}"
                    method="POST"
                    class="mt-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">
                            Location Name
                        </label>

                        <input id="name" name="name" type="text"
                            value="{{ old('name', $location->name) }}"
                            maxlength="150"
                            required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Description
                        </label>

                        <textarea id="description" name="description"
                            rows="4" maxlength="1000" required
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500">{{ old('description', $location->description) }}</textarea>
                    </div>

                    <div class="flex flex-wrap gap-3 pt-2">
                        <button type="submit"
                            class="rounded-xl bg-blue-700 px-6 py-3 font-semibold text-white hover:bg-blue-800">
                            Save Changes
                        </button>

                        <a href="{{ route('admin.locations.index') }}"
                            class="rounded-xl border border-slate-300 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-50">
                            Cancel
                        </a>
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>
