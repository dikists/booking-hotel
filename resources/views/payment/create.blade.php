<x-red-stay-layout>

    <main class="max-w-5xl mx-auto px-4 pt-28 pb-16">

        <h1 class="text-2xl font-bold mb-6">
            Pembayaran
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- LEFT -->
            <div class="md:col-span-2 space-y-4">

                <div class="bg-white rounded-xl shadow p-6">
                    <h2 class="font-semibold mb-2">Detail Booking</h2>

                    <p class="text-sm text-gray-600">
                        Kode Booking:
                        <span class="font-medium">{{ $booking->booking_code }}</span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Check-in:
                        <span class="font-medium">{{ $booking->checkin_date }}</span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Check-out:
                        <span class="font-medium">{{ $booking->checkout_date }}</span>
                    </p>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm">
                    <strong>Perhatian:</strong>
                    Booking ini akan dibatalkan otomatis jika tidak dibayar
                    sebelum waktu habis.
                </div>

            </div>

            <!-- RIGHT -->
            <div class="bg-white rounded-xl shadow p-6 h-fit">

                <h3 class="font-semibold mb-4">Total Pembayaran</h3>

                <p class="text-2xl font-bold text-red-600 mb-4">
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </p>

                <div class="text-sm text-gray-600 mb-4">
                    Sisa waktu pembayaran:
                    <span id="countdown" class="font-semibold text-red-600">
                        --
                    </span>
                </div>

                <!-- BUTTON DUMMY -->
                <button id="payBtn" class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition">
                    Bayar Sekarang
                </button>


            </div>

        </div>

    </main>

    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script>
            let remaining = {{ $remainingSeconds }};

            const countdownEl = document.getElementById('countdown');

            const timer = setInterval(() => {
                if (remaining <= 0) {
                    clearInterval(timer);
                    location.reload();
                    return;
                }
                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;
                countdownEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0' )}`;
                remaining--;
            }, 1000);
            

            document.getElementById('payBtn').addEventListener('click', function() {
                fetch('{{ route('payment.pay', $booking->id) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        window.snap.pay(data.snap_token);
                    });
            });
        </script>
    @endpush

</x-red-stay-layout>
