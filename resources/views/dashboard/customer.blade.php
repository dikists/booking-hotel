<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-gray-600">
                Selamat datang di dashboard kamu 👋
            </p>

            <a href="" class="inline-block mt-4 bg-red-600 text-white px-6 py-3 rounded-lg">
                Lihat Booking Saya
            </a>
        </div>
    </section>
</x-app-layout>
