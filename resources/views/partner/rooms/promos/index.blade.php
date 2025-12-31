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

                {{-- Header --}}
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-xl font-semibold">
                            Promo Room – {{ $room->room_name }}
                        </h1>
                        <p class="text-sm text-gray-500">
                            Hotel: {{ $property->name }}
                        </p>
                    </div>

                    <a href="{{ route('partner.hotels.rooms.promos.create', [$property->id, $room->id]) }}"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        + Tambah Promo
                    </a>
                </div>

                {{-- Table --}}
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="bg-gray-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">Diskon</th>
                            <th class="px-4 py-3">Periode</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promos as $promo)
                            <tr class="bg-white border-b">
                                <td class="px-4 py-3 font-medium text-gray-900">
                                    @if ($promo->discount_type === 'percent')
                                        {{ $promo->discount_value }}%
                                    @else
                                        Rp {{ number_format($promo->discount_value) }}
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    {{ $promo->start_date->format('d M Y') }}
                                    –
                                    {{ $promo->end_date->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    @if ($promo->is_active)
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex gap-2 justify-center">

                                        {{-- Edit --}}
                                        <a href="#"
                                            class="p-2 text-blue-600 hover:bg-blue-200 rounded-lg bg-blue-100"
                                            title="Edit Promo">
                                            ✏️
                                        </a>

                                        {{-- Delete --}}
                                        <form action="#" method="POST"
                                            onsubmit="return confirm('Hapus promo ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-200 rounded-lg bg-red-100"
                                                title="Hapus Promo">
                                                🗑
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-400">
                                    Belum ada promo untuk room ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Back --}}
                <div class="mt-6">
                    <a href="{{ route('partner.hotels.rooms.index', $property->id) }}"
                        class="text-sm text-gray-600 hover:underline">
                        ← Kembali ke daftar room
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
