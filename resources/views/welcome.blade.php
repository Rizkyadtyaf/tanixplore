<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>taniXplore</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
    <style>
        /* Tambahkan gaya untuk blur background saat modal aktif */
        .modal-open #contentWrapper {
            filter: blur(5px);
            opacity: 0.7;
            pointer-events: none;
            /* Mencegah interaksi dengan background yang di-blur */
        }

        /* Pastikan modal tetap tajam dan dapat berinteraksi */
        #authModal {
            position: fixed;
            z-index: 1000;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        /* Pastikan modal dapat diklik dan tidak ikut blur */
        .modal-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            pointer-events: none;
            /* Awalnya non-interaktif */
        }

        .modal-wrapper>* {
            pointer-events: auto;
            /* Memastikan modal dapat diklik */
        }

        /* Animasi transisi modal */
        #authModal {
            opacity: 0;
            visibility: hidden;
            transform: translate(-50%, -50%) scale(0.7);
            transition: all 0.3s ease;
        }

        .modal-open #authModal {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, -50%) scale(1);
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-[#EBEBEB] dark:bg-[#1A1A1A]">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-2xl px-6 lg:max-w-7xl min-h-screen flex flex-col items-center justify-center">
                <!-- Wrapper untuk background yang bisa di blur -->
                <div id="contentWrapper">
                    <div class="bg-opacity-20 bg-clip-padding backdrop-filter backdrop-blur-sm z-50 rounded-lg">
                        <!-- Header -->
                        <header class="grid grid-cols-2 items-center gap-2 lg:grid-cols-3">
                            <div class="flex lg:justify-center lg:col-start-2">
                                <img src="{{ asset('images/logo1.png') }}" alt="taniXplore"
                                    class="w-40 h-40 lg:w-[70%] lg:h-[70%]" />
                            </div>
                            @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                        <a href="{{ url('/dashboard') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Log in
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="rounded-md px-3 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </header>

                        <!-- Sisa konten sebelumnya tetap sama -->
                        <main class="-mt-8 lg:-mt-16">
                            <div class="grid gap-6 lg:grid-cols-2 lg:gap-4 lg:mb-4">
                                {{-- dashboard --}}
                                <div
                                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg p-6 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] 
                                    hover:text-black/70 md:row-span-3 lg:p-10 lg:pb-10 dark:hover:text-white/70 transition duration-300 ease-in-out">
                                    <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                        <img src="{{ asset('images/hasil-bumi.JPG') }}" alt="TaniXplore"
                                            class="block aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block" />
                                        <div
                                            class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-[#EBEBEB] to-[#EBEBEB] dark:via-zinc-900 dark:to-zinc-900">
                                        </div>
                                    </div>

                                    <div class="relative flex items-center gap-6 lg:items-end">
                                        <div class="flex items-start gap-6 lg:flex-col">
                                            <div class="pt-3 sm:pt-5 lg:pt-0">
                                                <h2 class="text-xl flex gap-4 font-semibold text-black dark:text-white">
                                                    <div
                                                        class="flex size-8 items-center justify-center rounded-full bg-[#089101]/10">
                                                        <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path fill="#42B549"
                                                                d="M23 4a1 1 0 0 0-1.447-.894L12.224 7.77a.5.5 0 0 1-.448 0L2.447 3.106A1 1 0 0 0 1 4v13.382a1.99 1.99 0 0 0 1.105 1.79l9.448 4.728c.14.065.293.1.447.1.154-.005.306-.04.447-.105l9.453-4.724a1.99 1.99 0 0 0 1.1-1.789V4ZM3 6.023a.25.25 0 0 1 .362-.223l7.5 3.75a.251.251 0 0 1 .138.223v11.2a.25.25 0 0 1-.362.224l-7.5-3.75a.25.25 0 0 1-.138-.22V6.023Zm18 11.2a.25.25 0 0 1-.138.224l-7.5 3.75a.249.249 0 0 1-.329-.099.249.249 0 0 1-.033-.12V9.772a.251.251 0 0 1 .138-.224l7.5-3.75a.25.25 0 0 1 .362.224v11.2Z" />
                                                            <path fill="#42B549"
                                                                d="m3.55 1.893 8 4.048a1.008 1.008 0 0 0 .9 0l8-4.048a1 1 0 0 0-.9-1.785l-7.322 3.706a.506.506 0 0 1-.452 0L4.454.108a1 1 0 0 0-.9 1.785H3.55Z" />
                                                        </svg>
                                                    </div>
                                                    Dashboard
                                                </h2>

                                                <p class="mt-4 text-sm/relaxed">
                                                    The dashboard serves as your personal control center in <span
                                                        class="text-green-600 font-bold">taniXplore</span>. This is
                                                    where buyers can easily find products and see the location of the
                                                    farmer.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- shoping --}}
                                <a href="#" onclick="handleClick('shoping')"
                                    class="flex items-start gap-4 rounded-lg p-6 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] 
                                    hover:text-black/70 dark:hover:text-white/70 transition duration-300 ease-in-out">
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#089101]/10 sm:size-16">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-6 sm:size-8 text-green-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </div>
                                    <div class="pt-3 sm:pt-5">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Shoping</h2>
                                        <p class="mt-4 text-sm/relaxed">
                                            The farmers at <span class="text-green-600 font-bold">taniXplore</span> aim
                                            to provide high quality products directly from trusted farmers, making it
                                            easier for you to shop for the best products available in your area.
                                        </p>
                                    </div>
                                    <svg class="size-6 shrink-0 self-center stroke-[#089101]"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

                                {{-- Add Product --}}
                                <a href="#" onclick="handleClick('addProduct')"
                                    class="flex items-start gap-4 rounded-lg p-6 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)]
                                    hover:text-black/70 dark:hover:text-white/70 transition duration-300 ease-in-out">
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#089101]/10 sm:size-16">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="size-6 sm:size-9 text-green-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                    </div>
                                    <div class="pt-3 sm:pt-5">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Add Product</h2>
                                        <p class="mt-4 text-sm/relaxed">
                                            The Add Product feature is designed for sellers who want to showcase their
                                            fresh produce and can bring farmer products to the digital marketplace.
                                        </p>
                                    </div>

                                    <svg class="size-6 shrink-0 self-center stroke-[#089101]"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

                                {{-- about --}}
                                <div
                                    class="flex items-start gap-4 rounded-lg p-6 shadow-light dark:shadow-[2px_2px_2px_rgba(0,0,0,1),-2px_-2px_2px_rgba(64,64,64,0.63)] cursor-default">
                                    <div
                                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#089101]/10 sm:size-16">
                                        <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <g fill="#089101">
                                                <path
                                                    d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z" />
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="pt-3 sm:pt-5">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">About</h2>
                                        <p class="mt-4 text-sm/relaxed">
                                            <span class="text-green-600 font-bold">taniXplore</span> is dedicated to
                                            connecting farmers and customers in a sustainable, efficient and seamless
                                            manner. We aim to promote high quality, fresh and organic products. Its
                                            mission is to bring farmers closer to their customers, ensuring reliable
                                            service and fair markets for everyone involved.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>

            <!-- Modal  validasi button Login/Register -->
            <div id="authModal" class="modal-wrapper hidden">
                <div class="bg-white p-6 rounded-lg shadow-md w-96 text-center relative">
                    <button onclick="closeModal()" class="absolute top-4 right-4 text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                    <div id="modal-content">
                        {{-- content modal validasi --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleClick(type) {
            @auth
            // Cek apakah sudah login
            @if (auth()->check())
                if (type === 'shoping') {
                    window.location.href = "{{ route('dashboard') }}";
                } else if (type === 'addProduct') {
                    @if (auth()->user()->role === 'owner')
                        window.location.href = "{{ route('product.create') }}";
                    @else
                        showModal('limited-access');
                    @endif
                }
            @else
                showModal('login-required');
            @endif
        @else
            showModal('login-required');
        @endauth
        }

        function showModal(type) {
            document.getElementById('authModal').classList.add('hidden');
            document.body.classList.add('modal-open');

            // Atur konten modal berdasarkan tipe
            const modalContent = document.getElementById('modal-content');
            if (type === 'login-required') {
                modalContent.innerHTML = `
                    <h1 class="text-xl font-bold text-red-700">WARNING!</h1>
                    <h2 class="text-md mt-4 font-bold text-black">You are not logged in yet</h2>
                    <p class="text-gray-600">Please log in or register to continue.</p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800">Login</a>
                        |
                        <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800">Register</a>
                    </div>
                `;
            } else if (type === 'limited-access') {
                modalContent.innerHTML = `
                    <h1 class="text-xl font-bold text-red-700">LIMITED ACCESS</h1>
                    <h2 class="text-md mt-4 font-bold text-black">Limited Product Add Features</h2>
                    <p class="text-gray-600">Sorry, the Add Product feature can only be accessed by accounts with the Owner role.</p>
                    <div class="mt-4 text-sm text-gray-500">
                       Please register an account with the Owner role to access this feature.
                    </div>
                `;
            }

            // Tampilkan modal
            document.getElementById('authModal').classList.remove('hidden');
        }

        function closeModal() {
            document.body.classList.remove('modal-open');
            document.getElementById('authModal').classList.add('hidden');
        }
    </script>
</body>

</html>
