<x-red-stay-layout>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 bg-transparent navbar--transparent">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 text-2xl font-black tracking-wider text-white">
                <span class="text-neon-gradient">RedStay</span>
                <span class="text-xs font-semibold px-2 py-0.5 bg-electric-purple/20 text-electric-purple rounded-full border border-electric-purple/30">MVP</span>
            </a>

            <!-- Right section -->
            <div class="flex items-center gap-2 md:order-2">

                @if (Route::has('login'))
                    @auth
                        <!-- Jika sudah login -->
                        <a href="{{ url('/dashboard') }}"
                            class="hidden md:inline-block text-neon-cyan border border-neon-cyan/40 hover:border-neon-cyan px-4 py-2 rounded-lg hover:bg-neon-cyan/10 text-sm font-medium transition duration-200">
                            Dashboard
                        </a>
                    @else
                        <!-- Jika belum login -->
                        <a href="{{ route('login') }}"
                            class="hidden md:inline-block text-neon-cyan border border-neon-cyan/40 hover:border-neon-cyan px-4 py-2 rounded-lg hover:bg-neon-cyan/10 text-sm font-medium transition duration-200">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="hidden md:inline-block bg-neon-gradient text-white px-4 py-2 rounded-lg shadow-neon shadow-neon-hover hover:opacity-95 text-sm font-medium transition duration-200">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" data-collapse-toggle="navbar-redstay" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-700">
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
                        <a href="#" class="nav-link block py-2 text-gray-300 hover:text-neon-cyan transition duration-200">
                            Hotel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-gray-300 hover:text-neon-cyan transition duration-200">
                            Promo
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-gray-300 hover:text-neon-cyan transition duration-200">
                            Bantuan
                        </a>
                    </li>

                    <!-- Mobile auth -->
                    @if (Route::has('login'))
                        @guest
                            <li class="md:hidden border-t border-gray-800 pt-3 mt-3 space-y-2">
                                <a href="{{ route('login') }}"
                                    class="block w-full text-center text-neon-cyan border border-neon-cyan/40 px-4 py-2 rounded-lg">
                                    Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="block w-full text-center bg-neon-gradient text-white px-4 py-2 rounded-lg">
                                        Daftar
                                    </a>
                                @endif
                            </li>
                        @else
                            <li class="md:hidden border-t border-gray-800 pt-3 mt-3 space-y-2">
                                <a href="{{ url('/dashboard') }}"
                                    class="block w-full text-center text-neon-cyan border border-neon-cyan/40 px-4 py-2 rounded-lg">
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
    <section class="relative min-h-[75vh] flex items-center justify-center">
        <div class="absolute inset-0">
            <img loading="lazy"
                src="https://images.reddoorz.com/banner/id/153/KV_Reddoorz_Main_Visual_webmainbanner-1366x530-hi_ID__1_.jpg?w=1366"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-[#0b0f19]/90 via-[#0b0f19]/70 to-[#0b0f19]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 py-24 text-center text-white z-10">
            <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tight">
                Cari Hotel Murah & <span class="text-neon-gradient">Nyaman</span>
            </h1>
            <p class="mb-12 text-gray-400 text-lg md:text-xl font-light">
                Agregator akomodasi terstandardisasi, andal, dan transparan
            </p>

            <form method="GET" action="{{ route('home') }}"
                class="glass-card rounded-2xl p-6 grid grid-cols-1 md:grid-cols-5 gap-4 text-gray-300 shadow-2xl">

                {{-- Kota --}}
                <div class="relative">
                    <input list="city-list" name="kota" value="{{ request('kota') }}" placeholder="Kota / Lokasi"
                        class="bg-gray-950/50 border border-gray-800 rounded-xl p-3 focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan text-white w-full">
                    <datalist id="city-list">
                        @foreach ($cities as $city)
                            <option value="{{ $city }}"></option>
                        @endforeach
                    </datalist>
                </div>

                {{-- Date Range --}}
                <div date-rangepicker datepicker-min-date="{{ now()->format('Y-m-d') }}" datepicker-format="yyyy-mm-dd"
                    datepicker-autohide class="flex items-center gap-2 border border-gray-800 rounded-xl p-2 bg-gray-950/50">

                    <input name="checkin" type="text" value="{{ request('checkin') }}" placeholder="Check-in"
                        class="bg-transparent border-0 focus:ring-0 focus:outline-none w-full text-sm text-white" required>

                    <span class="text-gray-500">→</span>

                    <input name="checkout" type="text" value="{{ request('checkout') }}" placeholder="Check-out"
                        class="bg-transparent border-0 focus:ring-0 focus:outline-none w-full text-sm text-white" required>
                </div>

                {{-- Jumlah Tamu --}}
                <div>
                    <input type="number" name="guest" min="1" value="{{ request('guest') }}"
                        placeholder="Jumlah Tamu"
                        class="bg-gray-950/50 border border-gray-800 rounded-xl p-3 focus:outline-none focus:border-neon-cyan focus:ring-1 focus:ring-neon-cyan text-white w-full">
                </div>

                {{-- Button --}}
                <button type="submit" class="bg-neon-gradient text-white rounded-xl shadow-neon hover:shadow-neon-hover font-semibold transition-all duration-300 py-3">
                    Cari Hotel
                </button>

                {{-- Reset --}}
                @if (request()->anyFilled(['kota', 'checkin', 'checkout', 'guest']))
                    <a href="{{ route('home') }}"
                        class="flex items-center justify-center border border-gray-800 hover:border-gray-700 text-gray-400 hover:text-white rounded-xl font-medium transition duration-200 py-3">
                        Reset
                    </a>
                @endif

            </form>

        </div>
    </section>

    <!-- Hotel List -->
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-white">
                    @if (request()->anyFilled(['kota', 'checkin', 'checkout', 'guest']))
                        Hasil Pencarian
                    @else
                        Rekomendasi Hotel
                    @endif
                </h2>
                <p class="text-gray-400 mt-1 text-sm">Akomodasi budget pilihan terstandardisasi</p>
            </div>
            <div class="h-1 w-20 bg-neon-gradient rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($hotels as $hotel)
                <a href="{{ $hotel['url'] }}"
                    class="group bg-gray-900/40 border border-gray-800/80 rounded-2xl shadow-xl hover:shadow-neon hover:border-gray-700/60 transition-all duration-300 overflow-hidden flex flex-col">

                    <div class="relative overflow-hidden h-52">
                        <img src="{{ $hotel['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $hotel['name'] }}">
                        @if ($hotel['is_promo'])
                            <span class="absolute top-4 left-4 bg-neon-gradient text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                PROMO
                            </span>
                        @endif
                        <span class="absolute bottom-4 right-4 bg-gray-950/80 backdrop-blur-md text-gray-300 text-xs px-2.5 py-1 rounded-lg border border-gray-800 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            4.8
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-xl text-white group-hover:text-neon-cyan transition duration-200 line-clamp-1">
                                {{ $hotel['name'] }}
                            </h3>

                            <p class="text-sm text-gray-400 mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4 text-neon-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $hotel['city'] }}
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-800/80 flex justify-between items-center">
                            <div>
                                @if ($hotel['is_promo'])
                                    <span class="line-through text-gray-500 text-xs block">
                                        Rp {{ number_format($hotel['price']) }}
                                    </span>
                                    <span class="text-neon-cyan font-extrabold text-lg">
                                        Rp {{ number_format($hotel['promo_price']) }}
                                    </span>
                                @else
                                    <span class="font-extrabold text-lg text-white">
                                        Rp {{ number_format($hotel['price']) }}
                                    </span>
                                @endif
                                <span class="text-xs text-gray-400">/ malam</span>
                            </div>

                            <button class="bg-neon-gradient text-white text-sm px-4 py-2 rounded-lg font-semibold shadow-neon transition duration-300">
                                Detail
                            </button>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-3 text-center py-12 glass-card rounded-2xl border border-gray-800">
                    <svg class="w-12 h-12 text-gray-500 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-400 font-medium">Hotel tidak ditemukan</p>
                    <p class="text-sm text-gray-500 mt-1">Coba gunakan kata kunci kota lain</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Promo Hotels --}}
    @if ($promoHotels->isNotEmpty())
    <div class="bg-gray-950/40 border-t border-b border-gray-900 py-16">
        <section class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-white">
                        Kamar Diskon Spesial
                    </h2>
                    <p class="text-gray-400 mt-1 text-sm">Dapatkan potongan harga langsung khusus hari ini</p>
                </div>
                <div class="h-1 w-20 bg-neon-gradient rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($promoHotels as $promoHotel)
                    <a href="{{ $promoHotel['url'] }}"
                        class="group bg-gray-900/40 border border-gray-800/80 rounded-2xl shadow-xl hover:shadow-neon hover:border-gray-700/60 transition-all duration-300 overflow-hidden flex flex-col">

                        <div class="relative overflow-hidden h-52">
                            <img src="{{ $promoHotel['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $promoHotel['name'] }}">
                            <span class="absolute top-4 left-4 bg-neon-gradient text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                PROMO DASHING
                            </span>
                        </div>

                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-xl text-white group-hover:text-neon-cyan transition duration-200 line-clamp-1">
                                    {{ $promoHotel['name'] }}
                                </h3>

                                <p class="text-sm text-gray-400 mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4 text-neon-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $promoHotel['city'] }}
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-800/80 flex justify-between items-center">
                                <div>
                                    <span class="line-through text-gray-500 text-xs block">
                                        Rp {{ number_format($promoHotel['price']) }}
                                    </span>
                                    <span class="text-neon-cyan font-extrabold text-lg">
                                        Rp {{ number_format($promoHotel['promo_price']) }}
                                    </span>
                                    <span class="text-xs text-gray-400">/ malam</span>
                                </div>

                                <button class="bg-neon-gradient text-white text-sm px-4 py-2 rounded-lg font-semibold shadow-neon transition duration-300">
                                    Ambil Promo
                                </button>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-gray-900 text-gray-400">
        <div class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h4 class="text-2xl font-black tracking-wider text-neon-gradient mb-4">RedStay</h4>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Platform agregator & pemesanan hotel budget terstandardisasi di Indonesia. Nyaman, andal, cepat, dan transparan oleh Romadoni Labs.
                </p>
            </div>

            <div>
                <h4 class="font-bold mb-4 text-white uppercase text-sm tracking-widest">Akses Cepat</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-neon-cyan transition duration-200">Daftar Hotel</a></li>
                    <li><a href="#" class="hover:text-neon-cyan transition duration-200">Promo Unggulan</a></li>
                    <li><a href="#" class="hover:text-neon-cyan transition duration-200">Cara Pemesanan</a></li>
                    <li><a href="#" class="hover:text-neon-cyan transition duration-200">Pusat Bantuan</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-4 text-white uppercase text-sm tracking-widest">Layanan Pelanggan</h4>
                <p class="text-sm leading-relaxed mb-2">Punya pertanyaan atau kendala?</p>
                <p class="text-lg font-bold text-white mb-2">support@redstay.com</p>
                <p class="text-xs text-gray-500">Romadoni Labs Product Ecosystem © {{ date('Y') }}</p>
            </div>
        </div>

        <div class="text-center text-xs border-t border-gray-900 py-6 text-gray-600 bg-gray-950/50">
            © {{ date('Y') }} RedStay Booking Platform. Hak Cipta Dilindungi.
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
                navbar.classList.add('bg-[#0b0f19]/90', 'backdrop-blur-md', 'border-b', 'border-gray-800/80', 'shadow-lg');

                navLinks.forEach(link => {
                    link.classList.remove('text-gray-300');
                    link.classList.add('text-gray-200');
                });
            }

            function setNavbarTransparent() {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-[#0b0f19]/90', 'backdrop-blur-md', 'border-b', 'border-gray-800/80', 'shadow-lg');

                navLinks.forEach(link => {
                    link.classList.remove('text-gray-200');
                    link.classList.add('text-gray-300');
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
