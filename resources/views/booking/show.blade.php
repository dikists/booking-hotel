<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-white leading-tight">
            Detail <span class="text-neon-gradient">Booking</span>
        </h2>
    </x-slot>

    <section class="max-w-5xl mx-auto px-4 py-10 space-y-6">

        {{-- STATUS & CODE --}}
        <div class="bg-gray-900/60 border border-gray-800 backdrop-blur-md rounded-2xl p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-xl">
            <div>
                <p class="text-sm text-gray-500 font-medium">Kode Booking</p>
                <p class="text-xl font-mono font-bold text-white tracking-wider mt-1">
                    {{ $booking->booking_code }}
                </p>
            </div>

            <span
                class="px-4 py-2 rounded-full text-xs font-bold border uppercase tracking-wider
                {{ $booking->booking_status === 'paid' ? 'bg-neon-cyan/15 text-neon-cyan border-neon-cyan/30 shadow-[0_0_10px_rgba(0,242,254,0.15)]' : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' }}">
                {{ $booking->booking_status }}
            </span>
        </div>

        {{-- E-VOUCHER (IF PAID) --}}
        @if ($booking->booking_status === 'paid')
            <div class="bg-gray-950/60 border border-gray-800 rounded-2xl p-6 shadow-xl relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-neon-gradient opacity-10 rounded-full blur-2xl"></div>
                
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    E-Voucher Check-in
                    <span class="h-1 w-8 bg-neon-gradient rounded-full"></span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div class="md:col-span-2 space-y-3.5 text-sm">
                        <p class="text-gray-400 leading-relaxed">
                            Voucher ini adalah bukti konfirmasi pembayaran sah Anda. Silakan tunjukkan QR Code di samping kepada petugas hotel saat tiba di properti.
                        </p>
                        <div class="bg-gray-900/80 border border-gray-800 rounded-xl p-4 grid grid-cols-2 gap-4 text-xs">
                            <div>
                                <span class="text-gray-500 block">Hotel</span>
                                <span class="font-bold text-white text-sm mt-0.5 block">{{ $booking->room->property->name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 block">Tipe Kamar</span>
                                <span class="font-bold text-white text-sm mt-0.5 block">{{ $booking->room->room_name }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-center p-4 bg-gray-900/40 rounded-xl border border-gray-800/80">
                        <div class="p-2 bg-white rounded-lg inline-block shadow-lg mb-2">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode($booking->booking_code) }}" 
                                alt="QR Code Voucher" class="w-24 h-24 object-contain">
                        </div>
                        <span class="text-[10px] text-gray-500">Pindai QR saat Check-in</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- DESKTOP VIEW --}}
        <div class="hidden md:block bg-gray-900/40 border border-gray-800 rounded-2xl overflow-hidden shadow-xl">
            <table class="w-full text-sm text-left">
                <tbody class="divide-y divide-gray-800/60">
                    <tr>
                        <th class="px-6 py-4 text-gray-500 w-1/3 font-semibold">Hotel</th>
                        <td class="px-6 py-4 font-bold text-white">
                            {{ $booking->room->property->name ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500 font-semibold">Kamar</th>
                        <td class="px-6 py-4 font-semibold text-gray-300">
                            {{ $booking->room->room_name }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500 font-semibold">Check-in</th>
                        <td class="px-6 py-4 text-gray-300">
                            {{ \Carbon\Carbon::parse($booking->checkin_date)->translatedFormat('d F Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500 font-semibold">Check-out</th>
                        <td class="px-6 py-4 text-gray-300">
                            {{ \Carbon\Carbon::parse($booking->checkout_date)->translatedFormat('d F Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500 font-semibold">Total Malam</th>
                        <td class="px-6 py-4 text-gray-300">
                            {{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }}
                            malam
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500 font-semibold">Total Bayar</th>
                        <td class="px-6 py-4 font-bold text-neon-cyan text-lg">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- MOBILE VIEW --}}
        <div class="md:hidden bg-gray-900/40 border border-gray-800 rounded-2xl p-6 space-y-4 text-sm shadow-xl">
            <div>
                <p class="text-gray-500 font-medium">Hotel</p>
                <p class="font-bold text-white text-base mt-0.5">
                    {{ $booking->room->property->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500 font-medium">Kamar</p>
                <p class="font-semibold text-gray-300 mt-0.5">
                    {{ $booking->room->room_name }}
                </p>
            </div>

            <div class="flex justify-between border-t border-gray-800/60 pt-3">
                <div>
                    <p class="text-gray-500 font-medium">Check-in</p>
                    <p class="text-gray-300 font-semibold mt-0.5">{{ \Carbon\Carbon::parse($booking->checkin_date)->translatedFormat('d F Y') }}</p>
                </div>

                <div class="text-right">
                    <p class="text-gray-500 font-medium">Check-out</p>
                    <p class="text-gray-300 font-semibold mt-0.5">{{ \Carbon\Carbon::parse($booking->checkout_date)->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            <div class="flex justify-between border-t border-gray-800/60 pt-3">
                <div>
                    <p class="text-gray-500 font-medium">Total Malam</p>
                    <p class="text-gray-300 font-semibold mt-0.5">{{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }} malam</p>
                </div>

                <div class="text-right">
                    <p class="text-gray-500 font-medium">Total Bayar</p>
                    <p class="font-bold text-neon-cyan text-lg mt-0.5">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <a href="{{ route('booking.index') }}"
                class="inline-flex justify-center items-center px-6 py-3 rounded-xl border border-gray-800 text-gray-300 hover:bg-gray-850 hover:text-white transition font-bold text-sm">
                Kembali ke Booking Saya
            </a>

            @if ($booking->booking_status !== 'paid')
                <a href="{{ route('payment.create', $booking->id) }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-xl bg-neon-gradient text-white font-bold shadow-neon hover:shadow-neon-hover transition text-sm">
                    Lanjutkan Pembayaran
                </a>
            @endif

            @if ($booking->booking_status === 'paid')
                <a href="{{ route('booking.invoice', $booking->id) }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-xl border border-neon-cyan/40 text-neon-cyan hover:bg-neon-cyan/5 transition font-bold text-sm">
                    Download Invoice (PDF)
                </a>
            @endif

        </div>

    </section>
</x-app-layout>
