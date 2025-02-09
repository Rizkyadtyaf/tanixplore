<x-guest-layout>
    <div class="w-full min-h-screen flex items-center justify-center px-4 bg-gray-100">
        <div class="w-full sm:w-[400px] md:w-[500px] lg:w-[700px] p-4">
            <div class="py-6 px-8 rounded-lg bg-white shadow-lg dark:bg-gray-800">

                <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 dark:text-gray-200 mb-4">
                    {{ __('Email Verification') }}
                </h2>

                <div class="mb-4 text-sm md:text-base text-gray-600 dark:text-gray-400 text-center">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm md:text-base text-green-600 text-center">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                        @csrf
                        <x-primary-button class="w-full">
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf

                        <button type="submit"
                            class="w-full text-center underline text-sm md:text-md lg:text-lg text-gray-600 hover:text-gray-900 rounded-md transition duration-200">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
