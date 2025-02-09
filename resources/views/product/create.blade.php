<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center items-center gap-4 mt-2 md:mt-4 lg:mt-6">
            <div class="w-full sm:w-auto text-center">
                <h2 class="font-semibold text-xl text-gray-900 dark:text-slate-200 transition-colors duration-300">
                    {{ __('Create Product') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div
                class="shadow-md rounded-xl overflow-hidden transition-all duration-300 ease-in-out 
                        shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)]">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2 lg:grid-cols-3" x-data="productForm()">
                    @csrf

                    {{-- Name Input --}}
                    <div class="sm:col-span-2 lg:col-span-2">
                        <x-input-label for="name" :value="__('Product Name')" />
                        <x-text-input id="name" name="name" type="text" :value="old('name')"
                            placeholder="Enter your product name" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- Price Input --}}
                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" min="99" step="0.01"
                            :value="old('price')" placeholder="Rp. 99" required />
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    {{-- Stock Input --}}
                    <div>
                        <x-input-label for="stock" :value="__('Stock')" />
                        <x-text-input id="stock" name="stock" type="number" min="1" :value="old('stock')"
                            placeholder="1" required />
                        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                    </div>

                    {{-- Date Input --}}
                    <div>
                        <x-input-label for="date_info" :value="__('Date Info')" />
                        <x-text-input id="date_info" name="date_info" type="date" class="mt-1 block w-full"
                            x-init="$el.value = new Date().toISOString().split('T')[0]" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_info')" />
                    </div>

                    {{-- Grade Selection --}}
                    <div>
                        <x-input-label for="grade" :value="__('Grade')" />
                        <div class="mt-2 space-y-2 text-gray-900 dark:text-slate-300">
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="grade" value="Grade A"
                                        class="form-radio text-green-500" required>
                                    <span class="ml-2">A (Premium)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="grade" value="Grade B"
                                        class="form-radio text-green-500" required>
                                    <span class="ml-2">B (Standard)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Description Textarea --}}
                    <div class="sm:col-span-full lg:col-span-full">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea id="description" name="description" rows="4" :value="old('description')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    {{-- Location Section --}}
                    <div class="sm:col-span-full lg:col-span-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Address Input --}}
                            <div>
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input type="text" name="address" id="address"
                                    placeholder="Enter your address" required />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                            </div>

                            {{-- Address Details --}}
                            <div>
                                <x-input-label for="addres_detail" :value="__('Address Details')" />
                                <x-text-input id="addres_detail" name="addres_detail" type="text"
                                    placeholder="Block / Unit No., etc." class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('addres_detail')" />
                            </div>
                        </div>

                        {{-- Map Container --}}
                        <div id="map"
                            class="w-full h-80 rounded-lg mt-4 opacity-90 hover:opacity-100 transition-opacity">
                        </div>
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

                            <img id="preview-image" src="#" alt="Product Preview"
                                class="mx-auto mb-4 max-h-48 object-cover rounded-lg hidden">

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
                            {{ __('Create Product') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Fungsi untuk inisialisasi peta dengan lazy loading
        function initMap() {
            const mapElement = document.getElementById('map');
            const addressInput = document.getElementById('address');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');

            const defaultPosition = {
                lat: -6.88679166666,
                lng: 107.6152888888
            };

            const map = new google.maps.Map(mapElement, {
                center: defaultPosition,
                mapId: "DEMO_MAP_ID",
                zoom: 15,
                gestureHandling: 'cooperative',
                mapTypeControl: false,
            });

            const marker = new google.maps.marker.AdvancedMarkerElement({
                position: defaultPosition,
                map: map,
                draggable: true,
                title: "Drag to set location",
            });

            // Debounced function for geocoding
            const debounce = (func, wait) => {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            };

            // Update marker position and get address
            const updateLocation = (position) => {
                marker.position = position;
                latitudeInput.value = position.lat;
                longitudeInput.value = position.lng;

                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    location: position
                }, (results, status) => {
                    if (status === google.maps.GeocoderStatus.OK && results[0]) {
                        addressInput.value = results[0].formatted_address;
                    }
                });
            };

            // Initialize autocomplete with sessionToken
            const sessionToken = new google.maps.places.AutocompleteSessionToken();
            const autocomplete = new google.maps.places.Autocomplete(addressInput, {
                sessionToken: sessionToken
            });

            // Event listeners
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                if (place.geometry?.location) {
                    const location = {
                        lat: place.geometry.location.lat(),
                        lng: place.geometry.location.lng()
                    };
                    map.setCenter(location);
                    map.setZoom(15);
                    updateLocation(location);
                }
            });

            map.addListener('click', debounce((event) => {
                const clickedLocation = {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng()
                };
                updateLocation(clickedLocation);
            }, 300));
        }
        // Lazy load Google Maps
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof google === 'undefined') {
                const script = document.createElement('script');
                script.src =
                    `https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key') }}&libraries=places&callback=initMap`;
                script.async = true;
                script.defer = true;
                document.head.appendChild(script);
            } else {
                initMap();
            }
        });

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
                        if (file.size > 10 * 1024 * 1024) {
                            alert('File size must be less than 10MB');
                            return;
                        }

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
    </script>
</x-app-layout>
