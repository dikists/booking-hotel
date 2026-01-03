<x-red-stay-layout>
    <section class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-md w-full text-center">

            <!-- Icon -->
            <div class="flex justify-center mb-4">
                <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Pembayaran Berhasil 🎉
            </h1>

            <p class="text-gray-600 mb-6">
                Booking kamu telah berhasil dikonfirmasi.
            </p>

            <!-- Booking Info -->
            <div class="bg-gray-100 rounded-lg p-4 text-left mb-6 text-sm">
                <p><strong>Kode Booking:</strong> {{ $booking->booking_code }}</p>
                <p><strong>Hotel:</strong> {{ $booking->property->name ?? '-' }}</p>
                <p><strong>Tanggal:</strong>
                    {{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($booking->checkout_date)->format('d M Y') }}
                </p>
                <p><strong>Total:</strong>
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </p>
            </div>

            <!-- Action -->
            <div class="space-y-3">
                <a href="{{ route('booking.show', $booking->id) }}"
                    class="block w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 font-medium">
                    Lihat Detail Booking
                </a>

                <a href="/"
                    class="block w-full border border-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-100">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </section>
</x-red-stay-layout>
