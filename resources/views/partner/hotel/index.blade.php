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

                                            <!-- Edit -->
                                            <a href="{{ route('partner.hotel.edit', $property->id) }}"
                                                class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg" title="Edit">
                                                ✏️
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('partner.hotel.destroy', $property->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus hotel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-2 text-red-600 hover:bg-red-100 rounded-lg"
                                                    title="Hapus">
                                                    🗑️
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
