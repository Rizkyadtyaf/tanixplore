<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mt-2 md:mt-4 lg:mt-6">
            <div class="w-full sm:w-auto">
                <a href="{{ route('product.shop') }}"
                    class="text-black dark:text-white hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
            </div>
            <div class="w-full sm:w-auto text-center">
                <h2 class="font-semibold text-xl text-gray-900 dark:text-slate-200 transition-colors duration-300">
                    {{ __('Edit Product') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div
                class="shadow-md rounded-xl overflow-hidden transition-all duration-300 
                        shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)]">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 p-4 sm:p-6"
                    x-data="productForm()">
                    @csrf
                    @method('PUT')

                    {{-- Name Input --}}
                    <div class="sm:col-span-2 lg:col-span-2">
                        <x-input-label for="name" :value="__('Product Name')" />
                        <x-text-input id="name" name="name" type="text" :value="old('name', $product->name)" required
                            autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- Price Input --}}
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" min="99" step="0.01"
                            :value="old('price', $product->price)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    {{-- Stock Input --}}
                    <div>
                        <x-input-label for="stock" :value="__('Stock')" />
                        <x-text-input id="stock" name="stock" type="number" min="1" :value="old('stock', $product->stock)"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                    </div>

                    {{-- Date Input --}}
                    <div>
                        <x-input-label for="date_info" :value="__('Date Info')" />
                        <x-text-input id="date_info" name="date_info" type="date" class="mt-1 block w-full"
                            :value="old('date_info', $product->date_info)" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_info')" />
                    </div>

                    {{-- Grade Selection --}}
                    <div>
                        <x-input-label for="grade" :value="__('Grade')" />
                        <div class="mt-2 space-y-2 text-gray-900 dark:text-slate-300">
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="grade" value="Grade A"
                                        class="form-radio text-green-500"
                                        {{ old('grade', $product->grade) === 'Grade A' ? 'checked' : '' }}>
                                    <span class="ml-2">A (Premium)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="grade" value="Grade B"
                                        class="form-radio text-green-500"
                                        {{ old('grade', $product->grade) === 'Grade B' ? 'checked' : '' }}>
                                    <span class="ml-2">B (Standard)</span>
                                </label>
                            </div>
                        </div>
                    </div>


                    {{-- Description Textarea --}}
                    <div class="sm:col-span-2 lg:col-span-full">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea id="description" name="description"
                            rows="4">{{ old('description', $product->description) }}</x-textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    {{-- Location Section --}}
                    <div class="sm:col-span-2 lg:col-span-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Address Input --}}
                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input type="text" name="address" id="address"
                                    placeholder="Enter your address" value="{{ old('address', $product->address) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                <input type="hidden" name="latitude" id="latitude"
                                    value="{{ old('latitude', $product->latitude) }}">
                                <input type="hidden" name="longitude" id="longitude"
                                    value="{{ old('longitude', $product->longitude) }}">
                            </div>

                            {{-- Address Details --}}
                            <div>
                                <x-input-label for="addres_detail" :value="__('Address Details')" />
                                <x-text-input id="addres_detail" name="addres_detail" type="text"
                                    placeholder="Block / Unit No., etc." class="mt-1 block w-full" :value="old('addres_detail', $product->addres_detail)" />
                                <x-input-error class="mt-2" :messages="$errors->get('addres_detail')" />
                            </div>
                        </div>

                        {{-- Map Container --}}
                        <div id="map"
                            class="w-full h-80 rounded-lg mt-4 opacity-90 hover:opacity-100 transition-opacity"></div>
                    </div>

                    {{-- Image Upload --}}
                    <div class="sm:col-span-full lg:col-span-full">
                        <x-input-label for="image" :value="__('Product Image')" />
                        <div x-ref="imageUploadDiv"
                            @dragover.prevent="$refs.imageUploadDiv.classList.add('border-green-500')"
                            @dragleave.prevent="$refs.imageUploadDiv.classList.remove('border-green-500')"
                            @drop.prevent="handleImageDrop($event)"
                            class="mt-2 p-6 border-2 border-dashed rounded-lg text-center 
                                   transition-all duration-300 hover:border-green-500 
                                   dark:border-gray-600 dark:hover:border-green-500">
                            <img id="preview-image" src="{{ $product->image ? asset($product->image) : '' }}"
                                alt="Product Preview"
                                class="mx-auto mb-4 max-h-48 object-cover rounded-lg 
                                       {{ $product->image ? '' : 'hidden' }}">

                            <input type="file" name="image" id="image-upload" accept="image/*" class="hidden"
                                @change="handleImageUpload($event)">
                            <label for="image-upload"
                                class="cursor-pointer inline-block px-4 py-2 
                                       bg-green-500 text-white rounded-md 
                                       hover:bg-green-600 transition-colors">
                                Upload Image
                            </label>
                            <p class="mt-2 text-sm text-gray-500">
                                PNG, JPG, GIF (max 10MB)
                            </p>
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="sm:col-span-full lg:col-span-full flex justify-center mt-6">
                        <x-primary-button class="px-6 py-3 bg-green-600 hover:bg-green-700 transition-colors">
                            {{ __('Update Product') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function productForm() {
            return {
                handleImageUpload(event) {
                    const file = event.target.files[0];
                    this.previewImage(file);
                },
                handleImageDrop(event) {
                    const file = event.dataTransfer.files[0];
                    this.previewImage(file);
                },
                previewImage(file) {
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const previewImage = document.getElementById('preview-image');
                            previewImage.src = e.target.result;
                            previewImage.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                }
            };
        }

        function initMap() {
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const addressInput = document.getElementById('address');
            const mapElement = document.getElementById('map');

            // Nilai default koordinat jika tidak tersedia di input
            const latitude = parseFloat(latitudeInput.value) || -6.2088;
            const longitude = parseFloat(longitudeInput.value) || 106.8456;

            // Inisialisasi Google Maps
            map = new google.maps.Map(mapElement, {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                mapId: "DEMO_MAP_ID",
                zoom: 15,
            });

            // Tambahkan marker ke peta
            marker = new google.maps.marker.AdvancedMarkerElement({
                position: {
                    lat: latitude,
                    lng: longitude
                },
                map: map,
                draggable: true,
                title: "Geser untuk mengatur lokasi",
            });

            // Fungsi untuk memperbarui marker
            function updateMarkerPosition(position) {
                marker.position = position;
                latitudeInput.value = position.lat;
                longitudeInput.value = position.lng;
            }
            // Inisialisasi autocomplete pada input alamat
            const autocomplete = new google.maps.places.Autocomplete(addressInput);
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (place.geometry && place.geometry.location) {
                    const location = {
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng()
                    };

                    // Pindahkan map ke lokasi yang dipilih
                    map.setCenter(location);
                    map.setZoom(15);

                    // Update posisi marker
                    updateMarkerPosition(location);
                }
            });

            // Event listener untuk memperbarui latitude dan longitude setelah marker dipindahkan
            map.addListener('click', function(event) {
                const clickedLocation = {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng()
                };

                // Update posisi marker dengan lokasi klik
                updateMarkerPosition(clickedLocation);

                // Update alamat menggunakan geocoder
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    location: event.latLng
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK && results[0]) {
                        addressInput.value = results[0].formatted_address;
                    } else {
                        console.error("Geocode gagal: " + status);
                    }
                });
            });
        }
        // Pastikan inisialisasi peta dijalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
</x-app-layout>
