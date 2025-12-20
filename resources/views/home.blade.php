<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->


    {{-- <nav class="bg-white border-b shadow-sm">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">

            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <span class="text-xl font-bold text-red-600">RedStay</span>
            </a>

            <!-- Right button (desktop) -->
            <div class="flex md:order-2 space-x-2">
                <button
                    class="hidden md:inline-block text-red-600 border border-red-600 px-4 py-2 rounded-lg hover:bg-red-50 text-sm font-medium">
                    Login
                </button>
                <button
                    class="hidden md:inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
                    Daftar
                </button>

                <!-- Mobile menu button -->
                <button data-collapse-toggle="navbar-redstay" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-600 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-200"
                    aria-controls="navbar-redstay" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>

            <!-- Menu -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-redstay">
                <ul
                    class="flex flex-col font-medium p-4 md:p-0 mt-4 border rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="#" class="block py-2 px-3 text-red-600 md:p-0 font-semibold">
                            Hotel
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-red-600 md:p-0">
                            Promo
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-red-600 md:p-0">
                            Bantuan
                        </a>
                    </li>

                    <!-- Mobile login/register -->
                    <li class="md:hidden border-t pt-3 mt-3 space-y-2">
                        <button class="w-full text-red-600 border border-red-600 px-4 py-2 rounded-lg">
                            Login
                        </button>
                        <button class="w-full bg-red-600 text-white px-4 py-2 rounded-lg">
                            Daftar
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav> --}}
    <nav class="bg-white border-b shadow-sm">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">

            <!-- Logo -->
            <a href="/" class="text-xl font-bold text-red-600">
                RedStay
            </a>

            <!-- Right section -->
            <div class="flex items-center gap-2 md:order-2">

                @if (Route::has('login'))
                    @auth
                        <!-- Jika sudah login -->
                        <a href="{{ url('/dashboard') }}"
                            class="hidden md:inline-block text-red-600 border border-red-600 px-4 py-2 rounded-lg hover:bg-red-50 text-sm font-medium">
                            Dashboard
                        </a>
                    @else
                        <!-- Jika belum login -->
                        <a href="{{ route('login') }}"
                            class="hidden md:inline-block text-red-600 border border-red-600 px-4 py-2 rounded-lg hover:bg-red-50 text-sm font-medium">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="hidden md:inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 text-sm font-medium">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile menu button -->
                <button data-collapse-toggle="navbar-redstay" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-600 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-red-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>

            <!-- Menu -->
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-redstay">
                <ul class="flex flex-col md:flex-row md:space-x-8 font-medium mt-4 md:mt-0">
                    <li>
                        <a href="#" class="block py-2 text-red-600 font-semibold">
                            Hotel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 text-gray-700 hover:text-red-600">
                            Promo
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 text-gray-700 hover:text-red-600">
                            Bantuan
                        </a>
                    </li>

                    <!-- Mobile auth -->
                    @if (Route::has('login'))
                        @guest
                            <li class="md:hidden border-t pt-3 mt-3 space-y-2">
                                <a href="{{ route('login') }}"
                                    class="block w-full text-center text-red-600 border border-red-600 px-4 py-2 rounded-lg">
                                    Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded-lg">
                                        Daftar
                                    </a>
                                @endif
                            </li>
                        @endguest
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero -->
    <section class="bg-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Cari Hotel Murah & Nyaman
            </h1>
            <p class="mb-8">
                Menginap nyaman dengan harga terbaik
            </p>

            <!-- Search -->
            <div class="bg-white rounded-xl p-4 grid grid-cols-1 md:grid-cols-4 gap-4 text-gray-700">
                <input type="text" placeholder="Kota / Lokasi"
                    class="border rounded-lg p-3 focus:ring-red-500 focus:border-red-500">

                <input type="date" class="border rounded-lg p-3 focus:ring-red-500 focus:border-red-500">

                <input type="number" placeholder="Jumlah Tamu"
                    class="border rounded-lg p-3 focus:ring-red-500 focus:border-red-500">

                <button class="bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Cari Hotel
                </button>
            </div>
        </div>
    </section>

    @php
        $hotels = [
            [
                'name' => 'RedStay Hotel Jakarta',
                'city' => 'Jakarta Pusat',
                'image' =>
                    'https://images.reddoorz.com/photos/123708/desktop_hotel_gallery_large_900x600_90f45642-d04a-4194-aa88-38c41d5847c2_2F_DDP9374.jpg?w=900',
                'price' => 450000,
                'promo_price' => 320000,
                'is_promo' => true,
            ],
            [
                'name' => 'RedStay Hotel Bandung',
                'city' => 'Bandung',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945',
                'price' => 380000,
                'promo_price' => 290000,
                'is_promo' => true,
            ],
            [
                'name' => 'RedStay Hotel Surabaya',
                'city' => 'Surabaya',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa',
                'price' => 420000,
                'promo_price' => null,
                'is_promo' => false,
            ],
            [
                'name' => 'RedStay Hotel Medan',
                'city' => 'Medan',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945',
                'price' => 400000,
                'promo_price' => null,
                'is_promo' => false,
            ],
        ];
    @endphp


    <!-- Hotel List -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">
            Rekomendasi Hotel
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach ($hotels as $hotel)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                    <img src="{{ $hotel['image'] ?? asset('images/hotel-placeholder.jpg') }}"
                        onerror="this.src='https://via.placeholder.com/600x400?text=Hotel'"
                        class="rounded-t-xl w-full h-48 object-cover">


                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-lg">
                                {{ $hotel['name'] }}
                            </h3>

                            @if ($hotel['is_promo'])
                                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded">
                                    Promo
                                </span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-500 mb-3">
                            {{ $hotel['city'] }}
                        </p>

                        <div class="flex justify-between items-center">
                            <div>
                                @if ($hotel['promo_price'])
                                    <p class="text-gray-400 line-through text-sm">
                                        Rp {{ number_format($hotel['price'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-red-600 font-bold text-lg">
                                        Rp {{ number_format($hotel['promo_price'], 0, ',', '.') }}
                                    </p>
                                @else
                                    <p class="text-red-600 font-bold text-lg">
                                        Rp {{ number_format($hotel['price'], 0, ',', '.') }}
                                    </p>
                                @endif
                            </div>

                            <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h4 class="font-bold mb-3 text-white">RedStay</h4>
                <p class="text-sm">
                    Solusi penginapan murah & nyaman di seluruh Indonesia.
                </p>
            </div>

            <div>
                <h4 class="font-bold mb-3 text-white">Menu</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Hotel</a></li>
                    <li><a href="#" class="hover:text-white">Promo</a></li>
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-3 text-white">Kontak</h4>
                <p class="text-sm">support@redstay.com</p>
            </div>
        </div>

        <div class="text-center text-sm border-t border-gray-700 py-4">
            © {{ date('Y') }} RedStay. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>
