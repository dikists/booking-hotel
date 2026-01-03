<x-red-stay-layout>
    <section class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full text-center">

            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-red-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Pembayaran Gagal ❌
            </h1>

            <p class="text-gray-600 mb-6">
                Pembayaran kamu belum berhasil atau dibatalkan.
            </p>

            <!-- Booking Info -->
            <div class="bg-gray-100 rounded-lg p-4 text-left mb-6 text-sm">
                <p><strong>Kode Booking:</strong> {{ $booking->booking_code }}</p>
                <p><strong>Status:</strong>
                    <span class="text-red-600 font-semibold">
                        {{ strtoupper($booking->booking_status) }}
                    </span>
                </p>
            </div>

            <!-- Action -->
            <div class="space-y-3">
                <a href="{{ route('payment.create', $booking->id) }}"
                    class="block w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 font-medium">
                    Coba Bayar Lagi
                </a>

                <a href="/"
                    class="block w-full border border-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-100">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>
</x-red-stay-layout>
