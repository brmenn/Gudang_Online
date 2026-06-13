<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('suppliers.index') }}" class="text-dark-400 hover:text-dark-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-dark-900 leading-tight">Tambah Supplier</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-dark-200">
                <div class="p-6">
                    <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <x-input-label for="name" value="Nama Perusahaan" />
                                <x-text-input id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full" required placeholder="PT. Supplier Makmur" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="contact_person" value="Kontak Person" />
                                <x-text-input id="contact_person" name="contact_person" value="{{ old('contact_person') }}" class="mt-1 block w-full" placeholder="Nama PIC" />
                            </div>
                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-1 block w-full" placeholder="email@supplier.com" />
                            </div>
                            <div>
                                <x-input-label for="phone" value="Telepon" />
                                <x-text-input id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full" placeholder="0812-xxxx-xxxx" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="address" value="Alamat" />
                            <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-dark-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm" placeholder="Alamat lengkap supplier">{{ old('address') }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                            <a href="{{ route('suppliers.index') }}" class="text-sm text-dark-500 hover:text-dark-700 transition">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
