
<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $loginType === 'admin' ? 'Admin Login' : 'Student Login' }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ $loginType === 'admin'
                ? 'Sign in with your administrator account.'
                : 'Sign in with your student account.' }}
        </p>
    </div>

    <div class="mb-6 grid grid-cols-2 gap-3">
        <a
            href="{{ route('student.login') }}"
            class="rounded-lg border px-4 py-3 text-center text-sm font-semibold transition
            {{ $loginType === 'student'
                ? 'border-indigo-600 bg-indigo-600 text-white'
                : 'border-gray-300 text-gray-700 hover:bg-gray-50' }}"
        >
            Student
        </a>

        <a
            href="{{ route('admin.login') }}"
            class="rounded-lg border px-4 py-3 text-center text-sm font-semibold transition
            {{ $loginType === 'admin'
                ? 'border-indigo-600 bg-indigo-600 text-white'
                : 'border-gray-300 text-gray-700 hover:bg-gray-50' }}"
        >
            Admin
        </a>
    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input
            type="hidden"
            name="login_type"
            value="{{ $loginType }}"
        >

        <div>
            <x-input-label for="email" value="Email Address" />

            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />

            <x-text-input
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <div class="mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Remember me
                </span>
            </label>
        </div>

        <div class="mt-4 flex items-center justify-end">
            @if (Route::has('password.request'))
                <a
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900"
                    href="{{ route('password.request') }}"
                >
                    Forgot your password?
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ $loginType === 'admin' ? 'Admin Login' : 'Student Login' }}
            </x-primary-button>
        </div>
    </form>

    @if ($loginType === 'student' && Route::has('register'))
        <p class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?

            <a
                href="{{ route('register') }}"
                class="font-semibold text-indigo-600 underline hover:text-indigo-800"
            >
                Register
            </a>
        </p>
    @endif
</x-guest-layout>
