<x-red-stay-layout>

    <main class="max-w-7xl mx-auto px-4 pt-28 pb-16 mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT: Booking Detail -->
            <div class="lg:col-span-2 space-y-6">

                <h1 class="text-2xl font-bold">
                    Konfirmasi Booking
                </h1>

                <!-- Room Info -->
                <div class="bg-white rounded-xl shadow p-6 flex gap-4">
                    <img src="{{ $room->thumbnail }}" class="w-32 h-24 object-cover rounded-lg"
                        alt="{{ $room->room_name }}">

                    <div>
                        <h2 class="text-lg font-semibold">
                            {{ $room->room_name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ $room->property->name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Kapasitas {{ $room->capacity }} orang
                        </p>
                    </div>
                </div>

                <!-- Date Info -->
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Check-in</p>
                            <p class="font-semibold">{{ $checkin }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Check-out</p>
                            <p class="font-semibold">{{ $checkout }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500">Durasi</p>
                            <p class="font-semibold">
                                {{ $totalNight }} malam
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500">Harga / malam</p>
                            <p class="font-semibold text-red-600">
                                Rp {{ number_format($pricePerNight, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT: Price Summary -->
            <div class="bg-white rounded-xl shadow p-6 h-fit">

                <h3 class="text-lg font-semibold mb-4">
                    Ringkasan Harga
                </h3>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>
                            {{ $totalNight }} malam x
                            Rp {{ number_format($pricePerNight, 0, ',', '.') }}
                        </span>
                        <span>
                            Rp {{ number_format($totalPrice, 0, ',', '.') }}
                        </span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-bold text-lg text-red-600">
                        <span>Total</span>
                        <span>
                            Rp {{ number_format($totalPrice, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- NEXT STEP BUTTON (BELUM SUBMIT) -->
                <form method="POST" action="{{ route('booking.store') }}">
                    @csrf

                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="checkin" value="{{ $checkin }}">
                    <input type="hidden" name="checkout" value="{{ $checkout }}">

                    <button class="w-full mt-6 bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition">
                        Lanjutkan ke Pembayaran
                    </button>
                </form>


            </div>

        </div>
    </main>

</x-red-stay-layout>
