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
                <a href="{{ route('partner.hotel.create') }}"
                    class="mb-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    + Tambah Hotel
                </a>

                {{-- Table --}}
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-4 py-3">Thumbnail</th>
                                <th class="px-4 py-3">Nama Hotel</th>
                                <th class="px-4 py-3">Harga Mulai</th>
                                <th class="px-4 py-3">Alamat</th>
                                <th class="px-4 py-3">Wilayah</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 w-32 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($properties as $property)
                                <tr class="bg-white border-b">
                                    {{-- Thumbnail --}}
                                    <td class="px-4 py-3">
                                        @if ($property->thumbnail)
                                            <img src="{{ asset('storage/' . $property->thumbnail) }}"
                                                class="w-24 h-16 object-cover rounded" alt="{{ $property->name }}">
                                        @else
                                            <div
                                                class="w-24 h-16 flex items-center justify-center bg-gray-100 text-gray-400 rounded">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-4 py-3 font-medium text-gray-900">
                                        {{ $property->name }}
                                    </td>

                                    {{-- Harga Mulai --}}
                                    <td class="px-4 py-3">
                                        @if ($property->lowest_price)
                                            <span class="font-semibold text-red-600">
                                                Rp {{ number_format($property->lowest_price) }}
                                            </span>
                                            <div class="text-xs text-gray-400">
                                                / malam
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">
                                                Belum ada kamar
                                            </span>
                                        @endif
                                    </td>


                                    {{-- Alamat --}}
                                    <td class="px-4 py-3">
                                        {{ Str::limit($property->address, 60) }}
                                    </td>

                                    {{-- Wilayah --}}
                                    <td class="px-4 py-3">
                                        <div class="text-sm">
                                            {{ $property->district->name ?? '-' }},
                                            {{ $property->city->name ?? '-' }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ $property->province->name ?? '-' }}
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded
                                            {{ $property->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $property->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">

                                            <!-- Rooms -->
                                            <a href="{{ route('partner.hotel.rooms.index', $property->id) }}"
                                                class="p-2 text-emerald-600 hover:bg-emerald-100 bg-emerald-200 rounded-lg"
                                                title="Kelola Room">
                                                <svg class="w-[28px] h-[28px] text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M5 3a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5Zm0 12a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H5Zm12 0a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2h-2Zm0-12a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2Z" />
                                                    <path fill-rule="evenodd"
                                                        d="M10 6.5a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-2a1 1 0 0 1-1-1ZM10 18a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-2a1 1 0 0 1-1-1Zm-4-4a1 1 0 0 1-1-1v-2a1 1 0 1 1 2 0v2a1 1 0 0 1-1 1Zm12 0a1 1 0 0 1-1-1v-2a1 1 0 1 1 2 0v2a1 1 0 0 1-1 1Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('partner.hotel.edit', $property->id) }}"
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

                                            <!-- Delete -->
                                            <form action="{{ route('partner.hotel.destroy', $property->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus hotel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-2 text-red-600 hover:bg-red-100 bg-red-200 rounded-lg"
                                                    title="Hapus">
                                                    <svg class="w-[28px] h-[28px] text-gray-800" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M3 15v3c0 .5523.44772 1 1 1h16c.5523 0 1-.4477 1-1v-3M3 15V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v9M3 15h18M8 15v4m4-4v4m4-4v4m-5.5061-7.4939L12 10m0 0 1.5061-1.50614M12 10l1.5061 1.5061M12 10l-1.5061-1.50614" />
                                                    </svg>

                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                                        Belum ada data hotel
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
