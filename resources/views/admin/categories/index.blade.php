
<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Back to Dashboard --}}
            <div>
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 rounded-xl border border-blue-100 bg-white px-5 py-3 text-sm font-bold text-blue-600 transition hover:bg-blue-50">
                    &larr; Back to Dashboard
                </a>
            </div>

            {{-- Page Heading --}}
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-widest text-blue-600">
                    CampusConnect · Administration
                </p>

                <h1 class="text-2xl font-extrabold text-slate-800">
                    Manage Categories
                </h1>

                <p class="mt-1 text-sm text-slate-600">
                    Add and manage categories for campus events.
                </p>
            </div>

            {{-- Success Message --}}
            @if (session('status'))
                <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add Category --}}
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800">
                    Add New Category
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Create a category students can use for campus activities.
                </p>

                <form method="POST"
                      action="{{ route('admin.categories.store') }}"
                      class="mt-5 flex flex-col gap-3 sm:flex-row">
                    @csrf

                    <input
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Category name"
                        maxlength="100"
                        required
                        class="min-w-0 flex-1 rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                    >

                    <input
                        name="description"
                        value="{{ old('description') }}"
                        placeholder="Description (optional)"
                        class="min-w-0 flex-1 rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:ring-blue-500"
                    >

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-700 px-6 py-3 font-semibold text-white transition hover:bg-blue-800"
                    >
                        + Add Category
                    </button>
                </form>
            </section>

            {{-- Existing Categories --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 p-6">
                    <h2 class="text-lg font-bold text-slate-800">
                        Existing Categories
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Manage your registered activity categories below.
                    </p>
                </div>

                @forelse ($categories as $category)
                    <div class="flex flex-col justify-between gap-4 border-b border-slate-100 p-6 last:border-b-0 sm:flex-row sm:items-center">

                        <div>
                            <p class="font-bold text-slate-800">
                                {{ $category->name }}
                            </p>

                            @if ($category->description)
                                <p class="mt-1 text-sm text-slate-600">
                                    {{ $category->description }}
                                </p>
                            @endif

                            <p class="mt-2 text-xs text-slate-500">
                                {{ $category->events_count }}
                                {{ $category->events_count === 1 ? 'event' : 'events' }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <a
                                href="{{ route('admin.categories.edit', $category) }}"
                                class="rounded-lg border border-blue-200 px-4 py-2 text-sm font-semibold text-blue-700 transition hover:bg-blue-50"
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
                                    class="rounded-lg border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                                >
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="font-semibold text-slate-700">
                            No categories added yet.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            Use the form above to add your first category.
                        </p>
                    </div>
                @endforelse
            </section>

        </div>
    </div>
</x-app-layout>
