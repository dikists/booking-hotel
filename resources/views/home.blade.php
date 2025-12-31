<x-red-stay-layout>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 bg-transparent navbar--transparent">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">

            <!-- Logo -->
            <a href="/" class="text-xl font-bold text-red-600">
                <x-application-logo class="w-16 h-12" />
                {{-- RedStay --}}
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
                <button id="mobile-menu-btn" data-collapse-toggle="navbar-redstay" type="button"
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
                        <a href="#" class="nav-link block py-2 text-white hover:text-red-300">
                            Hotel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-white hover:text-red-300">
                            Promo
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-white hover:text-red-300">
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
                        @else
                            <li class="md:hidden border-t pt-3 mt-3 space-y-2">
                                <a href="{{ url('/dashboard') }}"
                                    class="block w-full text-center text-red-600 border border-red-600 px-4 py-2 rounded-lg">
                                    Dashboard
                                </a>
                            </li>
                        @endguest
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="relative min-h-[70vh]">
        <div class="absolute inset-0">
            <img loading="lazy"
                src="https://images.reddoorz.com/banner/id/153/KV_Reddoorz_Main_Visual_webmainbanner-1366x530-hi_ID__1_.jpg?w=1366"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/30"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 py-24 text-center text-white">
            <h1 class="text-4xl font-bold mb-4">
                Cari Hotel Murah & Nyaman
            </h1>
            <p class="mb-10 text-gray-200">
                Menginap nyaman dengan harga terbaik
            </p>

            <!-- Search tetap sama -->
            <div class="bg-white rounded-xl p-4 grid grid-cols-1 md:grid-cols-4 gap-4 text-gray-700 shadow-lg">
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

    {{-- @php
        $hotels = [
            [
                'name' => 'RedStay Hotel Jakarta',
                'city' => 'Jakarta Pusat',
                'image' =>
                    'https://images.reddoorz.com/photos/123708/desktop_hotel_gallery_large_900x600_90f45642-d04a-4194-aa88-38c41d5847c2_2F_DDP9374.jpg?w=900',
                'price' => 450000,
                'promo_price' => 320000,
                'is_promo' => true,
                'url'   => '/hotel/indonesia/banten/tangerang/benda/reddstay-near-soetta',
            ],
            [
                'name' => 'RedStay Hotel Bandung',
                'city' => 'Bandung',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945',
                'price' => 380000,
                'promo_price' => 290000,
                'is_promo' => true,
                'url'   => '/hotel/indonesia/banten/tangerang/benda/reddstay-near-soetta',
            ],
            [
                'name' => 'RedStay Hotel Surabaya',
                'city' => 'Surabaya',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa',
                'price' => 420000,
                'promo_price' => null,
                'is_promo' => false,
                'url'   => '/hotel/indonesia/banten/tangerang/benda/reddstay-near-soetta',
            ],
            [
                'name' => 'RedStay Hotel Medan',
                'city' => 'Medan',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945',
                'price' => 400000,
                'promo_price' => null,
                'is_promo' => false,
                'url'   => '/hotel/indonesia/banten/tangerang/benda/reddstay-near-soetta',
            ],
        ];
    @endphp --}}


    <!-- Hotel List -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">
            Rekomendasi Hotel
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($hotels as $hotel)
            <a href="{{ $hotel['url'] }}">
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
            </a>
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


    @push('scripts')
        <script>
            const navbar = document.getElementById('navbar');
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('navbar-redstay');
            const navLinks = navbar.querySelectorAll('.nav-link');

            function setNavbarSolid() {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow');

                navLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:text-red-300');
                    link.classList.add('text-gray-700', 'hover:text-red-600');
                });
            }

            function setNavbarTransparent() {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-white', 'shadow');

                navLinks.forEach(link => {
                    link.classList.remove('text-gray-700', 'hover:text-red-600');
                    link.classList.add('text-white', 'hover:text-red-300');
                });
            }

            // Scroll
            window.addEventListener('scroll', () => {
                if (window.scrollY > 80) {
                    setNavbarSolid();
                } else if (mobileMenu.classList.contains('hidden')) {
                    setNavbarTransparent();
                }
            });

            // Mobile menu
            menuBtn.addEventListener('click', () => {
                setTimeout(() => {
                    if (!mobileMenu.classList.contains('hidden')) {
                        setNavbarSolid();
                    } else if (window.scrollY <= 80) {
                        setNavbarTransparent();
                    }
                }, 10);
            });
        </script>
    @endpush

</x-red-stay-layout>
