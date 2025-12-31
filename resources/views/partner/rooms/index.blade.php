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

                {{-- Button tambah --}}
                <h1 class="text-xl font-semibold mb-4">
                    Rooms – {{ $property->name }}
                </h1>

                <a href="{{ route('partner.hotels.rooms.create', $property->id) }}"
                    class="bg-red-600 text-white px-4 py-2 rounded mb-4 inline-block">
                    + Tambah Room
                </a>
                {{-- Table --}}
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="bg-gray-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 w-24">Foto</th>
                            <th class="px-4 py-3">Nama Room</th>
                            <th class="px-4 py-3">Kapasitas</th>
                            <th class="px-4 py-3">Harga Dasar</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr class="bg-white border-b">
                                <td class="px-4 py-3">
                                    @php
                                        $thumb = $room->primaryImage?->image ?? $room->galleries->first()?->image;
                                    @endphp

                                    @if ($thumb)
                                        <img src="{{ asset('storage/' . $thumb) }}"
                                            class="w-20 h-14 object-cover rounded">
                                    @else
                                        <div
                                            class="w-20 h-14 bg-gray-100 flex items-center justify-center text-xs text-gray-400 rounded">
                                            No Image
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-900">
                                    {{ $room->room_name }}
                                </td>
                                <td class="px-4 py-3">{{ $room->capacity }} orang {{ $room->final_price }}</td>
                                <td class="px-4 py-3">
                                    @if ($room->final_price < $room->base_price)
                                        <p class="text-xs text-gray-400 line-through">
                                            Rp {{ number_format($room->base_price) }}
                                        </p>
                                        <p class="font-semibold text-red-600">
                                            Rp {{ number_format($room->final_price) }}
                                        </p>
                                    @else
                                        <p>
                                            Rp {{ number_format($room->base_price) }}
                                        </p>
                                    @endif

                                    @if ($room->activePromo)
                                        <span
                                            class="inline-block mt-1 px-2 py-0.5 text-xs bg-yellow-100 text-yellow-700 rounded">
                                            Promo Aktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-xs rounded
                                        {{ $room->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($room->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2 justify-center">

                                        <!-- Gallery -->
                                        <a href="{{ route('partner.hotels.rooms.gallery.index', [$property->id, $room->id]) }}"
                                            class="p-2 text-purple-600 hover:bg-purple-200 rounded-lg bg-purple-100"
                                            title="Kelola Gallery">
                                            <svg class="w-[28px] h-[28px] text-gray-800"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-1l-3 3-3-3H6a2 2 0 0 1-2-2V5Zm4 4a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm-2 6h12l-4-5-3 4-2-2-3 3Z" />
                                            </svg>
                                        </a>


                                        <!-- Room Price -->
                                        <a href="{{ route('partner.hotels.rooms.prices.index', [$property->id, $room->id]) }}"
                                            class="p-2 text-indigo-600 hover:bg-indigo-200 rounded-lg bg-indigo-100"
                                            title="Harga Tanggal">
                                            <svg class="w-[28px] h-[28px]text-gray-800" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </a>

                                        {{-- promo  --}}
                                        <a href="{{ route('partner.hotels.rooms.promos.index', [$property->id, $room->id]) }}"
                                            class="p-2 text-yellow-600 hover:bg-yellow-200 rounded-lg bg-yellow-100"
                                            title="Promo">
                                            <svg class="w-[28px] h-[28px] text-gray-800" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2a1 1 0 0 1 .894.553l9 18a1 1 0 0 1-.447 1.341A1 1 0 0 1 21 22H3a1 1 0 0 1-.894-1.447l9-18A1 1 0 0 1 12 2Zm0 4.236-7.455 14.527h14.91L12 6.236ZM11 10v5a1 1 0 0 0 2 0v-5a1 1 0 0 0-2 0Zm1 8a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" />
                                            </svg>

                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('partner.hotels.rooms.edit', [$property->id, $room->id]) }}"
                                            class="p-2 text-blue-600 hover:bg-blue-200 rounded-lg bg-blue-100"
                                            title="Edit">
                                            <svg class="w-[28px] h-[28px] text-gray-800" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-400">
                                    Belum ada room
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
