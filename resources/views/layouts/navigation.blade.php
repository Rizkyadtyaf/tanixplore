<nav x-data="{ open: false }" class="fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div
            class="flex justify-between items-center bg-gradient-to-r from-[#FBC91A] to-[#2a8008] rounded-full shadow-lg py-2">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="w-8 h-8 sm:w-10 sm:h-10 ml-3">
                    <span class="text-lg sm:text-xl font-bold block sm:hidden md:block text-[#1F6306]">taniXplore</span>
                </a>
            </div>

            <!-- Desktop Menu Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6 flex-1 justify-center">
                @if (Auth::user()->role === 'owner')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('product.shop')" :active="request()->routeIs('product.shop')">
                        <i class="fas fa-store mr-2"></i>{{ __('Shop') }}
                    </x-nav-link>
                    <x-nav-link :href="route('product.create')" :active="request()->routeIs('product.create')">
                        <i class="fas fa-plus-circle mr-2"></i>{{ __('Add Product') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        <i class="fas fa-info-circle mr-2"></i>{{ __('About') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        <i class="fas fa-info-circle mr-2"></i>{{ __('About') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Right Side Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center pr-4">
                <x-dropdown align="right">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center px-3 py-2 text-white hover:text-gray-200 transition duration-150 ease-in-out">
                            <i class="fas fa-user-circle mr-2"></i>{{ Auth::user()->name }}
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="mt-2 text-white mb-2">
                            <i class="fas fa-cogs mr-2"></i>{{ __('Settings') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="hover:text-red-600">
                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for mobile -->
            <div class="flex flex-row items-center space-x-2 sm:hidden">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center space-x-2 text-white hover:text-gray-200 transition duration-150 ease-in-out">
                    <i class="fas fa-user-circle mr-2"></i>{{ Auth::user()->name }}
                </a>
                <div class="">
                    <button @click="open = !open"
                        class="p-2 text-white hover:text-gray-200 transition duration-150 ease-in-out">
                        <i class="fas" :class="{ 'fa-times': open, 'fa-bars': !open }"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="sm:hidden bg-[#2a8008] mx-3 mb-4 rounded-xl shadow-md transform transition-all duration-300 ease-in-out">
        <div class="space-y-2 py-3">
            @if (Auth::user()->role === 'owner')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-tachometer-alt mr-3"></i>{{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('product.shop')" :active="request()->routeIs('product.shop')">
                    <i class="fas fa-store mr-3"></i>{{ __('Shop') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('product.create')" :active="request()->routeIs('product.create')">
                    <i class="fas fa-plus-circle mr-3"></i>{{ __('Add Product') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    <i class="fas fa-info-circle mr-3"></i>{{ __('About') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-tachometer-alt mr-3"></i>{{ __('Dashboard') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    <i class="fas fa-info-circle mr-3"></i>{{ __('About') }}
                </x-responsive-nav-link>
            @endif
        </div>
        <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            <i class="fas fa-cogs mr-2"></i>{{ __('Settings') }}
        </x-responsive-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fas fa-sign-out-alt mr-3"></i>{{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>

</nav>

<!-- Spacer for fixed navbar -->
<div class="h-14"></div>
