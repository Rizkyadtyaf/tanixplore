<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>taniXplore</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Google Maps -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&libraries=marker,places&loading=async&callback">
    </script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Vite & Alpine.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Custom Styles -->
    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        .bg-gradient-overlay {
            background-image:
                linear-gradient(to right, rgba(14, 33, 7, 0.35), rgba(0, 0, 0, 0) 70%),
                linear-gradient(to bottom, rgba(10, 10, 10, 0.5), rgba(24, 24, 24, 0.8) 70%);
        }

        .max-w-7xl {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        @media (max-width: 1280px) {
            .max-w-7xl {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 768px) {
            .max-w-7xl {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#EBEBEB] dark:bg-[#1A1A1A] w-full overflow-x-hidden">
        @if (request()->routeIs('dashboard'))
            <!-- Hero Section with Background -->
            <div class="relative bg-cover bg-center bg-no-repeat min-h-[75vh]"
                style="background-image: url('{{ asset('images/background.jpg') }}')">
                <div class="bg-gradient-overlay absolute inset-0"></div>

                <!-- Navigation -->
                @include('layouts.navigation')

                <!-- Alert Notification -->
                @if (session('success'))
                    <div class="fixed top-0 left-1/2 transform -translate-x-1/2 w-full sm:w-96 z-50 pt-20"
                        x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-y-0"
                        x-transition:leave-end="opacity-0 transform -translate-y-2">
                        <div class="bg-green-50 border border-green-200 shadow-lg rounded-lg mx-4">
                            <div class="p-4">
                                <div class="flex items-center justify-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Hero Content -->
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-12">
                    <div class="text-white max-w-lg">
                        <h1 class="text-4xl md:text-6xl font-bold leading-tight cursor-default animate-fade-in">
                            Organic Farming<br>and Agriculture
                        </h1>
                        <p class="mt-4 text-base md:text-lg text-gray-300 cursor-default">
                            We are committed to providing high-quality and organic agricultural products.
                            Learn more about our vision, mission, and services on the About Us page.
                        </p>
                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <a href="{{ route('dashboard') }}#product-section"
                                class="inline-flex justify-center items-center bg-green-600 text-white hover:bg-[#FBC91A] hover:text-black font-medium py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                                <span>View All Products</span>
                                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="{{ route('about') }}"
                                class="inline-flex justify-center items-center bg-transparent border-2 border-[#FBC91A] text-[#FBC91A] hover:border-white hover:text-white font-medium py-2 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
                                About Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section -->
            <div class="bg-gradient-to-r from-green-500 to-yellow-400 w-full py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid md:grid-cols-3 gap-12">
                        <!-- Left Text Section -->
                        <div class="flex flex-col justify-center items-center text-center md:text-left">
                            <h2 class="text-3xl font-semibold text-white mb-2">Welcome to TaniXplore</h2>
                            <p class="text-lg text-gray-100">
                                A platform where you can connect with Indonesian farmers and explore agricultural
                                products
                                for your business needs.
                            </p>
                        </div>

                        <!-- Center Logo Section -->
                        <div class="flex justify-center items-center relative">
                            <img src="{{ asset('images/logo4.png') }}" alt="Logo"
                                class="w-48 h-48 md:w-56 md:h-56 shadow-xl rounded-full border-8 border-white transform transition-transform duration-500 hover:scale-105">
                        </div>

                        <!-- Right Text Section -->
                        <div class="flex flex-col justify-center items-center text-center md:text-right">
                            <h2 class="text-3xl font-semibold text-white mb-2">Your Trusted Partner</h2>
                            <p class="text-lg text-gray-100">
                                We offer a variety of agricultural product marketing and purchasing services that
                                connect you directly with Indonesian farmers.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include('layouts.navigation')
        @endif

        <!-- Header -->
        @isset($header)
            <header>
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
