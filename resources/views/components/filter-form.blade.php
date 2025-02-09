<form action="{{ route('dashboard') }}" method="GET" id="filter-form" class="space-y-4">
    <input type="hidden" name="search" value="{{ request('search') }}">

    <!-- Filter Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <!-- Filter Harga -->
        <div>
            <span class="block text-lg font-semibold text-gray-700 dark:text-gray-100 mb-2">Price</span>
            <ul class="space-y-2">
                <li class="flex items-center space-x-2">
                    <input type="radio" id="harga-terendah" name="sort" value="price_asc"
                        class="rounded border-gray-300 text-green-500 p-2 focus:ring-2 focus:ring-green-500"
                        {{ request('sort') === 'price_asc' ? 'checked' : '' }}>
                    <label for="harga-terendah"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-500 cursor-pointer">
                        Lowest Price
                    </label>
                </li>
                <li class="flex items-center space-x-2">
                    <input type="radio" id="harga-tertinggi" name="sort" value="price_desc"
                        class="rounded border-gray-300 text-green-500 p-2 focus:ring-2 focus:ring-green-500"
                        {{ request('sort') === 'price_desc' ? 'checked' : '' }}>
                    <label for="harga-tertinggi"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-500 cursor-pointer">
                        Highest Price
                    </label>
                </li>
            </ul>
        </div>

        <!-- Filter Lokasi -->
        <div>
            <span class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Location</span>
            <ul class="space-y-2">
                <li class="flex items-center space-x-2">
                    <input type="checkbox" id="lokasi-terdekat" name="location[]" value="nearby"
                        class="rounded border-gray-300 text-green-500 p-2 focus:ring-2 focus:ring-green-500"
                        {{ request()->has('location') && in_array('nearby', request('location', [])) ? 'checked' : '' }}>
                    <label for="lokasi-terdekat"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-500 cursor-pointer">
                        Nearest Location
                    </label>
                </li>
            </ul>
        </div>

        <!-- Grade Filter -->
        <div>
            <span class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Grade</span>
            <ul class="space-y-2">
                <li class ="flex items-center space-x-2">
                    <input type="checkbox" id="grade-a" name="grade[]" value="Grade A"
                        class="rounded border-gray-300 text-green-500 p-2 focus:ring-2 focus:ring-green-500"
                        {{ in_array('Grade A', request('grade', [])) ? 'checked' : '' }}>
                    <label for="grade-a"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-500 cursor-pointer">
                        A (Premium)
                    </label>
                </li>
                <li class="flex items-center space-x-2">
                    <input type="checkbox" id="grade-b" name="grade[]" value="Grade B"
                        class="rounded border-gray-300 text-green-500 p-2 focus:ring-2 focus:ring-green-500"
                        {{ in_array('Grade B', request('grade', [])) ? 'checked' : '' }}>
                    <label for="grade-b"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-500 cursor-pointer">
                        B (Standard)
                    </label>
                </li>
            </ul>
        </div>

        <!-- Rating Filter -->
        <div>
            <span class="block text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Rating</span>
            <ul class="space-y-2">
                @foreach (range(5, 1) as $rating)
                    <li class="flex items-center space-x-2">
                        <input type="radio" id="rating-{{ $rating }}" name="rating" value="{{ $rating }}"
                            class="rounded border-gray-300 text-green-500 p-2 focus:ring-2 focus:ring-green-500"
                            {{ request('rating') == $rating ? 'checked' : '' }}>
                        <label for="rating-{{ $rating }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-green-500 cursor-pointer">
                            {{ str_repeat('★', $rating) }}{{ str_repeat('☆', 5 - $rating) }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="flex justify-center gap-10 mt-4">
        <!-- Clear Filter Button -->
        <div class="flex-row items-center mt-4">
            <button type="button"
                class="w-full bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-500 transition duration-150"
                onclick="clearFiltersAndStayOnPage()">Clear Filters</button>
        </div>
        <!-- Apply Filter Button -->
        <div class="flex-row items-center mt-4">
            <button type="button"
                class="w-full bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-green-500 transition duration-150"
                onclick="applyFilter()">Apply Filters</button>
        </div>


    </div>

</form>
<script>
    function applyFilter() {
        const form = document.getElementById('filter-form');

        const lokasiCheckbox = document.getElementById("lokasi-terdekat");
        if (lokasiCheckbox && lokasiCheckbox.checked) {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    let latInput = form.querySelector('input[name="user_latitude"]');
                    let lonInput = form.querySelector('input[name="user_longitude"]');

                    if (!latInput) {
                        latInput = document.createElement("input");
                        latInput.type = "hidden";
                        latInput.name = "user_latitude";
                        form.appendChild(latInput);
                    }
                    if (!lonInput) {
                        lonInput = document.createElement("input");
                        lonInput.type = "hidden";
                        lonInput.name = "user_longitude";
                        form.appendChild(lonInput);
                    }

                    latInput.value = latitude;
                    lonInput.value = longitude;

                    form.submit();
                });
            } else {
                alert("Geolocation not supported by this browser.");
            }
        } else {
            const latInput = form.querySelector('input[name="user_latitude"]');
            const lonInput = form.querySelector('input[name="user_longitude"]');
            if (latInput) latInput.remove();
            if (lonInput) lonInput.remove();
        }
        form.submit();
        window.location.hash = '#product-section';
    }

    function clearFiltersAndStayOnPage() {
        const form = document.getElementById('filter-form');
        form.reset();
        const latInput = form.querySelector('input[name="user_latitude"]');
        const lonInput = form.querySelector('input[name="user_longitude"]');
        if (latInput) latInput.remove();
        if (lonInput) lonInput.remove();
        window.history.pushState({}, "", window.location.pathname);
        window.location.hash = '#product-section';
        location.reload();
    }
</script>
