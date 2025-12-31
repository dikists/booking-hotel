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
                <h1 class="text-xl font-semibold text-gray-800 mb-2">
                    Edit Room – {{ $property->name }}
                </h1>

                <a href="{{ route('partner.hotels.rooms.index', $property->id) }}"
                    class="bg-red-600 text-white px-4 py-2 rounded mb-4 inline-block text-sm text-gray-500 hover:text-white hover:bg-red-700">
                    ← Kembali
                </a>

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                {{-- Form --}}
                <form action="{{ route('partner.hotels.rooms.update', [$property->id, $room->id]) }}" method="POST"
                    class="bg-white shadow rounded-lg p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Room Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Room
                        </label>
                        <input type="text" name="room_name" value="{{ old('room_name', $room->room_name) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    {{-- Capacity --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kapasitas
                        </label>
                        <input type="number" name="capacity" min="1"
                            value="{{ old('capacity', $room->capacity) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-red-500 focus:border-red-500">
                        <p class="text-xs text-gray-400 mt-1">Jumlah tamu maksimal</p>
                    </div>

                    {{-- Base Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Harga Dasar (per malam)
                        </label>
                        <input type="number" name="base_price" value="{{ old('base_price', $room->base_price) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-red-500 focus:border-red-500">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Status
                        </label>
                        <select name="status"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-red-500 focus:border-red-500">
                            <option value="available"
                                {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="unavailable"
                                {{ old('status', $room->status) == 'unavailable' ? 'selected' : '' }}>
                                Unavailable
                            </option>
                        </select>
                    </div>

                    {{-- Action --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('partner.hotels.rooms.index', $property->id) }}"
                            class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                            Update Room
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-app-layout>
