<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                {{-- Flash message --}}
                @if (session('success'))
                    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Table --}}
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3">Kode Booking</th>
                                <th class="px-4 py-3">Hotel</th>
                                <th class="px-4 py-3">Kamar</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Check-in</th>
                                <th class="px-4 py-3">CHeck-out</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr class="bg-white border-b">
                                    <td class="p-2 font-medium text-gray-900">
                                        {{ $booking->booking_code }}
                                    </td>
                                    <td class="p-2">
                                        {{ $booking->room->property->name }}
                                    </td>
                                    <td class="p-2">
                                        {{ $booking->room->room_name }}
                                    </td>
                                    <td class="p-2">
                                        {{ $booking->user->name }}
                                    </td>
                                    <td class="p-2">
                                        {{ $booking->checkin_date }}
                                    </td>
                                    <td class="p-2">
                                        {{ $booking->checkout_date }}
                                    </td>
                                    <td class="p-2">
                                        @if ($booking->booking_status === 'paid')
                                            <span class="px-2 py-1 rounded text-xs badge">Belum Check-in</span>
                                        @endif

                                        @if ($booking->booking_status === 'checkin')
                                            <span class="px-2 py-1 rounded text-xs badge bg-green">Sedang
                                                Menginap</span>
                                        @endif

                                        @if ($booking->booking_status === 'checkout')
                                            <span class="px-2 py-1 rounded text-xs badge bg-gray">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="p-2 space-x-2">
                                        @if ($booking->booking_status === 'paid')
                                            {{-- Override Check-in --}}
                                            <form action="{{ route('partner.booking.checkin', $booking->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Override check-in booking ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button class="text-xs bg-green-600 text-white px-2 py-1 rounded">
                                                    Check-in
                                                </button>
                                            </form>
                                        @endif

                                        @if ($booking->booking_status === 'checkin')
                                            {{-- Override Check-out --}}
                                            <form action="{{ route('partner.booking.checkout', $booking->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Override check-out booking ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button class="text-xs bg-gray-600 text-white px-2 py-1 rounded">
                                                    Check-out
                                                </button>
                                            </form>
                                        @endif

                                        @if ($booking->booking_status === 'checkout')
                                            <span class="px-2 py-1 rounded text-xs bg-gray-200 text-gray-700">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-4 text-gray-500">
                                        Belum ada booking
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
