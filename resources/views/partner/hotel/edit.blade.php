<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                <form method="POST" action="{{ route('partner.hotel.update', $property->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Hotel
                        </label>
                        <input type="text" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                            value="{{ old('name', $property->name) }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="province" class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
                        <select id="province" name="province_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option selected>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                @php
                                    $selected = $province->id == $property->province_id ? 'selected' : '';
                                @endphp
                                <option value="{{ $province->id }}" {{ $selected }}>
                                    {{ $province->province_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('province_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kota --}}
                    <div class="mb-4">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Kota</label>
                        <select id="city" name="city_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option selected>Pilih Kota</option>
                        </select>
                        @error('city_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kecamatan --}}
                    <div class="mb-4">
                        <label for="district" class="block mb-2 text-sm font-medium text-gray-900">Kecamatan</label>
                        <select id="district" name="district_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option selected>Pilih Kecamatan</option>
                        </select>
                        @error('district_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Alamat
                        </label>
                        <textarea name="address" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">{{ old('address', $property->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Thumbnail
                        </label>
                        <input type="file" name="thumbnail"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50">
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                    </div>
                    @if ($property->thumbnail)
                        <img src="{{ asset('storage/' . $property->thumbnail) }}"
                            class="w-32 h-20 object-cover rounded mb-2">
                    @endif

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Gallery
                        </label>
                        <input type="file" name="gallery[]" multiple
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50">
                    </div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach ($property->galleries as $img)
                            <img src="{{ asset('storage/' . $img->image) }}" class="w-32 h-20 object-cover rounded">
                        @endforeach
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button class="px-5 py-2 bg-blue-600 text-white rounded-lg">
                            Update
                        </button>

                        <a href="{{ route('partner.hotel.index') }}" class="ml-2 px-5 py-2 bg-gray-200 rounded-lg">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const oldProvince = {{ $property->province_id }};
            const oldCity = {{ $property->city_id }};
            const oldDistrict = {{ $property->district_id }};

            document.addEventListener('DOMContentLoaded', async () => {
                if (oldProvince) {
                    await loadCities(oldProvince, oldCity);
                }

                if (oldCity) {
                    await loadDistricts(oldCity, oldDistrict);
                }
            });

            function loadCities(provinceId, selectedCity = null) {
                return fetch(`/get-cities/${provinceId}`)
                    .then(res => res.json())
                    .then(data => {
                        let citySelect = document.getElementById('city');
                        citySelect.innerHTML = `<option value="">Pilih Kota</option>`;

                        data.forEach(city => {
                            let selected = city.id == selectedCity ? 'selected' : '';
                            citySelect.innerHTML +=
                                `<option value="${city.id}" ${selected}>${city.city_name}</option>`;
                        });
                    });
            }

            function loadDistricts(cityId, selectedDistrict = null) {
                return fetch(`/get-districts/${cityId}`)
                    .then(res => res.json())
                    .then(data => {
                        let districtSelect = document.getElementById('district');
                        districtSelect.innerHTML = `<option value="">Pilih Kecamatan</option>`;

                        data.forEach(district => {
                            let selected = district.id == selectedDistrict ? 'selected' : '';
                            districtSelect.innerHTML +=
                                `<option value="${district.id}" ${selected}>${district.district_name}</option>`;
                        });
                    });
            }
        </script>
    @endpush
</x-app-layout>
