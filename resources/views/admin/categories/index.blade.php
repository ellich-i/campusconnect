<x-app-layout>
    <div class="p-6 space-y-4">
        @if (session('status')) <p>{{ session('status') }}</p> @endif
        @error('delete') <p class="text-red-600">{{ $message }}</p> @enderror
        @error('name') <p class="text-red-600">{{ $message }}</p> @enderror

        <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2">
            @csrf
            <input name="name" value="{{ old('name') }}" placeholder="Name" required>
            <input name="description" value="{{ old('description') }}" placeholder="Description">
            <button>Add</button>
        </form>

        @foreach ($categories as $c)
            <div class="flex gap-3">
                <span>{{ $c->name }} ({{ $c->events_count }} events)</span>
                <a href="{{ route('admin.categories.edit', $c) }}">Edit</a>
                <form method="POST" action="{{ route('admin.categories.destroy', $c) }}">
                    @csrf @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>