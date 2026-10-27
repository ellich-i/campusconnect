
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Manage Users
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    View registered users and manage their roles.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-blue-600 bg-white text-blue-600 hover:bg-blue-50 transition">
                ← Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 space-y-6">

        @if (session('status'))
            <div class="p-3 rounded-lg bg-green-100 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        @error('role')
            <div class="p-3 rounded-lg bg-red-100 text-red-700">
                {{ $message }}
            </div>
        @enderror

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="p-5 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    Registered Users
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Update a user's role and click Save Changes.
                </p>
            </div>

            @forelse ($users as $u)
                <form method="POST"
                      action="{{ route('admin.users.role', $u) }}"
                      class="p-5 border-b last:border-b-0 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    @csrf
                    @method('PATCH')

                    <div class="min-w-0">
                        <p class="font-semibold text-gray-800">
                            {{ $u->name }}
                        </p>
                        <p class="text-sm text-gray-500 break-all">
                            {{ $u->email }}
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                        <select name="role"
                                class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            @foreach (['student', 'admin'] as $r)
                                <option value="{{ $r }}" @selected($u->role === $r)>
                                    {{ ucfirst($r) }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            @empty
                <div class="p-8 text-center">
                    <p class="text-gray-500">
                        No users found.
                    </p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
