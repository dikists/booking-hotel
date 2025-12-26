<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">

                <form action="{{ route('partner.hotel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Hotel
                        </label>
                        <input type="text" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="province" class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
                        <select id="province" name="province_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">
                                    {{ $province->name }}
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
                        <select id="city" name="regency_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option value="">Pilih Kota</option>
                        </select>
                        @error('regency_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kecamatan --}}
                    <div class="mb-4">
                        <label for="district" class="block mb-2 text-sm font-medium text-gray-900">Kecamatan</label>
                        <select id="district" name="district_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option value="">Pilih Kecamatan</option>
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5">{{ old('address') }}</textarea>
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

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            Gallery
                        </label>
                        <input type="file" name="gallery[]" multiple
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50">
                    </div>



                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
                            Simpan
                        </button>

                        <a href="{{ route('partner.hotel.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
        {{-- <script>
            document.getElementById('province').addEventListener('change', function() {
                let provinceId = this.value;
                let citySelect = document.getElementById('city');
                let districtSelect = document.getElementById('district');

                citySelect.innerHTML = '<option value="">Loading...</option>';
                citySelect.disabled = true;
                districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                districtSelect.disabled = true;

                if (!provinceId) return;

                fetch(`/get-cities/${provinceId}`)
                    .then(res => res.json())
                    .then(data => {
                        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
                        data.forEach(city => {
                            citySelect.innerHTML +=
                                `<option value="${city.id}">${city.name}</option>`;
                        });
                        citySelect.disabled = false;
                    });
            });

            document.getElementById('city').addEventListener('change', function() {
                let cityId = this.value;
                let districtSelect = document.getElementById('district');

                districtSelect.innerHTML = '<option value="">Loading...</option>';
                districtSelect.disabled = true;

                if (!cityId) return;

                fetch(`/get-districts/${cityId}`)
                    .then(res => res.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        data.forEach(district => {
                            districtSelect.innerHTML +=
                                `<option value="${district.id}">${district.name}</option>`;
                        });
                        districtSelect.disabled = false;
                    });
            });
        </script> --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const provinceSelect = new TomSelect("#province", {
                    placeholder: "Pilih Provinsi",
                    allowEmptyOption: true
                });
    
                const citySelect = new TomSelect("#city", {
                    placeholder: "Pilih Kota",
                    allowEmptyOption: true
                });
    
                const districtSelect = new TomSelect("#district", {
                    placeholder: "Pilih Kecamatan",
                    allowEmptyOption: true
                });
    
                // Provinsi → Kota
                provinceSelect.on('change', function(provinceId) {
                    citySelect.clear();
                    citySelect.clearOptions();
                    citySelect.addOption({
                        value: "",
                        text: "Loading..."
                    });
                    citySelect.refreshOptions(false);
    
                    districtSelect.clear();
                    districtSelect.clearOptions();
    
                    if (!provinceId) return;
    
                    fetch(`/get-cities/${provinceId}`)
                        .then(res => res.json())
                        .then(data => {
                            citySelect.clearOptions();
                            citySelect.addOption({
                                value: "",
                                text: "Pilih Kota"
                            });
    
                            data.forEach(city => {
                                citySelect.addOption({
                                    value: city.id,
                                    text: city.name
                                });
                            });
    
                            citySelect.refreshOptions(false);
                        });
                });
    
                // Kota → Kecamatan
                citySelect.on('change', function(cityId) {
                    districtSelect.clear();
                    districtSelect.clearOptions();
                    districtSelect.addOption({
                        value: "",
                        text: "Loading..."
                    });
                    districtSelect.refreshOptions(false);
    
                    if (!cityId) return;
    
                    fetch(`/get-districts/${cityId}`)
                        .then(res => res.json())
                        .then(data => {
                            districtSelect.clearOptions();
                            districtSelect.addOption({
                                value: "",
                                text: "Pilih Kecamatan"
                            });
    
                            data.forEach(district => {
                                districtSelect.addOption({
                                    value: district.id,
                                    text: district.name
                                });
                            });
    
                            districtSelect.refreshOptions(false);
                        });
                });
            });
        </script>
    @endpush
</x-app-layout>
