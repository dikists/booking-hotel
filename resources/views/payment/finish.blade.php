<x-red-stay-layout>

@dd($booking)
@php
    $status = $booking->booking_status;

    $statusMap = [
        'paid' => [
            'title' => 'Pembayaran Berhasil 🎉',
            'message' => 'Terima kasih — pembayaran Anda telah dikonfirmasi. Kami menunggu Anda di properti sesuai jadwal.',
            'bg' => 'bg-green-50 dark:bg-green-900/20',
            'text' => 'text-green-600',
            'icon' => 'check',
        ],
        'pending' => [
            'title' => 'Pembayaran Diproses',
            'message' => 'Kami sedang memproses pembayaran Anda. Silakan cek kembali nanti atau hubungi layanan pelanggan jika tertunda.',
            'bg' => 'bg-yellow-50 dark:bg-yellow-900/20',
            'text' => 'text-dark-600',
            'icon' => 'clock',
        ],
        'failed' => [
            'title' => 'Pembayaran Gagal',
            'message' => 'Pembayaran tidak berhasil. Silakan ulangi atau hubungi layanan pelanggan.',
            'bg' => 'bg-red-50 dark:bg-red-900/20',
            'text' => 'text-red-600',
            'icon' => 'x',
        ],
    ];

    $current = $statusMap[$status] ?? $statusMap['pending'];
@endphp

<div class="max-w-xl mx-auto mt-28 p-6 bg-white rounded-xl shadow-lg ring-1 ring-gray-200 dark:ring-gray-700"
    aria-live="polite"
>
    {{-- STATUS --}}
    <div class="flex items-start gap-4">
        <div class="p-3 rounded-full {{ $current['bg'] }}">
            @if($current['icon'] === 'check')
                <svg class="w-6 h-6 {{ $current['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            @elseif($current['icon'] === 'clock')
                <svg class="w-6 h-6 {{ $current['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                    <circle cx="12" cy="12" r="9"/>
                </svg>
            @else
                <svg class="w-6 h-6 {{ $current['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            @endif
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-900">
                {{ $current['title'] }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ $current['message'] }}
            </p>
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="mt-6 flex flex-col sm:flex-row gap-3">
        <a
            href="{{ route('booking.show', $booking->id) }}"
            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2
                   bg-red-600 text-white font-semibold rounded-md shadow
                   hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
            </svg>
            Lihat Detail Booking
        </a>

        <a
            href="{{ url('/') }}"
            class="flex-1 inline-flex items-center justify-center px-4 py-2
                   border border-gray-300 dark:border-gray-600 rounded-md
                   text-gray-700
                   hover:bg-gray-50 dark:hover:bg-gray-700"
        >
            Kembali ke Beranda
        </a>
    </div>

    {{-- FOOTNOTE --}}
    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
        Jika ada pertanyaan, silakan hubungi layanan pelanggan atau cek email konfirmasi Anda.
    </p>
</div>

</x-red-stay-layout>
