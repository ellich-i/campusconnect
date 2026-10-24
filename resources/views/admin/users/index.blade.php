<x-app-layout>
    <div class="p-6 space-y-3">
        @if (session('status')) <p>{{ session('status') }}</p> @endif
        @error('role') <p class="text-red-600">{{ $message }}</p> @enderror

        @foreach ($users as $u)
            <form method="POST" action="{{ route('admin.users.role', $u) }}" class="flex gap-3">
                @csrf @method('PATCH')
                <span>{{ $u->name }} ({{ $u->email }})</span>
                <select name="role">
                    @foreach (['student', 'admin'] as $r)
                        <option value="{{ $r }}" @selected($u->role === $r)>{{ $r }}</option>
                    @endforeach
                </select>
                <button>Save</button>
            </form>
        @endforeach

        {{ $users->links() }}
    </div>
</x-app-layout>