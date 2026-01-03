<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Booking
        </h2>
    </x-slot>

    <section class="max-w-5xl mx-auto px-4 py-10 space-y-6">

        {{-- STATUS & CODE --}}
        <div class="bg-white rounded-xl shadow p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-500">Kode Booking</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $booking->booking_code }}
                </p>
            </div>

            <span
                class="px-4 py-2 rounded-full text-sm font-medium
                {{ $booking->booking_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($booking->booking_status) }}
            </span>
        </div>

        {{-- DESKTOP VIEW --}}
        <div class="hidden md:block bg-white rounded-xl shadow overflow-hidden">
            <table class="w-full text-sm text-left">
                <tbody class="divide-y">
                    <tr>
                        <th class="px-6 py-4 text-gray-500 w-1/3">Hotel</th>
                        <td class="px-6 py-4 font-medium">
                            {{ $booking->room->property->name ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500">Kamar</th>
                        <td class="px-6 py-4 font-medium">
                            {{ $booking->room->room_name }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500">Check-in</th>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($booking->checkin_date)->translatedFormat('d F Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500">Check-out</th>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($booking->checkout_date)->translatedFormat('d F Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500">Total Malam</th>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }}
                            malam
                        </td>
                    </tr>

                    <tr>
                        <th class="px-6 py-4 text-gray-500">Total Bayar</th>
                        <td class="px-6 py-4 font-semibold text-red-600">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- MOBILE VIEW --}}
        <div class="md:hidden bg-white rounded-xl shadow p-6 space-y-3 text-sm">
            <div>
                <p class="text-gray-500">Hotel</p>
                <p class="font-medium">
                    {{ $booking->room->property->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Kamar</p>
                <p class="font-medium">
                    {{ $booking->room->room_name }}
                </p>
            </div>

            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Check-in</p>
                    <p>{{ \Carbon\Carbon::parse($booking->checkin_date)->translatedFormat('d F Y') }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Check-out</p>
                    <p>{{ \Carbon\Carbon::parse($booking->checkout_date)->translatedFormat('d F Y') }}</p>
                </div>
            </div>

            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Total Malam</p>
                    <p>{{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }} malam
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-gray-500">Total Bayar</p>
                    <p class="font-semibold text-red-600">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- ACTION --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('booking.index') }}"
                class="inline-flex justify-center items-center px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                Kembali ke Booking
            </a>

            @if ($booking->booking_status !== 'paid')
                <a href="{{ route('payment.create', $booking->id) }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Lanjutkan Pembayaran
                </a>
            @endif

            @if ($booking->booking_status === 'paid')
                <a href="{{ route('booking.invoice', $booking->id) }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-lg border border-red-600 text-red-600 hover:bg-red-50">
                    Download Invoice
                </a>
            @endif

        </div>

    </section>
</x-app-layout>
