
<x-app-layout>
    <div class="min-h-screen bg-[#f5f8ff] py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Back to Dashboard --}}
            <div class="mb-6">
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-blue-100 bg-white px-5 py-3 text-sm font-bold text-blue-600 transition hover:bg-blue-50"
                >
                    &larr; Back to Dashboard
                </a>
            </div>

            {{-- Page Header --}}
            <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-700 to-blue-500 px-8 py-8 text-white shadow-lg">
                <p class="mb-3 text-xs font-bold uppercase tracking-widest text-blue-100">
                    CampusConnect · Account Settings
                </p>

                <h1 class="text-3xl font-extrabold">
                    Profile Information
                </h1>

                <p class="mt-3 text-sm leading-6 text-blue-50">
                    Manage your account details and keep your profile updated.
                </p>
            </div>

            {{-- Profile Information --}}
            <div class="mb-6 rounded-2xl border border-blue-100 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="mb-6 rounded-2xl border border-blue-100 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="rounded-2xl border border-blue-100 bg-white p-6 shadow-sm sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
