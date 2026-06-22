<x-red-stay-layout>

@php
    $status = $booking->booking_status;

    $statusMap = [
        'paid' => [
            'title' => 'Pembayaran Berhasil 🎉',
            'message' => 'Terima kasih — pembayaran Anda telah dikonfirmasi. E-Voucher Anda telah diterbitkan secara otomatis.',
            'bg' => 'bg-neon-cyan/10 border-neon-cyan/30',
            'text' => 'text-neon-cyan',
            'icon' => 'check',
        ],
        'pending' => [
            'title' => 'Pembayaran Diproses',
            'message' => 'Kami sedang memproses pembayaran Anda. Silakan cek kembali nanti atau hubungi layanan pelanggan jika tertunda.',
            'bg' => 'bg-yellow-500/10 border-yellow-500/20',
            'text' => 'text-yellow-400',
            'icon' => 'clock',
        ],
        'failed' => [
            'title' => 'Pembayaran Gagal',
            'message' => 'Pembayaran tidak berhasil. Silakan ulangi atau hubungi layanan pelanggan.',
            'bg' => 'bg-red-500/10 border-red-500/20',
            'text' => 'text-red-400',
            'icon' => 'x',
        ],
    ];

    $current = $statusMap[$status] ?? $statusMap['pending'];
@endphp

<div class="max-w-xl mx-auto mt-28 p-8 bg-gray-900/60 border border-gray-800 backdrop-blur-md rounded-2xl shadow-2xl relative overflow-hidden"
    aria-live="polite"
>
    <div class="absolute top-0 right-0 w-24 h-24 bg-neon-cyan/5 rounded-full blur-xl"></div>

    {{-- STATUS HEADER --}}
    <div class="flex items-start gap-4 pb-6 border-b border-gray-800/80">
        <div class="p-3.5 rounded-xl border {{ $current['bg'] }} flex items-center justify-center shrink-0">
            @if($current['icon'] === 'check')
                <svg class="w-6 h-6 {{ $current['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            @elseif($current['icon'] === 'clock')
                <svg class="w-6 h-6 {{ $current['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            @else
                <svg class="w-6 h-6 {{ $current['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            @endif
        </div>

        <div>
            <h2 class="text-xl font-bold text-white">
                {{ $current['title'] }}
            </h2>
            <p class="mt-1 text-sm text-gray-400 leading-relaxed">
                {{ $current['message'] }}
            </p>
        </div>
    </div>

    {{-- E-VOUCHER CARD (ONLY ON SUCCESS/PAID) --}}
    @if ($status === 'paid')
        <div class="mt-6 p-6 bg-gray-950/80 border border-gray-800 rounded-xl relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-28 h-28 bg-neon-gradient opacity-10 rounded-full blur-2xl"></div>

            <div class="flex justify-between items-center mb-6">
                <div>
                    <span class="text-[10px] tracking-widest text-neon-cyan uppercase font-bold">Official E-Voucher</span>
                    <h3 class="text-lg font-bold text-white mt-0.5">RedStay Booking</h3>
                </div>
                <span class="font-mono text-xs text-gray-400 bg-gray-900 border border-gray-800 px-2.5 py-1 rounded">VOUCHER</span>
            </div>

            <!-- QR Code -->
            <div class="flex flex-col items-center justify-center p-4 bg-gray-900/60 rounded-xl border border-gray-800/80 mb-6">
                <div class="p-2 bg-white rounded-lg inline-block shadow-lg mb-2">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data={{ urlencode($booking->booking_code) }}" 
                        alt="QR Code Voucher" class="w-28 h-28 object-contain">
                </div>
                <span class="text-xs text-gray-400">Pindai QR ini saat check-in di properti</span>
            </div>

            <div class="space-y-3.5 text-xs">
                <div class="flex justify-between border-b border-gray-800/60 pb-2.5">
                    <span class="text-gray-500">Kode Booking</span>
                    <span class="font-mono font-bold text-white tracking-wider text-sm">{{ $booking->booking_code }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-800/60 pb-2.5">
                    <span class="text-gray-500">Hotel</span>
                    <span class="font-semibold text-white text-right">{{ $booking->room->property->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-800/60 pb-2.5">
                    <span class="text-gray-500">Kamar</span>
                    <span class="font-semibold text-white text-right">{{ $booking->room->room_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Masa Inap</span>
                    <span class="font-semibold text-neon-cyan">{{ $booking->checkin_date }} s/d {{ $booking->checkout_date }}</span>
                </div>
            </div>
        </div>
    @endif

    {{-- ACTIONS --}}
    <div class="mt-8 flex flex-col sm:flex-row gap-3">
        <a
            href="{{ route('booking.show', $booking->id) }}"
            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3
                   bg-neon-gradient text-white font-bold rounded-xl shadow-neon hover:shadow-neon-hover transition-all duration-300 text-sm"
        >
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
            </svg>
            Lihat Detail Booking
        </a>

        <a
            href="{{ url('/') }}"
            class="flex-1 inline-flex items-center justify-center px-4 py-3
                   border border-gray-800 rounded-xl
                   text-gray-300 font-semibold text-sm
                   hover:bg-gray-800 hover:text-white transition duration-200"
        >
            Kembali ke Beranda
        </a>
    </div>

    {{-- FOOTNOTE --}}
    <p class="mt-6 text-center text-xs text-gray-500 leading-relaxed">
        Jika ada pertanyaan atau memerlukan bantuan mendesak, silakan hubungi layanan pelanggan di support@redstay.com.
    </p>
</div>

</x-red-stay-layout>
