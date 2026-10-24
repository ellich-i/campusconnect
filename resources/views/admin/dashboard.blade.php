<x-app-layout>
    <div class="p-6 space-y-3">
        <h1 class="text-xl font-bold">Admin Dashboard</h1>
        <p>
            Users: {{ $stats['users'] }} | Events: {{ $stats['events'] }}
            | Cancelled: {{ $stats['cancelled'] }} | Categories: {{ $stats['categories'] }}
        </p>
        <a href="{{ route('admin.categories.index') }}">Categories</a> |
        <a href="{{ route('admin.users.index') }}">Users</a> |
        <a href="{{ route('admin.events.index') }}">Events</a>
    </div>
</x-app-layout>