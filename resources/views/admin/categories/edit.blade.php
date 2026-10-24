<x-app-layout>
    <div class="p-6 space-y-3">
        @error('name') <p class="text-red-600">{{ $message }}</p> @enderror

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="flex gap-2">
            @csrf @method('PUT')
            <input name="name" value="{{ old('name', $category->name) }}" required>
            <input name="description" value="{{ old('description', $category->description) }}">
            <button>Save</button>
        </form>
        <a href="{{ route('admin.categories.index') }}">Back</a>
    </div>
</x-app-layout>