<x-app-layout>
    <x-slot name="header"></x-slot>

    <!-- Loading spinner -->
    <div id="loading" class="fixed inset-0 flex justify-center items-center z-50 backdrop-blur-sm">
        <div class="border-8 border-t-8 border-gray-300 border-t-green-500 rounded-full w-10 h-10 animate-spin"></div>
    </div>

    <!-- Product Section -->
    <div class="w-full" id="product-section">
        <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-4" x-data="{ openFilter: false }">
                <!-- Product List -->
                <div class="w-full lg:w-3/4 max-w-7xl">
                    <!-- Search Bar -->
                    <div
                        class="rounded-lg shadow-sm px-2 py-1 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)]">
                        <form action="{{ route('dashboard') }}" method="GET" id="search-form"
                            class="flex flex-row items-center space-x-2 mt-2">
                            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}"
                                class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-150">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <!-- Filter Button -->
                            <button type="button" @click="openFilter = true"
                                class="bg-[#FBC91A]  hover:bg-[#fbca1abb]  text-white px-4 py-2 rounded-lg ml-2 transition duration-150">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Sidebar Filter (Initially hidden) -->
                    <div x-show="openFilter" x-transition:enter="transition transform ease-in-out duration-500"
                        x-transition:enter-start="opacity-0" x-transition:enter-end=" opacity-100"
                        x-transition:leave="transition transform ease-in-out duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="w-full rounded-lg shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] z-40 mt-2">
                        <div class="p-4 shadow-lg">
                            <div class="flex justify-between border-b border-gray-500 pb-4">
                                <span class="text-xl font-bold text-gray-800 dark:text-gray-100">Filter</span>
                                <!-- Close Filter Button with Icon -->
                                <button @click="openFilter = false"
                                    class="text-gray-800 dark:text-gray-100 p-2 rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <!-- Filter Form -->
                            <div class="w-full">
                                @include('components.filter-form')
                            </div>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="bg-transparent">
                        @if ($products->count() > 0)
                            @include('product.index')
                        @else
                            <div class="bg-green-600 my-20">
                                <p class="text-center text-white py-2 font-bold">No products found matching your
                                    filters.</p>
                            </div>
                        @endif
                    </div>
                    <!-- Pagination -->
                    <div class="my-4 mx-2">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // Loading Spinner
        document.addEventListener("DOMContentLoaded", function() {
            const loadingElement = document.getElementById('loading');
            const body = document.body;
            // Disable scroll
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
            loadingElement.classList.remove('hidden');
            body.style.overflow = 'hidden';

            window.onload = function() {
                loadingElement.classList.add('hidden');
                // Enable scroll kembali
                document.body.style.overflow = '';
                document.documentElement.style.overflow = '';
            };
        });

        // Open filter sidebar
        function openFilter() {
            const filterSidebar = document.getElementById('filter-sidebar');
            filterSidebar.classList.remove('translate-y-full');
            filterSidebar.classList.add('translate-y-0');
        }

        // Close filter sidebar
        function closeFilter() {
            const filterSidebar = document.getElementById('filter-sidebar');
            filterSidebar.classList.remove('translate-y-0');
            filterSidebar.classList.add('translate-y-full');
        }

        // Ensure form submissions stay on #product-section
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('search-form');
            if (searchForm) {
                searchForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formData = new FormData(searchForm);
                    const queryString = new URLSearchParams(formData).toString();
                    window.location.href = "{{ route('dashboard') }}?" + queryString + "#product-section";
                });
            }
        });
    </script>
</x-app-layout>
