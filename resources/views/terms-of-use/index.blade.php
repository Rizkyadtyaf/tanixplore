<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Terms of Use - taniXplore</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#EBEBEB] dark:bg-[#1A1A1A]">
        <!-- Background Section for Terms of Use Page -->
        <div style="background-image: linear-gradient(to right, rgba(14, 33, 7, 0.35), rgba(0, 0, 0, 0) 70%), 
                    linear-gradient(to bottom, rgba(10, 10, 10, 0.5), rgba(24, 24, 24, 0.8) 70%), 
                    url('{{ asset('images/bg-about.jpg') }}');"
            class="bg-cover bg-center bg-no-repeat min-h-[50vh] flex items-center">
            @include('layouts.navigation')
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 text-white">
                <h1 class="text-4xl sm:text-6xl font-bold leading-tight">Terms of Use for taniXplore</h1>
                <p class="mt-4 text-lg sm:text-xl">Welcome to <strong class="text-green-600">taniXplore!</strong> These
                    Terms of Use govern your access to and use of our website
                    <strong class="text-green-600">https://tanixplore.com</strong> and the services we offer. By
                    accessing or using this website, you agree to comply with the applicable terms.
                </p>
            </div>
        </div>

        <!-- Terms of Use Content Section -->
        <div class="w-full bg-[#EBEBEB] dark:bg-[#1A1A1A] text-black dark:text-white min-h-[50vh] py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold mb-2">1. Acceptance of Terms</h2>
                <p class="mb-6">By accessing or using the website <strong
                        class="text-green-600">https://tanixplore.com</strong>
                    and its
                    services, you agree to comply with and be bound by these Terms of Use. If you do not
                    agree to these terms, you should not use the Website or Services.</p>

                <h2 class="text-2xl font-semibold mb-2">2. Changes to Terms</h2>
                <p class="mb-6">We reserve the right to update, modify, or change these Terms of Use at any time
                    without prior
                    notice. Any changes will be posted on this page with an updated "Last Revised" date. It is your
                    responsibility to review these Terms regularly to stay informed about any updates.</p>

                <h2 class="text-2xl font-semibold mb-2">3. Use of Website</h2>
                <p class="mb-2">You agree to use the Website and Services in accordance with all applicable local,
                    state, and
                    national laws and regulations. You are solely responsible for any product you upload or share
                    through the Website, and you must not:</p>
                <ul class="list-disc list-inside mb-6">
                    <li>Engage in any unlawful, fraudulent, or harmful activity.</li>
                    <li>Upload products that do not comply with our policies or infringe on the intellectual property
                        rights of third parties.</li>
                    <li>Use the Website for any purpose that could harm, disable, or impair its functionality.</li>
                </ul>

                <h2 class="text-2xl font-semibold mb-2">4. Intellectual Property</h2>
                <p class="mb-6">All content on the Website, including text, images, logos, and other materials, are
                    the property of
                    <strong class="text-green-600">TaniXplore</strong> or its licensors and are protected by copyright,
                    trademark, and other
                    intellectual property laws. You may not use, reproduce, or distribute any content from the Website
                    without prior written permission from us.
                </p>

                <h2 class="text-2xl font-semibold mb-2">5. Account Creation and Security</h2>
                <p class="mb-6">If the Website requires creating an account to access certain features, you agree to
                    provide
                    accurate, complete, and up-to-date information. You are responsible for maintaining the
                    confidentiality of your account credentials and for any activity that occurs under your account.</p>

                <h2 class="text-2xl font-semibold mb-2">6. Limitations of Liability</h2>
                <p class="mb-6"><strong class="text-green-600">TaniXplore</strong> will make reasonable efforts to
                    ensure that the Website and Services are
                    accessible and function as intended. However, we do not guarantee that the Website will be
                    error-free, uninterrupted, or secure. In no event will <strong
                        class="text-green-600">TaniXplore</strong> be liable for any
                    direct, indirect, incidental, or consequential damages arising from your use or inability to use the
                    Website or Services.</p>

                <h2 class="text-2xl font-semibold mb-2">7. Privacy and Data Protection</h2>
                <p class="mb-6">Your use of the Website is also governed by our <strong><a
                            href="{{ route('privacy.policy') }}" class="text-blue-500">Privacy Policy</a></strong>,
                    which outlines how we collect, use, and
                    protect your personal data. By using the Website, you consent to the practices described in the
                    Privacy Policy.</p>

                <h2 class="text-2xl font-semibold mb-2">8. Third-Party Links</h2>
                <p class="mb-6">The Website may contain links to third-party websites or services that are not
                    operated by us. We are
                    not responsible for the content, privacy practices, or services provided by these third-party sites.
                    Please review their terms and privacy policies before interacting with them.</p>

                <h2 class="text-2xl font-semibold mb-2">9. Termination</h2>
                <p class="mb-6">We reserve the right to suspend or terminate your access to the Website or Services at
                    our sole
                    discretion, without prior notice, if you violate any of these Terms of Use. Upon termination, your
                    right to use the Website will immediately cease.</p>

                <h2 class="text-2xl font-semibold mb-2">10. Governing Law</h2>
                <p class="mb-6">These Terms of Use will be governed by and construed in accordance with the laws of
                    Indonesia. Any
                    disputes arising from these terms or your use of the Website will be subject to the exclusive
                    jurisdiction of the courts in Indonesia.</p>

                <h2 class="text-2xl font-semibold mb-2">11. Contact Us</h2>
                <p>If you have any questions or concerns regarding these Terms of Use, please contact us at:</p>
                <ul class="list-disc list-inside mb-6">
                    <li><strong>Email</strong>: <a href="mailto:tanixploree@gmail.com"
                            class="text-blue-500">tanixploree@gmail.com</a></li>
                    <li><strong>Phone</strong>: <a href="https://wa.me/6283169246123" target="_blank"
                            class="text-blue-500">+62 831-6924-6123</a></li>
                    <li><strong>Address</strong>: <a
                            href="https://www.google.com/maps/search/?api=1&query=Bandung,Indonesia" target="_blank"
                            class="text-blue-500">Bandung, West Java, Indonesia</a></li>
                </ul>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</body>

</html>
