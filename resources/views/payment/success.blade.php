<x-red-stay-layout>
    <section class="min-h-screen flex items-center justify-center bg-[#0b0f19] px-4 py-12">
        <div class="bg-gray-900/60 border border-gray-800 backdrop-blur-md rounded-2xl shadow-2xl p-8 max-w-md w-full relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-neon-cyan/5 rounded-full blur-xl"></div>

            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 rounded-xl border border-neon-cyan/20 bg-neon-cyan/5 flex items-center justify-center shadow-neon">
                    <svg class="w-8 h-8 text-neon-cyan" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-center text-white mb-2">
                Pembayaran Berhasil 🎉
            </h1>

            <p class="text-gray-400 text-center text-sm mb-6 leading-relaxed">
                Terima kasih — pembayaran Anda telah dikonfirmasi. E-Voucher Anda telah diterbitkan secara otomatis.
            </p>

            <!-- E-Voucher Box -->
            <div class="bg-gray-950/80 border border-gray-800 rounded-xl p-5 mb-6 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-neon-gradient opacity-10 rounded-full blur-xl"></div>
                
                <div class="flex justify-between items-center mb-4">
                    <span class="text-[10px] tracking-widest text-neon-cyan uppercase font-bold">Official E-Voucher</span>
                    <span class="font-mono text-[10px] text-gray-500 bg-gray-900 border border-gray-800 px-2 py-0.5 rounded">VOUCHER</span>
                </div>

                <!-- QR Code -->
                <div class="flex flex-col items-center justify-center p-3 bg-gray-900/60 rounded-xl border border-gray-800/80 mb-4">
                    <div class="p-2 bg-white rounded-lg inline-block shadow-lg mb-2">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode($booking->booking_code) }}" 
                            alt="QR Code Voucher" class="w-24 h-24 object-contain">
                    </div>
                    <span class="text-[10px] text-gray-500">Pindai QR saat check-in</span>
                </div>

                <div class="space-y-2.5 text-xs">
                    <div class="flex justify-between border-b border-gray-800/50 pb-2">
                        <span class="text-gray-500">Kode Booking</span>
                        <span class="font-mono font-bold text-white tracking-wider">{{ $booking->booking_code }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-800/50 pb-2">
                        <span class="text-gray-500">Hotel</span>
                        <span class="font-semibold text-white text-right">{{ $booking->property->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-800/50 pb-2">
                        <span class="text-gray-500">Tanggal</span>
                        <span class="font-semibold text-white text-right">
                            {{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($booking->checkout_date)->format('d M Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Pembayaran</span>
                        <span class="font-bold text-neon-cyan">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action -->
            <div class="space-y-3">
                <a href="{{ route('booking.show', $booking->id) }}"
                    class="block w-full bg-neon-gradient text-white py-3.5 rounded-xl font-bold shadow-neon hover:shadow-neon-hover text-center transition-all duration-300 text-sm">
                    Lihat Detail Booking
                </a>

                <a href="/"
                    class="block w-full border border-gray-800 text-gray-400 py-3.5 rounded-xl font-semibold hover:bg-gray-800 hover:text-white text-center transition duration-200 text-sm">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>
</x-red-stay-layout>
