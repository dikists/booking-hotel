<x-red-stay-layout>

    <main class="max-w-5xl mx-auto px-4 pt-28 pb-16">

        <h1 class="text-3xl font-extrabold text-white tracking-tight mb-8">
            Penyelesaian <span class="text-neon-gradient">Pembayaran</span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="md:col-span-2 space-y-6">

                <div class="bg-gray-900/40 border border-gray-800 rounded-2xl p-6 shadow-xl">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        Detail Reservasi
                        <span class="h-1 w-8 bg-neon-gradient rounded-full"></span>
                    </h2>

                    <div class="space-y-3.5 text-sm">
                        <div class="flex justify-between border-b border-gray-800/60 pb-3">
                            <span class="text-gray-400">Kode Booking</span>
                            <span class="font-mono text-neon-cyan font-bold text-base">{{ $booking->booking_code }}</span>
                        </div>

                        <div class="flex justify-between border-b border-gray-800/60 pb-3">
                            <span class="text-gray-400">Properti</span>
                            <span class="font-semibold text-white text-right">{{ $booking->room->property->name ?? '-' }}</span>
                        </div>

                        <div class="flex justify-between border-b border-gray-800/60 pb-3">
                            <span class="text-gray-400">Tipe Kamar</span>
                            <span class="font-semibold text-white text-right">{{ $booking->room->room_name }}</span>
                        </div>

                        <div class="flex justify-between border-b border-gray-800/60 pb-3">
                            <span class="text-gray-400">Tanggal Check-in</span>
                            <span class="font-semibold text-white">{{ $booking->checkin_date }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-400">Tanggal Check-out</span>
                            <span class="font-semibold text-white">{{ $booking->checkout_date }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-2xl p-5 text-sm text-yellow-400/90 leading-relaxed">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <strong class="text-yellow-400 font-bold block mb-1">Peringatan Penting:</strong>
                            Booking ini dilindungi oleh sistem pengunci inventaris otomatis. Selesaikan pembayaran sebelum batas waktu countdown habis untuk mencegah pembatalan otomatis dan pelepasan kamar ke pengguna lain.
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="bg-gray-900/60 border border-gray-800 backdrop-blur-md rounded-2xl p-6 h-fit shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#00F2FE]/5 rounded-full blur-xl"></div>
                
                <h3 class="text-lg font-bold text-gray-400 mb-2">Total Pembayaran</h3>

                <p class="text-neon-gradient text-4xl font-black mb-6">
                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                </p>

                <div class="bg-neon-cyan/5 border border-neon-cyan/20 rounded-xl p-4 mb-6 flex justify-between items-center text-sm">
                    <span class="text-gray-400">Sisa Waktu Bayar:</span>
                    <span id="countdown" class="font-mono font-bold text-lg text-neon-cyan drop-shadow-[0_0_5px_rgba(0,242,254,0.3)]">
                        --
                    </span>
                </div>

                <!-- BUTTON PAY -->
                <button id="payBtn" class="w-full bg-neon-gradient text-white py-4 rounded-xl font-bold shadow-neon hover:shadow-neon-hover transition-all duration-300">
                    Bayar Sekarang
                </button>

                <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Terverifikasi aman & enkripsi SSL
                </div>

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
