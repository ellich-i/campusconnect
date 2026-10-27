<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-blue-600">
                CAMPUSCONNECT
            </p>
            <h2 class="mt-1 text-2xl font-bold text-gray-800">
                Student Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">

            {{-- Welcome Section --}}
            <section class="overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 to-sky-500 p-8 text-white shadow-lg sm:p-10">
                <p class="text-sm font-medium text-blue-100">
                    WELCOME TO CAMPUSCONNECT
                </p>

                <h1 class="mt-3 text-3xl font-bold sm:text-4xl">
                    Hello, {{ Auth::user()->name }}!
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-6 text-blue-50 sm:text-base">
                    Vacant hours? Connect, engage in campus fun activities.
                    Discover events, meet fellow students, and make your free
                    time more meaningful.
                </p>

                <a href="{{ route('events.index') }}"
                   class="mt-6 inline-flex items-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-700 transition hover:bg-blue-50">
                    Explore Activities
                    <span class="ml-2">→</span>
                </a>
            </section>

            {{-- Quick Actions --}}
            <section>
                <div class="mb-5">
                    <h3 class="text-xl font-bold text-gray-800">
                        Quick Actions
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        What would you like to do today?
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    <a href="{{ route('events.index') }}"
                       class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                            📅
                        </div>

                        <h4 class="mt-4 text-lg font-bold text-gray-800">
                            Browse Activities
                        </h4>

                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Discover campus events and find activities
                            that match your interests.
                        </p>

                        <span class="mt-4 inline-block text-sm font-semibold text-blue-600">
                            View activities →
                        </span>
                    </a>

                    <a href="{{ route('events.create') }}"
                       class="group rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-100 text-2xl">
                            ✨
                        </div>

                        <h4 class="mt-4 text-lg font-bold text-gray-800">
                            Create an Event
                        </h4>

                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Organize an activity and invite other students
                            to participate.
                        </p>

                        <span class="mt-4 inline-block text-sm font-semibold text-blue-600">
                            Create activity →
                        </span>
                    </a>

                </div>
            </section>

            {{-- Getting Started --}}
            <section class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8">
                <h3 class="text-xl font-bold text-gray-800">
                    Get Started
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    CampusConnect helps you make the most of your vacant
                    hours through student-led campus activities.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('events.index') }}"
                       class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Find an Activity
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                        Edit Profile
                    </a>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
