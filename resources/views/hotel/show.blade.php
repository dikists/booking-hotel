<x-red-stay-layout>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-50 bg-white border-b shadow-sm">
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
                        <a href="#" class="nav-link block py-2 text-dark hover:text-red-300">
                            Hotel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-dark hover:text-red-300">
                            Promo
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-dark hover:text-red-300">
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

    <nav class="max-w-7xl mx-auto px-4 mt-28 mb-4 text-sm text-gray-500">
        <ol class="flex flex-wrap items-center gap-1">
            <li>
                <a href="/" class="hover:text-red-600">Indonesia</a>
            </li>
            <li>&gt;</li>

            <li>
                <a href="#" class="hover:text-red-600">
                    {{ $breadcrumb['province'] }}
                </a>
            </li>
            <li>&gt;</li>

            <li>
                <a href="#" class="hover:text-red-600">
                    {{ $breadcrumb['city'] }}
                </a>
            </li>
            <li>&gt;</li>

            <li>
                <a href="#" class="hover:text-red-600">
                    {{ $breadcrumb['district'] }}
                </a>
            </li>
            <li>&gt;</li>

            <li class="text-gray-700 font-medium">
                {{ $breadcrumb['hotel'] }}
            </li>
        </ol>
    </nav>

    {{-- GALLERY --}}
    <section class="max-w-7xl mx-auto px-4 mt-6">
        <div class="relative grid grid-cols-1 md:grid-cols-4 gap-3 rounded-xl overflow-hidden mt-6">

            {{-- FOTO BESAR --}}
            <div class="md:col-span-2 md:row-span-2 cursor-pointer" onclick="openPropertyGallery()">
                <img src="{{ $property->thumbnail
                    ? asset('storage/' . $property->thumbnail)
                    : 'https://via.placeholder.com/1200x600?text=Hotel' }}"
                    class="w-full h-full object-cover rounded-l-xl">
            </div>

            {{-- FOTO KECIL --}}
            @foreach ($property_galleries->take(4) as $gallery)
                <div class="cursor-pointer" onclick="openPropertyGallery()">
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-40 object-cover">
                </div>
            @endforeach
            <script>
                window.propertyImages = @json(collect($property_galleries)->pluck('image')->map(fn($img) => asset('storage/' . $img)));
            </script>


            {{-- BUTTON --}}
            <button onclick="openPropertyGallery()"
                class="absolute top-4 right-4 z-10
                   bg-black/60 text-white text-sm
                   px-3 py-2 rounded-lg
                   hover:bg-black">
                Lihat semua foto
            </button>

        </div>

    </section>

    <!-- HOTEL INFO -->
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">
                {{ $property->name }}
            </h1>
            <h3 class="text-xl">
                {{ $property->address }}
            </h3>
        </div>
        <div class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-center text-sm">

            <div>
                <p class="font-semibold">Check-in</p>
                <p class="text-gray-500">14:00</p>
            </div>

            <div>
                <p class="font-semibold">Check-out</p>
                <p class="text-gray-500">12:00</p>
            </div>

            <div>
                <p class="font-semibold">WiFi</p>
                <p class="text-gray-500">Gratis</p>
            </div>

            <div>
                <p class="font-semibold">Parkir</p>
                <p class="text-gray-500">Tersedia</p>
            </div>

        </div>
    </section>

    @php
        $hasDate = request('checkin') && request('checkout');
    @endphp

    <!-- ROOM LIST -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6">
            Pilih Kamar
        </h2>

        <form method="GET" action=""
            class="bg-white p-4 rounded-xl shadow mb-8 grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">

            {{-- Date Range --}}
            <div class="sm:col-span-2">
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Tanggal Menginap
                </label>

                <div date-rangepicker datepicker-min-date="{{ now()->format('Y-m-d') }}" datepicker-format="yyyy-mm-dd"
                    datepicker-autohide class="flex items-center gap-2">

                    <input name="checkin" type="text" value="{{ request('checkin') }}" placeholder="Check-in"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                       focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required>

                    <span class="text-gray-500">→</span>

                    <input name="checkout" type="text" value="{{ request('checkout') }}" placeholder="Check-out"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                       focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required>
                </div>
            </div>

            {{-- Button --}}
            <div>
                <button class="w-full bg-red-600 text-white px-6 py-3 rounded-lg disabled:opacity-50"
                    :disabled="!checkin || !checkout">
                    Cari Kamar
                </button>

            </div>

        </form>




        <div class="space-y-6">
            @foreach ($rooms as $room)
                <div
                    class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col md:flex-row">

                    <!-- Image -->
                    <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}"
                        class="w-full md:w-64 h-48 object-cover cursor-pointer hover:opacity-90 transition"
                        onclick="openRoomGallery({{ $room['id'] }})" />

                    <!-- Content -->
                    <div class="flex-1 p-5 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold">
                                    {{ $room['name'] }}
                                </h3>

                                @if ($room['is_promo'])
                                    <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded">
                                        Promo
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-gray-500 mb-4">
                                Kapasitas {{ $room['capacity'] }} orang
                            </p>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                @if ($room['is_promo'])
                                    <p class="text-gray-400 line-through text-sm">
                                        Rp {{ number_format($room['base_price'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-red-600 font-bold text-xl">
                                        Rp {{ number_format($room['final_price'], 0, ',', '.') }}
                                    </p>
                                @else
                                    <p class="text-red-600 font-bold text-xl">
                                        Rp {{ number_format($room['final_price'], 0, ',', '.') }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-500">/ malam</p>
                            </div>

                            <a href="{{ $hasDate
                                ? route('booking.create', [
                                    'room_id' => $room['id'],
                                    'checkin' => request('checkin'),
                                    'checkout' => request('checkout'),
                                ])
                                : '#' }}"
                                class="px-6 py-3 rounded-lg font-medium transition
                               {{ $hasDate ? 'bg-red-600 text-white hover:bg-red-700' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                                {{ $hasDate ? '' : 'onclick=return false' }}>
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <script>
                const roomGalleries = @json(collect($rooms)->mapWithKeys(fn($room) => [
                            $room['id'] => $room['gallery'],
                        ]));
            </script>
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


    {{-- modal gallery --}}
    {{-- room gallery --}}
    <div id="roomGalleryModal" class="fixed inset-0 bg-black/50 z-50 hidden" onclick="closeRoomGallery()">

        <!-- Close -->
        <button onclick="closeRoomGallery()"
            class="absolute top-4 right-4 z-50 text-white text-2xl
               bg-black/50 rounded-full w-10 h-10">
            ✕
        </button>

        <div class="relative w-full max-w-7xl mx-auto px-4 flex items-center justify-center"
            onclick="event.stopPropagation()">


            <div class="swiper w-full max-w-7xl h-[80vh] rounded-xl overflow-hidden">
                <div class="swiper-wrapper" id="swiperWrapper"></div>

                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>

    <div id="propertyGalleryModal" class="fixed inset-0 bg-black/50 z-50 hidden" onclick="closePropertyGallery()">

        <!-- Close -->
        <button onclick="closePropertyGallery()"
            class="absolute top-4 right-4 z-50 text-white text-2xl
               bg-black/50 rounded-full w-10 h-10">
            ✕
        </button>

        <div class="relative w-full max-w-7xl mx-auto px-4 flex items-center justify-center"
            onclick="event.stopPropagation()">


            <div class="swiper property-swiper w-full max-w-7xl h-[80vh] rounded-xl overflow-hidden">
                <div class="swiper-wrapper" id="propertySwiperWrapper"></div>

                <div class="swiper-button-prev text-white"></div>
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>


    @push('scripts')
        {{-- <script>
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
        </script> --}}
        <script>
            let swiperInstance = null;

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeRoomGallery();
                    closePropertyGallery();
                }
            });

            // ================= ROOM GALLERY =================
            window.openRoomGallery = function(roomId) {

                const images = roomGalleries[roomId] || [];
                if (images.length === 0) return;

                document.body.classList.add('overflow-hidden');

                const wrapper = document.getElementById('swiperWrapper');
                wrapper.innerHTML = '';

                images.forEach(img => {
                    wrapper.innerHTML += `
                    <div class="swiper-slide flex items-center justify-center h-full">
                        <img src="${img}"
                            class="max-h-[75vh] max-w-full object-contain rounded-lg select-none">
                    </div>
                `;
                });

                document.getElementById('roomGalleryModal').classList.remove('hidden');

                if (swiperInstance) {
                    swiperInstance.destroy(true, true);
                }

                swiperInstance = new Swiper('.swiper', {
                    loop: true,
                    centeredSlides: true,
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    keyboard: {
                        enabled: true,
                    },
                });
            }

            window.closeRoomGallery = function() {
                document.body.classList.remove('overflow-hidden');
                document.getElementById('roomGalleryModal').classList.add('hidden');

                if (swiperInstance) {
                    swiperInstance.destroy(true, true);
                    swiperInstance = null;
                }
            }

            // ================= PROPERTY GALLERY =================
            let propertySwiper = null;

            window.openPropertyGallery = function() {
                if (!window.propertyImages || propertyImages.length === 0) return;

                document.body.classList.add('overflow-hidden');

                const wrapper = document.getElementById('propertySwiperWrapper');
                wrapper.innerHTML = '';

                propertyImages.forEach(img => {
                    wrapper.innerHTML += `
                        <div class="swiper-slide flex items-center justify-center h-full">
                            <img src="${img}"
                                class="max-h-[75vh] max-w-full object-contain rounded-xl">
                        </div>
                    `;
                });

                document.getElementById('propertyGalleryModal')
                    .classList.remove('hidden');

                if (propertySwiper) {
                    propertySwiper.destroy(true, true);
                }

                propertySwiper = new Swiper('.property-swiper', {
                    loop: true,
                    centeredSlides: true,
                    slidesPerView: 1,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    keyboard: {
                        enabled: true,
                    },
                });
            }

            window.closePropertyGallery = function() {
                document.body.classList.remove('overflow-hidden');
                document.getElementById('propertyGalleryModal')
                    .classList.add('hidden');

                if (propertySwiper) {
                    propertySwiper.destroy(true, true);
                    propertySwiper = null;
                }
            }
        </script>
    @endpush

</x-red-stay-layout>
