<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Saya
        </h2>
    </x-slot>

    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="hidden md:block lg:block relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-lg border border-default">
                <table class="w-full text-sm text-left text-body">
                    <thead class="bg-neutral-secondary-soft border-b">
                        <tr>
                            <th class="px-6 py-3 font-medium">Kode</th>
                            <th class="px-6 py-3 font-medium">Hotel</th>
                            <th class="px-6 py-3 font-medium">Kamar</th>
                            <th class="px-6 py-3 font-medium">Check-in</th>
                            <th class="px-6 py-3 font-medium">Check-out</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="">
                                <td class="px-6 py-4 font-medium">
                                    {{ $booking->booking_code }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->room->property->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->room->room_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ date('d F Y', strtotime($booking->checkin_date)) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ date('d F Y', strtotime($booking->checkout_date)) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs
                            {{ $booking->booking_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($booking->booking_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('booking.show', $booking->id) }}"
                                        class="text-red-600 hover:underline">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="md:hidden space-y-2">
                @foreach ($bookings as $booking)
                    <div class="border rounded-xl p-4 shadow-sm">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500">Kode Booking</p>
                                <p class="font-semibold">
                                    {{ $booking->booking_code }}
                                </p>
                            </div>

                            <span
                                class="px-3 py-1 rounded-full text-xs
                    {{ $booking->booking_status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($booking->booking_status) }}
                            </span>
                        </div>

                        <div class="mt-3 space-y-1 text-sm">
                            <p><span class="text-gray-500">Hotel:</span>
                                {{ $booking->room->property->name ?? '-' }}
                            </p>
                            <p><span class="text-gray-500">Kamar:</span>
                                {{ $booking->room->room_name }}
                            </p>
                            <p><span class="text-gray-500">Check-in:</span>
                                {{ date('d F Y', strtotime($booking->checkin_date)) }}
                            </p>
                            <p><span class="text-gray-500">Check-out:</span>
                                {{ date('d F Y', strtotime($booking->checkout_date)) }}
                            </p>
                        </div>

                        <a href="{{ route('booking.show', $booking->id) }}"
                            class="mt-4 inline-block w-full text-center bg-red-600 text-white py-2 rounded-lg">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>


        </div>

    </section>


</x-app-layout>
