<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-white leading-tight">
            Booking <span class="text-neon-gradient">Saya</span>
        </h2>
    </x-slot>

    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-gray-900/40 border border-gray-800 rounded-2xl p-6 shadow-xl">
            
            {{-- DESKTOP VIEW --}}
            <div class="hidden md:block relative overflow-x-auto rounded-xl border border-gray-850 shadow-lg">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="bg-gray-950/80 border-b border-gray-850 text-gray-400 uppercase text-[10px] tracking-wider font-bold">
                        <tr>
                            <th class="px-6 py-4">Kode</th>
                            <th class="px-6 py-4">Hotel</th>
                            <th class="px-6 py-4">Kamar</th>
                            <th class="px-6 py-4">Check-in</th>
                            <th class="px-6 py-4">Check-out</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-850 bg-gray-900/10">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-900/50 transition">
                                <td class="px-6 py-4 font-mono font-bold text-white tracking-wider">
                                    {{ $booking->booking_code }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-white">
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
                                        class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border
                            {{ $booking->booking_status === 'paid' ? 'bg-neon-cyan/15 text-neon-cyan border-neon-cyan/30' : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' }}">
                                        {{ $booking->booking_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('booking.show', $booking->id) }}"
                                        class="text-neon-cyan font-bold hover:underline transition">
                                        Detail →
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-8 text-gray-500">
                                    Belum ada transaksi pemesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE VIEW --}}
            <div class="md:hidden space-y-4">
                @forelse ($bookings as $booking)
                    <div class="bg-gray-950/40 border border-gray-800 rounded-xl p-5 shadow-md flex flex-col justify-between gap-4">
                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold">Kode Booking</p>
                                <p class="font-mono font-bold text-white tracking-wider text-sm mt-0.5">
                                    {{ $booking->booking_code }}
                                </p>
                            </div>

                            <span
                                class="px-3 py-1 rounded-full text-[10px] font-bold uppercase border tracking-wider
                                {{ $booking->booking_status === 'paid' ? 'bg-neon-cyan/15 text-neon-cyan border-neon-cyan/30' : 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20' }}">
                                {{ $booking->booking_status }}
                            </span>
                        </div>

                        <div class="space-y-1.5 text-xs text-gray-300">
                            <p><span class="text-gray-500">Hotel:</span>
                                <strong class="text-white">{{ $booking->room->property->name ?? '-' }}</strong>
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
                            class="inline-block w-full text-center bg-neon-gradient text-white py-2.5 rounded-xl font-bold shadow-neon text-sm transition">
                            Lihat Detail
                        </a>
                    </div>
                @empty
                    <p class="text-center py-8 text-gray-500">
                        Belum ada transaksi pemesanan.
                    </p>
                @endforelse
            </div>

        </div>
    </section>

</x-app-layout>
