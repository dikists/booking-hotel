<x-red-stay-layout>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-50 bg-[#0b0f19]/90 backdrop-blur-md border-b border-gray-800/80 shadow-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4 py-3">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 text-2xl font-black tracking-wider text-white">
                <span class="text-neon-gradient">RedStay</span>
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
                                class="hidden md:inline-block bg-neon-gradient text-white px-4 py-2 rounded-lg shadow-neon hover:opacity-95 text-sm font-medium transition duration-200">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" data-collapse-toggle="navbar-redstay" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-400 rounded-lg md:hidden hover:bg-gray-800 focus:outline-none">
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
                        <a href="#" class="nav-link block py-2 text-gray-200 hover:text-neon-cyan transition duration-200">
                            Hotel
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-gray-200 hover:text-neon-cyan transition duration-200">
                            Promo
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link block py-2 text-gray-200 hover:text-neon-cyan transition duration-200">
                            Bantuan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BREADCRUMBS -->
    <nav class="max-w-7xl mx-auto px-4 mt-28 mb-4 text-sm text-gray-400">
        <ol class="flex flex-wrap items-center gap-1">
            <li>
                <a href="/" class="hover:text-neon-cyan transition">Indonesia</a>
            </li>
            <li>&gt;</li>

            <li>
                <a href="#" class="hover:text-neon-cyan transition">
                    {{ $breadcrumb['province'] }}
                </a>
            </li>
            <li>&gt;</li>

            <li>
                <a href="#" class="hover:text-neon-cyan transition">
                    {{ $breadcrumb['city'] }}
                </a>
            </li>
            <li>&gt;</li>

            <li>
                <a href="#" class="hover:text-neon-cyan transition">
                    {{ $breadcrumb['district'] }}
                </a>
            </li>
            <li>&gt;</li>

            <li class="text-neon-cyan font-medium">
                {{ $breadcrumb['hotel'] }}
            </li>
        </ol>
    </nav>

    {{-- GALLERY --}}
    <section class="max-w-7xl mx-auto px-4 mt-6">
        <div class="relative grid grid-cols-1 md:grid-cols-4 gap-3 rounded-2xl overflow-hidden mt-6 border border-gray-800 shadow-2xl">

            {{-- FOTO BESAR --}}
            <div class="md:col-span-2 md:row-span-2 cursor-pointer overflow-hidden group" onclick="openPropertyGallery()">
                <img src="{{ $property->thumbnail
                    ? asset('storage/' . $property->thumbnail)
                    : 'https://via.placeholder.com/1200x600?text=Hotel' }}"
                    class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
            </div>

            {{-- FOTO KECIL --}}
            @foreach ($property_galleries->take(4) as $gallery)
                <div class="cursor-pointer overflow-hidden group" onclick="openPropertyGallery()">
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-40 object-cover group-hover:scale-[1.04] transition-transform duration-500">
                </div>
            @endforeach
            <script>
                window.propertyImages = @json(collect($property_galleries)->pluck('image')->map(fn($img) => asset('storage/' . $img)));
            </script>

            {{-- BUTTON --}}
            <button onclick="openPropertyGallery()"
                class="absolute top-4 right-4 z-10
                   bg-gray-950/80 backdrop-blur-md text-gray-200 border border-gray-800 text-sm
                   px-4 py-2.5 rounded-xl font-semibold shadow-lg
                   hover:bg-gray-900 hover:text-white transition duration-200">
                Lihat Semua Foto
            </button>

        </div>
    </section>

    <!-- HOTEL INFO -->
    <section class="border-b border-gray-900 bg-gray-950/20 py-8 mt-6">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <h1 class="text-3xl md:text-5xl font-black mb-3 tracking-tight text-white">
                    {{ $property->name }}
                </h1>
                <p class="text-gray-400 flex items-center gap-2">
                    <svg class="w-5 h-5 text-neon-cyan shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $property->address }}
                </p>
            </div>
            
            <div class="glass-card rounded-2xl p-6 border border-gray-800/80 grid grid-cols-2 gap-4 text-center text-sm shadow-xl">
                <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Check-in</p>
                    <p class="font-bold text-white mt-1 text-base">14:00</p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Check-out</p>
                    <p class="font-bold text-white mt-1 text-base">12:00</p>
                </div>
                <div class="col-span-2 pt-3 border-t border-gray-800/80 grid grid-cols-2 gap-2 text-xs text-neon-cyan">
                    <span class="flex items-center justify-center gap-1.5 bg-neon-cyan/5 py-1.5 px-2 rounded-lg border border-neon-cyan/10">
                        ⚡ WiFi Gratis
                    </span>
                    <span class="flex items-center justify-center gap-1.5 bg-neon-cyan/5 py-1.5 px-2 rounded-lg border border-neon-cyan/10">
                        🚗 Parkir Tersedia
                    </span>
                </div>
            </div>
        </div>
    </section>

    @php
        $hasDate = request('checkin') && request('checkout');
    @endphp

    <!-- ROOM LIST -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-extrabold text-white mb-6 flex items-center gap-2">
            Pilih Kamar
            <span class="h-1 w-10 bg-neon-gradient rounded-full"></span>
        </h2>

        <form method="GET" action=""
            class="glass-card p-6 rounded-2xl shadow-xl mb-12 grid grid-cols-1 sm:grid-cols-3 gap-6 items-end border border-gray-800">

            {{-- Date Range --}}
            <div class="sm:col-span-2">
                <label class="block mb-2 text-sm font-semibold text-gray-300">
                    Tanggal Menginap
                </label>

                <div date-rangepicker datepicker-min-date="{{ now()->format('Y-m-d') }}" datepicker-format="yyyy-mm-dd"
                    datepicker-autohide class="flex items-center gap-2">

                    <input name="checkin" type="text" value="{{ request('checkin') }}" placeholder="Check-in"
                        class="bg-gray-950/60 border border-gray-800 text-white text-sm rounded-xl
                       focus:ring-neon-cyan focus:border-neon-cyan block w-full p-3 focus:outline-none"
                        required>

                    <span class="text-gray-500">→</span>

                    <input name="checkout" type="text" value="{{ request('checkout') }}" placeholder="Check-out"
                        class="bg-gray-950/60 border border-gray-800 text-white text-sm rounded-xl
                       focus:ring-neon-cyan focus:border-neon-cyan block w-full p-3 focus:outline-none"
                        required>
                </div>
            </div>

            {{-- Button --}}
            <div>
                <button class="w-full bg-neon-gradient text-white p-3.5 rounded-xl font-bold shadow-neon hover:shadow-neon-hover disabled:opacity-40 disabled:cursor-not-allowed transition-all duration-300">
                    Cari Kamar
                </button>
            </div>

        </form>

        <div class="space-y-6">
            @foreach ($rooms as $room)
                <div
                    class="bg-gray-900/40 border border-gray-800 rounded-2xl shadow-xl hover:shadow-neon hover:border-gray-700/60 transition-all duration-300 overflow-hidden flex flex-col md:flex-row">

                    <!-- Image -->
                    <div class="relative w-full md:w-80 h-52 md:h-auto overflow-hidden">
                        <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}"
                            class="w-full h-full object-cover cursor-pointer hover:scale-105 transition-transform duration-500"
                            onclick="openRoomGallery({{ $room['id'] }})" />
                        @if ($room['is_promo'])
                            <span class="absolute top-4 left-4 bg-neon-gradient text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                PROMO KAMAR
                            </span>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start gap-4 mb-2">
                                <h3 class="text-xl font-bold text-white hover:text-neon-cyan transition duration-200">
                                    {{ $room['name'] }}
                                </h3>
                            </div>

                            <p class="text-sm text-gray-400 flex items-center gap-1">
                                <svg class="w-4 h-4 text-neon-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Kapasitas Maksimal {{ $room['capacity'] }} Tamu
                            </p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-800/80 flex justify-between items-center gap-4">
                            <div>
                                @if ($room['is_promo'])
                                    <p class="text-gray-500 line-through text-xs">
                                        Rp {{ number_format($room['base_price'], 0, ',', '.') }}
                                    </p>
                                    <p class="text-neon-cyan font-black text-2xl">
                                        Rp {{ number_format($room['final_price'], 0, ',', '.') }}
                                    </p>
                                @else
                                    <p class="text-white font-black text-2xl">
                                        Rp {{ number_format($room['final_price'], 0, ',', '.') }}
                                    </p>
                                @endif
                                <p class="text-xs text-gray-400 mt-0.5">/ malam (termasuk pajak)</p>
                            </div>

                            <a href="{{ $hasDate
                                ? route('booking.create', [
                                    'room_id' => $room['id'],
                                    'checkin' => request('checkin'),
                                    'checkout' => request('checkout'),
                                ])
                                : '#' }}"
                                class="px-6 py-3 rounded-xl font-bold transition duration-300 text-center
                               {{ $hasDate ? 'bg-neon-gradient text-white shadow-neon hover:shadow-neon-hover' : 'bg-gray-800 text-gray-500 cursor-not-allowed border border-gray-700/50' }}"
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

    {{-- modal gallery --}}
    {{-- room gallery --}}
    <div id="roomGalleryModal" class="fixed inset-0 bg-black/80 z-50 hidden" onclick="closeRoomGallery()">

        <!-- Close -->
        <button onclick="closeRoomGallery()"
            class="absolute top-4 right-4 z-50 text-white text-2xl
               bg-gray-900/80 border border-gray-800 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-800 transition">
            ✕
        </button>

        <div class="relative w-full max-w-7xl mx-auto px-4 flex items-center justify-center h-full"
            onclick="event.stopPropagation()">

            <div class="swiper w-full max-w-7xl h-[80vh] rounded-2xl overflow-hidden shadow-2xl border border-gray-800">
                <div class="swiper-wrapper" id="swiperWrapper"></div>

                <div class="swiper-button-prev text-neon-cyan"></div>
                <div class="swiper-button-next text-neon-cyan"></div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>

    <div id="propertyGalleryModal" class="fixed inset-0 bg-black/80 z-50 hidden" onclick="closePropertyGallery()">

        <!-- Close -->
        <button onclick="closePropertyGallery()"
            class="absolute top-4 right-4 z-50 text-white text-2xl
               bg-gray-900/80 border border-gray-800 rounded-full w-12 h-12 flex items-center justify-center hover:bg-gray-800 transition">
            ✕
        </button>

        <div class="relative w-full max-w-7xl mx-auto px-4 flex items-center justify-center h-full"
            onclick="event.stopPropagation()">

            <div class="swiper property-swiper w-full max-w-7xl h-[80vh] rounded-2xl overflow-hidden shadow-2xl border border-gray-800">
                <div class="swiper-wrapper" id="propertySwiperWrapper"></div>

                <div class="swiper-button-prev text-neon-cyan"></div>
                <div class="swiper-button-next text-neon-cyan"></div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>


    @push('scripts')
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
                    <div class="swiper-slide flex items-center justify-center h-full bg-[#0b0f19]/90">
                        <img src="${img}"
                            class="max-h-[75vh] max-w-full object-contain rounded-xl select-none shadow-2xl">
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
                        <div class="swiper-slide flex items-center justify-center h-full bg-[#0b0f19]/90">
                            <img src="${img}"
                                class="max-h-[75vh] max-w-full object-contain rounded-xl shadow-2xl">
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
