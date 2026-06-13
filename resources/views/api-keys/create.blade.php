<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('api-keys.index') }}" class="text-dark-400 hover:text-dark-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-dark-900 leading-tight">Buat API Key Baru</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('api-keys.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" value="Nama Key" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Contoh: Aplikasi Kasir Toko" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <p class="mt-1 text-xs text-dark-400">Gunakan nama yang mudah dikenali untuk membedakan setiap API Key.</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <x-primary-button>Buat Key</x-primary-button>
                            <a href="{{ route('api-keys.index') }}" class="text-sm text-dark-500 hover:text-dark-700 transition">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
