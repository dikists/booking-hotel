<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900/60 border border-gray-800 backdrop-blur-md overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-8 text-gray-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-400">Anda berhasil login ke platform agregator hotel budget RedStay.</p>
                    
                    <div class="mt-8 pt-6 border-t border-gray-800/80 flex items-center justify-between">
                        <a href="{{ url('/') }}" class="bg-neon-gradient text-white px-5 py-2.5 rounded-xl font-bold shadow-neon hover:shadow-neon-hover text-sm transition-all duration-300">
                            Cari & Pesan Hotel Sekarang →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
