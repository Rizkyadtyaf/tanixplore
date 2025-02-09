<x-app-layout>
    <style>
        #modalMap {
            height: 400px;
            width: 100%;
            z-index: 1000;
            border-radius: 0.5rem;
        }

        .leaflet-container {
            z-index: 1000;
        }
    </style>

    <!-- Loading spinner -->
    <div id="loading" class="fixed inset-0 flex justify-center items-center z-50 backdrop-blur-sm">
        <div class="border-8 border-t-8 border-gray-300 border-t-green-500 rounded-full w-10 h-10 animate-spin"></div>
    </div>

    <!-- Product List -->
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4">
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
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="overflow-hidden">
                <div class="p-6 text-gray-900">
                    @if ($products->isEmpty())
                        <p class="text-center text-gray-500 dark:text-gray-400">You haven't added any products yet.</p>
                    @endif

                    <!-- Updated Grid Layout -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                        @foreach ($products as $product)
                            <div class="product-item rounded-lg shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] 
                                    p-4 cursor-pointer"
                                onclick="showProductModal({{ json_encode($product) }})">
                                <!-- Product Image -->
                                <div class="mb-4">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/images/' . $product->image) }}"
                                            alt="{{ $product->name }}" class="w-full h-48 rounded-lg bg-white">
                                    @else
                                        <div
                                            class="w-full h-48 rounded-lg flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                                            <p class="text-gray-500 dark:text-gray-400 text-center">Image not available
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="space-y-2">
                                    <div class="flex flex-row items-center gap-4">
                                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                            {{ $product->name }}</h3>
                                        <!-- New Label -->
                                        @if ($product->date_info >= now()->subDay())
                                            <span
                                                class="inline-block bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                                New
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300">
                                        Rp. {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <!-- Rating Section -->
                                    <div class="flex flex-col sm:flex-row justify-between gap-1.5 mt-1.5 sm:col-span-2">
                                        <!-- Rating Bintang -->
                                        <div class="flex items-center gap-0.5">
                                            @php
                                                $rating = round($product->ratings()->avg('rating') ?? 0);
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rating)
                                                    <span class="text-yellow-400 text-base sm:text-lg">★</span>
                                                @else
                                                    <span class="text-gray-300 text-base sm:text-lg">★</span>
                                                @endif
                                            @endfor
                                            <span class="text-sm sm:text-base text-gray-700 dark:text-gray-300">
                                                {{ number_format($product->ratings()->avg('rating') ?? 0, 1) }}
                                            </span>
                                        </div>

                                        <!-- Jumlah Rating -->
                                        <div class="text-sm sm:text-base mt-2 sm:mt-0">
                                            <span class="text-gray-500 dark:text-gray-400">
                                                {{ $product->ratings()->count() }} Rating
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Modal -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl mx-4 overflow-hidden">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-white dark:bg-gray-800 z-10 flex justify-between items-center px-6 py-4 border-b dark:border-gray-700">
                <div class="flex flex-row items-center gap-2">
                    <h2 id="modalTitle" class="text-xl font-bold text-gray-800 dark:text-white"></h2>
                    <span id="modalNewLabel"
                        class="inline-block bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                        New
                    </span>
                </div>
                <button onclick="closeProductModal()"
                    class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 p-2">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6 space-y-6 overflow-y-auto max-h-[calc(100vh-16rem)]">
                <!-- Product Image -->
                <img id="modalImage" class="w-full h-64 object-cover rounded-lg" src="" alt="">
                <span id="modalDate" class="text-gray-600 dark:text-gray-400">{{ $product->date_info }}</span>
                <!-- Price and Stock -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <span class="font-medium text-gray-800 dark:text-white">Price:</span>
                        <p id="modalPrice" class="text-gray-600 dark:text-gray-400"></p>
                    </div>
                    <div class="space-y-1">
                        <span class="font-medium text-gray-800 dark:text-white">Stock:</span>
                        <p id="modalStock" class="text-gray-600 dark:text-gray-400"></p>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-1">
                    <span class="font-medium text-gray-800 dark:text-white">Description:</span>
                    <p id="modalDescription" class="text-gray-600 dark:text-gray-400"></p>
                </div>

                <!-- Grade -->
                <div class="space-y-1">
                    <span class="font-medium text-gray-800 dark:text-white">Grade:</span>
                    <p id="modalGrade" class="text-gray-600 dark:text-gray-400"></p>
                </div>

                <!-- Address and Map -->
                <div class="space-y-2">
                    <div class="space-y-1">
                        <span class="font-medium text-gray-800 dark:text-white">Address:</span>
                        <p id="modalAddress" class="text-gray-600 dark:text-gray-400"></p>
                        <p>
                            <span class="font-medium text-gray-800 dark:text-white">Detailed Address:</span>
                            <span id="modalAddresDetail" class="text-gray-600 dark:text-gray-400"></span>
                        </p>
                    </div>
                    <div id="modalMap" class="w-full h-64 rounded-lg overflow-hidden"></div>
                </div>
                <div class="flex justify-center space-x-4 mt-4">
                    {{-- Edit Button --}}
                    <div class="flex-row items-center">
                        <button onclick="handleEdit()"
                            class="bg-blue-500 hover:bg-blue-600 text-white w-24 px-4 py-2 rounded-md flex items-center justify-center gap-2 transition duration-300 ease-in-out">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Edit</span>
                        </button>
                    </div>

                    {{-- Delete Button/Form --}}
                    <div class="flex-row items-center">
                        <form id="deleteForm" action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete()"
                                class="bg-red-500 hover:bg-red-600 text-white w-24 px-4 py-2 rounded-md flex items-center justify-center gap-2 transition duration-300 ease-in-out">
                                <i class="fa-regular fa-trash-can"></i>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let map = null;
        let marker = null;
        let currentProduct = null;

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

        // Fungsi baru untuk handle edit
        function handleEdit() {
            if (currentProduct && currentProduct.id) {
                window.location.href = `/product/${currentProduct.id}/edit`;
            } else {
                console.error('Product ID is missing.');
            }
        }

        // Fungsi untuk menampilkan modal produk
        function showProductModal(product) {
            if (!product || !product.id) {
                return;
            }
            currentProduct = product;
            // Isi data modal
            document.getElementById('modalTitle').textContent = product.name;
            document.getElementById('modalImage').src = `/storage/images/${product.image}`;
            document.getElementById('modalDate').textContent = product.date_info ? product.date_info :
                '-';
            document.getElementById('modalPrice').textContent = 'Rp. ' + new Intl.NumberFormat('id-ID').format(product
                .price);
            document.getElementById('modalStock').textContent = `${product.stock} kg`;
            document.getElementById('modalDescription').textContent = product.description || '-';
            document.getElementById('modalGrade').textContent = product.grade || '-';
            document.getElementById('modalAddress').textContent = product.address || '-';
            document.getElementById('modalAddresDetail').textContent = product.addres_detail || '-';

            // Menampilkan label "New" jika produk baru
            const modalNewLabel = document.getElementById('modalNewLabel');
            if (new Date(product.date_info) >= new Date(Date.now() - 24 * 60 * 60 * 1000)) {
                modalNewLabel.classList.remove('hidden'); // Tampilkan label "New"
            } else {
                modalNewLabel.classList.add('hidden'); // Sembunyikan label "New"
            }

            // Disable scroll
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';

            // Tampilkan modal
            const modal = document.getElementById('productModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');


            // Menampilkan peta
            setTimeout(() => {
                if (product.latitude && product.longitude) {
                    map = new google.maps.Map(document.getElementById('modalMap'), {
                        center: {
                            lat: parseFloat(product.latitude),
                            lng: parseFloat(product.longitude)
                        },
                        mapId: "DEMO_MAP_ID",
                        zoom: 15,
                    });

                    marker = new google.maps.marker.AdvancedMarkerElement({
                        position: {
                            lat: parseFloat(product.latitude),
                            lng: parseFloat(product.longitude)
                        },
                        map: map,
                        title: product.name,
                    });

                    document.getElementById('modalMap').style.display = 'block';
                } else {
                    document.getElementById('modalMap').style.display = 'none';
                }
            }, 300);


            // Update form delete
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/product/${product.id}`;
        }

        // Fungsi untuk menutup modal produk
        function closeProductModal() {
            // Enable scroll kembali
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
            const modal = document.getElementById('productModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            // Membersihkan instance peta
            if (marker && marker.setMap) {
                marker.setMap(null);
            }
        }
        // Menutup modal jika pengguna menekan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeProductModal();
            }
        });

        function confirmDelete() {
            if (confirm('Are you sure you want to remove this product?')) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</x-app-layout>
