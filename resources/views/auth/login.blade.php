<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Pesan Error -->
    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-600 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="relative z-50">
        @csrf
        <div class="w-full min-h-screen flex items-center justify-center px-4">
            <div class="w-full sm:w-[400px] md:w-[500px] lg:w-[500px] p-2 sm:p-4">
                <div class="w-full flex justify-center text-xl">
                    <img src="{{ asset('images/logo1.png') }}" alt="" class="w-[200px]">
                </div>
                <div
                    class="py-4 px-6 rounded-lg
                        shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] ">

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="mb-4 p-4 text-sm text-green-600 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- email --}}
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            placeholder="Enter your email address" :value="old('email')" autocomplete="username" required />
                        @error('email')
                            <div class="mt-2 text-sm text-red-600 bg-red-100 rounded-lg p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- password --}}
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            placeholder="Enter your password" required autocomplete="current-password" />
                        @error('password')
                            <div class="mt-2 text-sm text-red-600 bg-red-100 rounded-lg p-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Show Password Checkbox --}}
                    <div class="inline-flex items-center">
                        <input type="checkbox" id="show-passwords"
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-500 focus:ring-green-500 ">
                        <x-input-label for="show-passwords" class="ml-2" :value="__('Show Passwords')" />
                    </div>

                    {{-- forgot pass --}}
                    <div class="flex items-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-slate-400 hover:text-slate-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    {{-- login --}}
                    <x-primary-button class="w-full justify-center mt-4">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <div class="flex justify-center text-slate-400 text-sm md:text-md mt-4">
                        Don't have an account?&nbsp;
                        <a class="underline text-sm text-slate-400 hover:text-[#089101] rounded-md focus:outline-none"
                            href="{{ route('register') }}">
                            {{ __('Sign up now!') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('show-passwords').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
</x-guest-layout>
