<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="w-full overflow-hidden">
    <!-- Product Grid -->
    <div class="py-4">
        <div class="max-w-full">
            @if ($products->isEmpty())
                <div class="flex justify-center items-center py-8">
                    <p class="text-center text-gray-500 dark:text-gray-400">No products available.</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 mx-2">
                    @foreach ($products as $product)
                        <div class="product-item rounded-lg shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] 
                           p-4 cursor-pointer transition duration-300 ease-in-out"
                            onclick="showProductModal({{ json_encode($product) }})">
                            <!-- Product Image -->
                            <div class="mb-4">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-40 sm:h-48 rounded-lg bg-white object-cover">
                                @else
                                    <div
                                        class="w-full h-40 sm:h-48 rounded-lg flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                                        <p class="text-gray-500 dark:text-gray-400 text-center">Image not available</p>
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
                                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300">
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
            @endif
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

                <!-- Seller Info -->
                <div class="space-y-1">
                    <span class="text-lg font-semibold text-gray-800 dark:text-white">Seller:</span>
                    <p id="modalUser" class="text-green-600 dark:text-green-400 font-medium"></p>
                </div>

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

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4 pt-4">
                    <button id="rute" onclick="navigateToProduct()"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fa-solid fa-route"></i>
                        <span>Rute</span>
                    </button>

                    <button id="rating" onclick="showRatingModal()"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fa-solid fa-star"></i>
                        <span>Rating</span>
                    </button>

                    <button id="chatButton" onclick="openWhatsApp()"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>Chat</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Rating Modal -->
    <div id="ratingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Rating</h2>
                <button onclick="closeRatingModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>

            <div class="space-y-6">
                <div class="flex justify-center space-x-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <button onclick="setRating({{ $i }})"
                            class="text-4xl focus:outline-none transition-colors"
                            data-rating="{{ $i }}">★</button>
                    @endfor
                </div>
                <div class="flex justify-end">
                    <button onclick="submitRating()"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors">
                        Send Ratings
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let map = null;
    let marker = null;
    let currentProduct = null;

    // loading
    document.addEventListener("DOMContentLoaded", function() {
        var loadingElement = document.getElementById('loading');
        var body = document.body;

        // Tampilkan loading dan nonaktifkan scroll
        loadingElement.classList.remove('hidden');
        body.style.overflow = 'hidden';

        window.onload = function() {
            loadingElement.classList.add('hidden');
            body.style.overflow = '';
        };
    });

    // Fungsi openWhatsApp 
    function openWhatsApp() {
        if (!currentProduct || !currentProduct.user || !currentProduct.user.phone) {
            Swal.fire({
                title: 'Error!',
                text: 'WhatsApp number not available.',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        // Format nomor telepon (hapus karakter selain angka dan pastikan format internasional)
        let phone = currentProduct.user.phone.replace(/\D/g, '');
        if (phone.startsWith('0')) {
            phone = '62' + phone.slice(1);
        }

        // Buat pesan default
        const message = `Halo, saya tertarik dengan produk ${currentProduct.name} yang Anda jual di taniXplore.`;

        // Buat URL WhatsApp
        const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;

        // Buka di tab baru
        window.open(whatsappUrl, '_blank');
    }
    const currentUserId = @json(auth()->user()->id);
    // Fungsi untuk menampilkan modal produk
    function showProductModal(product) {
        if (!product || !product.id) {
            return;
        }
        currentProduct = product;

        // Update konten modal dengan data produk
        document.getElementById('modalTitle').textContent = product.name;
        document.getElementById('modalImage').src = `/storage/images/${product.image}`;
        document.getElementById('modalDate').textContent = product.date_info ? product.date_info :
            '-';
        document.getElementById('modalUser').textContent = product.user ? product.user.name : '-';
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

        // Cek apakah produk ini milik pengguna yang sedang login
        const chatButton = document.getElementById('chatButton');
        if (product.user.id === currentUserId) {
            // Sembunyikan tombol Chat jika produk ini milik pengguna yang sedang login
            chatButton.classList.add('hidden');
        } else {
            // Tampilkan tombol Chat jika produk ini bukan milik pengguna yang sedang login
            chatButton.classList.remove('hidden');
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

    }

    // Fungsi untuk menutup modal produk
    function closeProductModal() {
        // Enable scroll kembali
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
        // Sembunyikan modal
        const modal = document.getElementById('productModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

        if (marker && marker.setMap) {
            marker.setMap(null);
        }
    }

    // Menambahkan event listener untuk tombol Edit
    document.getElementById('editButton')?.addEventListener('click', function() {
        const product = @json($product ?? []);
        editProduct(product);
    });

    // Fungsi untuk mengedit produk
    function editProduct(product) {
        if (product && product.id) {
            window.location.href = `/product/${product.id}/edit`;
        } else {
            console.error('Product ID is missing.');
        }
    }

    // Mengonfirmasi penghapusan produk
    function confirmDelete(productId) {
        if (confirm('Are you sure you want to remove this product?')) {
            document.getElementById('deleteForm' + productId).submit();
        }
    }

    // Menutup modal jika pengguna menekan tombol Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeProductModal();
        }
    });

    // Fungsi untuk navigasi rute ke lokasi produk
    function navigateToProduct() {
        if (!currentProduct || !currentProduct.latitude || !currentProduct.longitude) {
            alert("Product location data is not available.");
            return;
        }

        if ("geolocation" in navigator) {
            Swal.fire({
                title: "Finding Your Location...",
                text: "Please wait, we are detecting your location.",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading(),
            });

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    const productLat = parseFloat(currentProduct.latitude);
                    const productLng = parseFloat(currentProduct.longitude);
                    const googleMapsUrl =
                        `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${productLat},${productLng}`;

                    Swal.close();
                    window.open(googleMapsUrl, "_blank");
                },
                function(error) {
                    Swal.close();
                    alert("Failed to get your location.");
                }
            );
        } else {
            alert("Your browser does not support geolocation features.");
        }
    }

    // Fungsi untuk menampilkan modal rating
    function showRatingModal() {
        if (!currentProduct) {
            Swal.fire({
                title: 'Error!',
                text: 'Product ID not available.',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        fetch(`/products/${currentProduct.id}/check-rating`, { // Perubahan di sini
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.hasRated) {
                    Swal.fire({
                        title: 'Ratings Already Available',
                        text: 'You have given a rating for this product previously.',
                        icon: 'info',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6',
                    });
                } else {
                    document.getElementById('ratingModal').classList.remove('hidden');
                    document.getElementById('ratingModal').classList.add('flex');
                }
            })
            .catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while checking the rating.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            });
    }

    // Fungsi untuk menutup modal rating
    function closeRatingModal() {
        document.getElementById('ratingModal').classList.add('hidden');
        document.getElementById('ratingModal').classList.remove('flex');

        selectedRating = 0;
        const stars = document.querySelectorAll('[data-rating]');
        stars.forEach((star) => {
            star.classList.remove('text-yellow-500');
            star.classList.add('text-gray-300');
        });
    }

    // Fungsi untuk mengatur rating yang dipilih
    function setRating(rating) {
        selectedRating = rating;

        const stars = document.querySelectorAll('[data-rating]');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-500');
            } else {
                star.classList.remove('text-yellow-500');
                star.classList.add('text-gray-300');
            }
        });
    }

    // Fungsi untuk mengirim rating ke backend
    function submitRating() {
        if (!selectedRating) {
            Swal.fire({
                title: 'Warning!',
                text: 'Please select a rating first.',
                icon: 'warning',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        if (!currentProduct) {
            Swal.fire({
                title: 'Error!',
                text: 'Product ID not available.',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        fetch('/product-ratings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    Accept: 'application/json',
                },
                body: JSON.stringify({
                    product_id: currentProduct.id,
                    rating: selectedRating,
                }),
            })
            .then(async (response) => {
                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 401) {
                        window.location.href = '/login';
                        return;
                    }
                    throw new Error(data.message || 'There is an error.');
                }

                return data;
            })
            .then((data) => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Succeed!',
                        text: data.message || 'Rating successfully saved.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            closeRatingModal();
                            location.reload();
                        }
                    });
                } else {
                    throw new Error(data.message || 'An error occurred while saving the rating.');
                }
            })
            .catch((error) => {
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'An error occurred while sending the rating.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            });
    }
</script>

<style>
    .aspect-w-16 {
        position: relative;
        padding-bottom: 56.25%;
    }

    .aspect-w-16>img {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        object-fit: cover;
        object-position: center;
    }
</style>
