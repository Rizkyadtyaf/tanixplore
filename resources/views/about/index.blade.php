<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>About Us - taniXplore</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#EBEBEB] dark:bg-[#1A1A1A]">
        <!-- Background Section for About Page -->
        <div style="background-image: linear-gradient(to right, rgba(14, 33, 7, 0.35), rgba(0, 0, 0, 0) 70%), 
                    linear-gradient(to bottom, rgba(10, 10, 10, 0.5), rgba(24, 24, 24, 0.8) 70%), 
                    url('{{ asset('images/bg-about.jpg') }}');"
            class="bg-cover bg-center bg-no-repeat min-h-[50vh] flex items-center">
            @include('layouts.navigation')
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 text-white">
                <h1 class="text-4xl sm:text-6xl font-bold leading-tight">About Us</h1>
                <p class="mt-4 text-lg sm:text-xl">Welcome to taniXplore, a platform dedicated to supporting local
                    agriculture and
                    connecting farmers with buyers directly. We aim to make it easier for you to discover
                    high-quality farm products, explore seller locations, and access detailed information about
                    available goods.
                </p>
            </div>
        </div>

        <!-- About Content Section -->
        <div class="w-full bg-[#EBEBEB] dark:bg-[#1A1A1A] text-black dark:text-white min-h-[50vh] py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
                <ol class="list-decimal list-inside mb-6">
                    <li>To enhance the welfare of local farmers by providing greater market access.</li>
                    <li>To help consumers easily find the best farm products.</li>
                    <li>To promote transparency and trust through complete and accurate product information.</li>
                </ol>

                <h2 class="text-2xl font-semibold py-4">What We Offer</h2>
                <ol class="list-decimal list-inside mb-4">
                    <li><b>Marketing Network for High Quality Agricultural Products:</b> From fresh products to other
                        agricultural products, all in one place.</li>
                    <li><b>Seller Locations:</b> Easily find local farmers near you.</li>
                    <li><b>Detailed Product Descriptions:</b> Access comprehensive details about every product before
                        making a purchase.</li>
                </ol>
                <p class="mt-4">
                    Join us on a journey to create a better agricultural ecosystem. Together, we can support local
                    farmers and bring the best harvests straight to your table!
                </p>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
