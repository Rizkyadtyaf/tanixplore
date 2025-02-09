<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="w-full min-h-screen flex items-center justify-center px-4">
            <div class="w-full sm:w-[400px] md:w-[500px] lg:w-[500px]">
                <div class="w-full flex justify-center">
                    <img src="{{ asset('images/logo1.png') }}" alt="logo" width="200">
                </div>
                <div
                    class="w-full sm:w-[400px] md:w-[500px] px-6 py-4 rounded-lg shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)]">
                    {{-- Name --}}
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Enter your full name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" placeholder="Enter your email address" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Phone --}}
                    <div class="mb-6">
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" required placeholder="Enter your phone number" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" placeholder="Enter a password (min 8 characters)" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm your password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    {{-- Show Password Checkbox --}}
                    <div class="inline-flex items-center mb-6">
                        <input type="checkbox" id="show-passwords"
                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-500 focus:ring-green-500 ">
                        <x-input-label for="show-passwords" class="ml-2" :value="__('Show Passwords')" />
                    </div>

                    {{-- Role Selection --}}
                    <div class="mb-6">
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm/6 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 md:p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="user" selected>{{ __('Buyer') }}</option>
                            <option value="owner">{{ __('Seller') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    {{-- Button Register --}}
                    <x-primary-button>
                        {{ __('Sign Up') }}
                    </x-primary-button>

                    <div class="flex justify-center text-slate-400 text-sm md:text-md mt-4">
                        Already have an account?&nbsp;
                        <a class="underline text-sm text-slate-400 hover:text-[#089101] rounded-md focus:outline-none"
                            href="{{ route('login') }}">
                            {{ __('Login in Here!') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.getElementById('show-passwords').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('password_confirmation');
            if (this.checked) {
                passwordInput.type = 'text';
                confirmPasswordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirmPasswordInput.type = 'password';
            }
        });
    </script>
</x-guest-layout>
