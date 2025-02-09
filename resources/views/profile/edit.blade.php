<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-slate-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
