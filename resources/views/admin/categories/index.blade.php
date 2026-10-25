
<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Manage Categories
            </h1>
            <p class="text-gray-600 mt-1">
                Add and manage categories for campus events.
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
            <h2 class="text-lg font-semibold">Add New Category</h2>

            <form method="POST"
                  action="{{ route('admin.categories.store') }}"
                  class="flex flex-col sm:flex-row gap-3">
                @csrf

                <input
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Category name"
                    maxlength="100"
                    required
                    class="flex-1 rounded-lg border-gray-300"
                >

                <input
                    name="description"
                    value="{{ old('description') }}"
                    placeholder="Description (optional)"
                    class="flex-1 rounded-lg border-gray-300"
                >

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700"
                >
                    Add Category
                </button>
            </form>
        </div>

        <div class="bg-white border rounded-xl p-5">
            <h2 class="text-lg font-semibold mb-4">Existing Categories</h2>

            @forelse ($categories as $category)
                <div class="flex flex-col sm:flex-row sm:items-center
                            justify-between gap-3 py-4 border-b last:border-b-0">

                    <div>
                        <p class="font-semibold text-gray-800">
                            {{ $category->name }}
                        </p>

                        @if ($category->description)
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $category->description }}
                            </p>
                        @endif

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $category->events_count }}
                            {{ $category->events_count === 1 ? 'event' : 'events' }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <a
                            href="{{ route('admin.categories.edit', $category) }}"
                            class="text-indigo-600 hover:underline"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.categories.destroy', $category) }}"
                            onsubmit="return confirm('Delete this category?')"
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
                    No categories added yet.
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>
