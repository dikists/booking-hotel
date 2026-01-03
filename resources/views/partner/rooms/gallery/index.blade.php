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
                            Gallery – {{ $room->room_name }}
                        </h1>
                        <p class="text-sm text-gray-500">
                            Hotel: {{ $property->name }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('partner.hotels.rooms.gallery.store', [$property->id, $room->id]) }}"
                    method="POST" enctype="multipart/form-data" class="mb-6 bg-gray-50 p-4 rounded-lg">
                    @csrf


                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Upload Foto Room
                            (boleh lebih dari satu)</label>
                        <div
                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                                    class="mx-auto w-[28px] h-[28px] text-gray-300">
                                    <path
                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                        clip-rule="evenodd" fill-rule="evenodd" />
                                </svg>
                                <div class="mt-4 flex text-sm/6 text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                        <span>Upload a file </span>
                                        <input id="file-upload" type="file" name="images[]" multiple accept="image/*"
                                            class="sr-only" />
                                    </label>
                                    <p class="pl-1"> or drag and drop</p>
                                </div>
                                <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    @error('images')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    @error('images.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <button class="mt-3 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Upload
                    </button>
                </form>


                <!-- Gallery Grid -->
                @if ($galleries->count())
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($galleries as $gallery)
                            <div class="relative group rounded-xl overflow-hidden border">

                                {{-- Badge selalu di atas --}}
                                @if ($gallery->is_primary)
                                    <span
                                        class="absolute top-2 left-2 z-40
                                        bg-emerald-600 text-white text-xs
                                        px-2 py-1 rounded shadow">
                                        Foto Utama
                                    </span>
                                @endif
                                <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-40 object-cover">

                                {{-- Overlay --}}
                                <div
                                    class="absolute inset-0 z-20 bg-black/60
                                            flex items-center justify-center gap-2
                                            opacity-100 md:opacity-0 md:group-hover:opacity-100
                                            transition">

                                    @if (!$gallery->is_primary)
                                        <form
                                            action="{{ route('partner.hotels.rooms.gallery.primary', [$property->id, $room->id, $gallery->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="bg-white px-3 py-1.5 rounded text-sm font-medium hover:bg-gray-200">
                                                Jadikan Utama
                                            </button>
                                        </form>
                                    @endif

                                    <form
                                        action="{{ route('partner.hotels.rooms.gallery.destroy', [$property->id, $room->id, $gallery->id]) }}"
                                        method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-600 text-white px-3 py-1.5 rounded text-sm hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>

                                </div>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-400 py-12">
                        Belum ada foto untuk room ini
                    </div>
                @endif


                {{-- Back --}}
                <div class="mt-6">
                    <a href="{{ route('partner.hotel.rooms.index', $property->id) }}"
                        class="text-sm text-gray-600 hover:underline">
                        ← Kembali ke daftar room
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
