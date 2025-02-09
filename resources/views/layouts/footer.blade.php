<footer class="bg-[#1F6306] text-white py-6 md:py-8 lg:py-10 mt-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-4 md:gap-6 lg:gap-6">
            <!-- Logo and Description -->
            <div class="mb-6 sm:mb-0 text-center sm:text-left">
                <div class="flex items-center gap-3 mb-4 justify-center sm:justify-start">
                    <span class="text-xl sm:text-2xl font-semibold">taniXplore</span>
                </div>
                <p class="text-sm sm:text-base text-gray-200 px-2 sm:px-0 mx-auto sm:mx-0 max-w-[280px] sm:max-w-none">
                    Enjoy the freshest fruits, vegetables, and more, cultivated with sustainable practices.
                </p>
            </div>

            <!-- Contact Info -->
            <div class="mb-6 sm:mb-0 sm:pl-12 mx-auto sm:mx-0 sm:ml-[80px] text-center sm:text-left w-full sm:w-auto">
                <h3 class="font-semibold text-base sm:text-lg mb-4 sm:mb-3">Contact Us</h3>
                <ul class="space-y-3 sm:space-y-2">
                    <li class="flex items-center gap-2 justify-center sm:justify-start">
                        <i class="fas fa-envelope w-5"></i>
                        <a href="mailto:tanixploree@gmail.com" class="hover:text-gray-300 transition-colors">
                            tanixploree@gmail.com
                        </a>
                    </li>
                    <li class="flex items-center gap-2 justify-center sm:justify-start">
                        <i class="fas fa-phone w-5"></i>
                        <a href="https://wa.me/6283169246123" class="hover:text-gray-300 transition-colors"
                            target="_blank">
                            +62 831-6924-6123
                        </a>
                    </li>
                    <li class="flex items-center gap-2 justify-center sm:justify-start">
                        <a href="https://www.google.com/maps/search/?api=1&query=Bandung,Indonesia" target="_blank"
                            class="flex items-center hover:text-gray-300 transition-colors">
                            <i class="fas fa-map-marker-alt w-5"></i>
                            <span>
                                Bandung, West Java, Indonesia
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Social Media -->
            <div class="sm:pl-12 mx-auto sm:mx-0 sm:ml-[120px] text-center sm:text-left w-full sm:w-auto">
                <h3 class="font-semibold text-base sm:text-lg mb-4 sm:mb-3">Follow Us</h3>
                <div class="flex gap-6 sm:gap-5 justify-center sm:justify-start">
                    <a href="https://www.facebook.com/share/1D4HUjdhRc/" target="_blank"
                        class="text-white hover:text-gray-300 transition-colors text-2xl sm:text-xl">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://x.com/TaniXplore" target="_blank"
                        class="text-white hover:text-gray-300 transition-colors text-2xl sm:text-xl">
                        <i class="fa-solid fa-x"></i>
                    </a>
                    <a href="https://www.instagram.com/tanixplore?igsh=MWxkeDY2eno1aHg1Nw%3D%3D&utm_source=qr"
                        target="_blank" class="text-white hover:text-gray-300 transition-colors text-2xl sm:text-xl">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="mt-8 pt-6 border-t-2 border-white">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-xs sm:text-sm text-gray-300 mb-4 md:mb-0">© 2024 All Rights Reserved by FramerDevs</p>
                <div class="flex gap-6 sm:gap-8">
                    <a href="{{ route('privacy.policy') }}"
                        class="text-xs sm:text-sm text-gray-300 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms.of.use') }}"
                        class="text-xs sm:text-sm text-gray-300 hover:text-white transition-colors">Terms of Use</a>
                </div>
            </div>
        </div>
    </div>
</footer>
