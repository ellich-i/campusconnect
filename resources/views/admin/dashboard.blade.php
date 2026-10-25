
<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-wider text-blue-600">
                    CampusConnect Administration
                </p>

                <h1 class="mt-2 text-3xl font-bold text-slate-800">
                    Admin Dashboard
                </h1>

                <p class="mt-2 text-slate-500">
                    Monitor campus activities and manage your platform.
                </p>
            </div>

            {{-- Statistics --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Total Users --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Total Users
                    </p>

                    <p class="mt-3 text-3xl font-bold text-slate-800">
                        {{ $stats['users'] }}
                    </p>

                    <p class="mt-2 text-sm text-slate-400">
                        Registered accounts
                    </p>
                </div>

                {{-- Total Events --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Total Events
                    </p>

                    <p class="mt-3 text-3xl font-bold text-blue-600">
                        {{ $stats['events'] }}
                    </p>

                    <p class="mt-2 text-sm text-slate-400">
                        Campus activities
                    </p>
                </div>

                {{-- Cancelled Events --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Cancelled Events
                    </p>

                    <p class="mt-3 text-3xl font-bold text-red-500">
                        {{ $stats['cancelled'] }}
                    </p>

                    <p class="mt-2 text-sm text-slate-400">
                        Events marked cancelled
                    </p>
                </div>

                {{-- Categories --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">
                        Categories
                    </p>

                    <p class="mt-3 text-3xl font-bold text-indigo-600">
                        {{ $stats['categories'] }}
                    </p>

                    <p class="mt-2 text-sm text-slate-400">
                        Activity categories
                    </p>
                </div>

            </div>

            {{-- Management Links --}}
            <div class="mt-10">
                <h2 class="text-xl font-bold text-slate-800">
                    Manage CampusConnect
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Choose a section to manage the platform.
                </p>

                <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                    {{-- Categories --}}
                    <a href="{{ route('admin.categories.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl font-bold text-blue-700">
                            C
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-800">
                            Categories
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Organize activities into categories.
                        </p>

                        <span class="mt-5 inline-block text-sm font-semibold text-blue-600 group-hover:underline">
                            Manage categories →
                        </span>
                    </a>

                    {{-- Users --}}
                    <a href="{{ route('admin.users.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-indigo-300 hover:shadow-md">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-xl font-bold text-indigo-700">
                            U
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-800">
                            Users
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            View accounts and manage user roles.
                        </p>

                        <span class="mt-5 inline-block text-sm font-semibold text-indigo-600 group-hover:underline">
                            Manage users →
                        </span>
                    </a>

                    {{-- Events --}}
                    <a href="{{ route('admin.events.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-sky-300 hover:shadow-md">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 text-xl font-bold text-sky-700">
                            E
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-800">
                            Events
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Review and moderate campus events.
                        </p>

                        <span class="mt-5 inline-block text-sm font-semibold text-sky-600 group-hover:underline">
                            Manage events →
                        </span>
                    </a>

                    {{-- Locations --}}
                    <a href="{{ route('admin.locations.index') }}"
                       class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-emerald-300 hover:shadow-md">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-xl font-bold text-emerald-700">
                            L
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-800">
                            Locations
                        </h3>

                        <p class="mt-2 text-sm text-slate-500">
                            Add and manage campus event locations.
                        </p>

                        <span class="mt-5 inline-block text-sm font-semibold text-emerald-600 group-hover:underline">
                            Manage locations →
                        </span>
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
