<x-red-stay-layout>

    <main class="max-w-7xl mx-auto px-4 pt-28 pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT: Booking Detail -->
            <div class="lg:col-span-2 space-y-6">

                <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">
                    Konfirmasi <span class="text-neon-gradient">Booking</span>
                </h1>
                <p class="text-gray-400 text-sm">Harap tinjau detail pemesanan Anda sebelum melanjutkan ke pembayaran</p>

                <!-- Room Info -->
                <div class="bg-gray-900/40 border border-gray-800 rounded-2xl p-6 flex flex-col sm:flex-row gap-6 shadow-xl">
                    <img src="{{ $room->thumbnail }}" class="w-full sm:w-44 h-32 object-cover rounded-xl border border-gray-800"
                        alt="{{ $room->room_name }}">

                    <div class="flex flex-col justify-center">
                        <span class="text-xs font-semibold px-2.5 py-1 bg-neon-cyan/15 text-neon-cyan rounded-full border border-neon-cyan/30 w-fit mb-2">
                            Pilihan Terstandardisasi
                        </span>
                        <h2 class="text-xl font-bold text-white mb-1">
                            {{ $room->room_name }}
                        </h2>
                        <p class="text-gray-400 text-sm mb-2 font-medium">
                            {{ $room->property->name }}
                        </p>
                        <p class="text-gray-500 text-xs flex items-center gap-1">
                            <svg class="w-4 h-4 text-neon-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Kapasitas Maksimal {{ $room->capacity }} Tamu
                        </p>
                    </div>
                </div>

                <!-- Date Info -->
                <div class="bg-gray-900/40 border border-gray-800 rounded-2xl p-6 shadow-xl">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm">
                        <div>
                            <p class="text-gray-500 font-medium">Check-in</p>
                            <p class="font-bold text-white text-base mt-1">{{ $checkin }}</p>
                            <p class="text-gray-500 text-xs mt-0.5">Dari Jam 14:00</p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-medium">Check-out</p>
                            <p class="font-bold text-white text-base mt-1">{{ $checkout }}</p>
                            <p class="text-gray-500 text-xs mt-0.5">Sebelum Jam 12:00</p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-medium">Durasi</p>
                            <p class="font-bold text-neon-cyan text-base mt-1">
                                {{ $totalNight }} Malam
                            </p>
                            <p class="text-gray-500 text-xs mt-0.5">Masa Menginap</p>
                        </div>

                        <div>
                            <p class="text-gray-500 font-medium">Harga / Malam</p>
                            <p class="font-bold text-white text-base mt-1">
                                Rp {{ number_format($pricePerNight, 0, ',', '.') }}
                            </p>
                            <p class="text-gray-500 text-xs mt-0.5">Tarif Dasar Kamar</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Price Summary -->
            <div class="bg-gray-900/60 border border-gray-800 backdrop-blur-md rounded-2xl p-6 h-fit shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-neon-cyan/5 rounded-full blur-xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-electric-purple/5 rounded-full blur-xl"></div>

                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    Ringkasan Harga
                    <span class="h-1 w-8 bg-neon-gradient rounded-full"></span>
                </h3>

                <div class="space-y-4 text-sm z-10 relative">
                    <div class="flex justify-between text-gray-300">
                        <span>
                            {{ $totalNight }} Malam x
                            Rp {{ number_format($pricePerNight, 0, ',', '.') }}
                        </span>
                        <span class="font-medium text-white">
                            Rp {{ number_format($totalPrice, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between text-gray-400 text-xs pb-4 border-b border-gray-800/80">
                        <span>Biaya Layanan & Pajak</span>
                        <span class="text-neon-cyan">Termasuk (Rp 0)</span>
                    </div>

                    <div class="flex justify-between items-end font-bold text-lg pt-2">
                        <span class="text-gray-300 text-base">Total Pembayaran</span>
                        <div class="text-right">
                             <span class="text-neon-gradient font-black text-2xl">
                                Rp {{ number_format($totalPrice, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- NEXT STEP BUTTON (BELUM SUBMIT) -->
                <form method="POST" action="{{ route('booking.store') }}" class="mt-8 z-10 relative">
                    @csrf

                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="checkin" value="{{ $checkin }}">
                    <input type="hidden" name="checkout" value="{{ $checkout }}">

                    <button class="w-full bg-neon-gradient text-white py-3.5 rounded-xl font-bold shadow-neon hover:shadow-neon-hover transition-all duration-300">
                        Lanjutkan ke Pembayaran
                    </button>
                </form>

                <p class="text-center text-xs text-gray-500 mt-4 leading-relaxed">
                    Dengan mengeklik tombol di atas, Anda menyetujui Ketentuan Penggunaan dan Kebijakan Privasi RedStay.
                </p>

            </div>

        </div>
    </main>

</x-red-stay-layout>
