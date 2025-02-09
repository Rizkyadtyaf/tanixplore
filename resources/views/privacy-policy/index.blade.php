<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Privacy Policy - taniXplore</title>
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#EBEBEB] dark:bg-[#1A1A1A]">
        <!-- Background Section for Privacy Policy Page -->
        <div style="background-image: linear-gradient(to right, rgba(14, 33, 7, 0.35), rgba(0, 0, 0, 0) 70%), 
                    linear-gradient(to bottom, rgba(10, 10, 10, 0.5), rgba(24, 24, 24, 0.8) 70%), 
                    url('{{ asset('images/bg-about.jpg') }}');"
            class="bg-cover bg-center bg-no-repeat min-h-[50vh] flex items-center">
            @include('layouts.navigation')
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 text-white">
                <h1 class="text-4xl sm:text-6xl font-bold leading-tight">Privacy Policy for taniXplore</h1>
                <p class="mt-4 text-lg sm:text-xl">At <strong class="text-green-600">taniXplore</strong>, we value your
                    privacy and are committed to protecting your personal data. This Privacy Policy explains how we
                    collect, use, and safeguard your information when you visit our website
                    <strong class="text-green-600">https://tanixplore.com</strong> and use our services.

            </div>
        </div>

        <!-- Privacy Policy Content Section -->
        <div class="w-full bg-[#EBEBEB] dark:bg-[#1A1A1A] text-black dark:text-white min-h-[50vh] py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold mb-2">1. What Information Do We Collect?</h2>
                <p>We collect personal information that you provide to us and information automatically collected when
                    you visit our Website.</p>

                <h3 class="font-semibold mt-2">Personal Information Provided by You</h3>
                <p>We collect personal information that you voluntarily provide to us when you:</p>
                <ul class="list-disc list-inside mb-2">
                    <li>Visit and use the features of our Website</li>
                    <li>Contact us via forms or customer service</li>
                </ul>
                <p>The personal information we collect may include:</p>
                <ul class="list-disc list-inside mb-2">
                    <li>Name</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Address</li>
                </ul>
                <h3 class="font-semibold mt-2">Information Automatically Collected</h3>
                <p>When you visit our Website, we automatically collect certain information, including:</p>
                <ul class="list-disc list-inside mb-6">
                    <li>IP address</li>
                    <li>Browser type and version</li>
                    <li>Operating system</li>
                    <li>Location information</li>
                    <li>Referring URLs</li>
                    <li>Date and time of access</li>
                </ul>

                <h2 class="text-2xl font-semibold mb-2">2. How Do We Use Your Information?</h2>
                <p>We use the information we collect for various purposes, including:</p>
                <ul class="list-disc list-inside mb-6">
                    <li><strong>To provide our Services</strong>: This includes managing your account and providing
                        customer support.</li>
                    <li><strong>For marketing purposes</strong>: We may use your information to send you updates,
                        promotions, and other marketing materials. You can opt-out of marketing communications at any
                        time.</li>
                    <li><strong>To improve our Services</strong>: We use the information to analyze usage patterns,
                        troubleshoot issues, and improve the user experience on our Website.</li>
                    <li><strong>To comply with legal obligations</strong>: We may use your information to fulfill legal
                        requirements, such as preventing fraud or responding to government requests.</li>
                </ul>

                <h2 class="text-2xl font-semibold mb-2">3. Will Your Information Be Shared With Anyone?</h2>
                <p>We may share your personal data in the following circumstances:</p>
                <ul class="list-disc list-inside mb-6">
                    <li><strong>Service providers</strong>: We may share your information with third-party service
                        providers who assist us with data processing or shipping products.</li>
                    <li><strong>Legal compliance</strong>: We may share your information in response to a legal
                        obligation, such as a court order or regulatory request.</li>
                </ul>

                <h2 class="text-2xl font-semibold mb-2">4. How Do We Protect Your Information?</h2>
                <p class="mb-6">We implement a variety of security measures to safeguard your personal information,
                    including
                    encryption and access control mechanisms. While we take reasonable steps to protect your data,
                    please note that no method of transmission over the internet is 100% secure.</p>

                <h2 class="text-2xl font-semibold mb-2">5. Do We Use Cookies?</h2>
                <p class="mb-6">We do not use cookies or similar tracking technologies on our Website. All information
                    collected
                    comes from direct interactions with visitors via forms or data automatically collected, such as IP
                    address and browser information.</p>

                <h2 class="text-2xl font-semibold mb-2">6. How Long Do We Keep Your Information?</h2>
                <p class="mb-6">We retain your personal information for as long as necessary to fulfill the purposes
                    outlined in this
                    Privacy Policy, or for a longer period if required by law. If you request deletion of your account,
                    we will only retain necessary information to comply with legal obligations or resolve disputes.</p>

                <h2 class="text-2xl font-semibold mb-2">7. What Are Your Privacy Rights?</h2>
                <p>Depending on your location, you may have the following rights:</p>
                <ul class="list-disc list-inside mb-2">
                    <li><strong>Access</strong>: You can request access to the personal data we hold about you.</li>
                    <li><strong>Correction</strong>: You can request corrections to your personal data if it is
                        inaccurate or incomplete.</li>
                    <li><strong>Deletion</strong>: You can request deletion of your personal data, in a way that is
                        acceptable and legal for the website and users depending on certain conditions.</li>
                    <li><strong>Opt-out of marketing communications</strong>: You can unsubscribe from marketing emails
                        by following the instructions in the email or contacting us directly.</li>
                </ul>

                <h2 class="text-2xl font-semibold mb-2">8. Third-Party Websites</h2>
                <p class="mb-6">Our Website may contain links to third-party websites or services that are not
                    operated by us. We are
                    not responsible for the privacy practices or content of these third-party sites. Please review their
                    privacy policies before sharing any personal information.</p>

                <h2 class="text-2xl font-semibold mb-2">9. Changes to This Privacy Policy</h2>
                <p class="mb-6">We may update this Privacy Policy from time to time. Any changes will be posted on
                    this page with an
                    updated "Last Revised" date. We encourage you to review this Privacy Policy periodically to stay
                    informed about how we are protecting your personal information.</p>

                <h2 class="text-2xl font-semibold mb-2">10. How to Contact Us</h2>
                <p>If you have any questions or concerns about this Privacy Policy or your privacy rights, please
                    contact us at:</p>
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
