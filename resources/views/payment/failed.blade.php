<x-red-stay-layout>
    <section class="min-h-screen flex items-center justify-center bg-[#0b0f19] px-4 py-12">
        <div class="bg-gray-900/60 border border-gray-800 backdrop-blur-md rounded-2xl shadow-2xl p-8 max-w-md w-full relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-full blur-xl"></div>

            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 rounded-xl border border-red-500/20 bg-red-500/5 flex items-center justify-center shadow-lg shadow-red-500/10">
                    <svg class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-center text-white mb-2">
                Pembayaran Gagal ❌
            </h1>

            <p class="text-gray-400 text-center text-sm mb-6 leading-relaxed">
                Pembayaran Anda belum berhasil diverifikasi atau dibatalkan oleh pihak bank. Silakan coba kembali.
            </p>

            <!-- Booking Info -->
            <div class="bg-gray-950/80 border border-gray-800 rounded-xl p-5 mb-6 text-sm">
                <div class="flex justify-between border-b border-gray-800/50 pb-2.5 mb-2.5">
                    <span class="text-gray-500">Kode Booking</span>
                    <span class="font-mono font-bold text-white tracking-wider">{{ $booking->booking_code }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status Transaksi</span>
                    <span class="text-red-400 font-extrabold uppercase">
                        {{ strtoupper($booking->booking_status) }}
                    </span>
                </div>
            </div>

            <!-- Action -->
            <div class="space-y-3">
                <a href="{{ route('payment.create', $booking->id) }}"
                    class="block w-full bg-neon-gradient text-white py-3.5 rounded-xl font-bold shadow-neon hover:shadow-neon-hover text-center transition-all duration-300 text-sm">
                    Coba Bayar Lagi
                </a>

                <a href="/"
                    class="block w-full border border-gray-800 text-gray-400 py-3.5 rounded-xl font-semibold hover:bg-gray-800 hover:text-white text-center transition duration-200 text-sm">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>
</x-red-stay-layout>
