<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <h1 class="text-lg font-semibold mb-1">
                    Promo – {{ $room->room_name }}
                </h1>
                <p class="text-sm text-gray-500 mb-6">
                    Hotel: {{ $property->name }}
                </p>

                @error('start_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror


                <form action="{{ route('partner.hotels.rooms.promos.store', [$property->id, $room->id]) }}" method="POST"
                    class="space-y-5">
                    @csrf

                    {{-- Discount Type --}}
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Tipe Diskon
                        </label>
                        <select name="discount_type" class="w-full border rounded-lg px-4 py-2">
                            <option value="percent">Persentase (%)</option>
                            <option value="amount">Nominal (Rp)</option>
                        </select>
                    </div>

                    {{-- Discount Value --}}
                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Nilai Diskon
                        </label>
                        <input type="number" name="discount_value" value="{{ old('discount_value') }}"
                            class="w-full border rounded-lg px-4 py-2" placeholder="Contoh: 20 atau 100000">
                    </div>

                    {{-- Date Range --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Tanggal Mulai
                            </label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}"
                                class="w-full border rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">
                                Tanggal Selesai
                            </label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}"
                                class="w-full border rounded-lg px-4 py-2">
                        </div>
                    </div>

                    {{-- Active --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded">
                        <label class="text-sm text-gray-700">
                            Aktifkan promo
                        </label>
                    </div>

                    {{-- Action --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('partner.hotels.rooms.promos.index', [$property->id, $room->id]) }}"
                            class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Simpan Promo
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
