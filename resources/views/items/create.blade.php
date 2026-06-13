<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('items.index') }}" class="text-dark-400 hover:text-dark-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-dark-900 leading-tight">Tambah Barang</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-dark-200">
                <div class="p-6">
                    <form action="{{ route('items.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <x-input-label for="name" value="Nama Barang" />
                                <x-text-input id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full" required placeholder="Nama barang" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="sku" value="SKU (Kode Unik)" />
                                <x-text-input id="sku" name="sku" value="{{ old('sku') }}" class="mt-1 block w-full" required placeholder="BRG-001" />
                                <x-input-error :messages="$errors->get('sku')" />
                            </div>
                            <div>
                                <x-input-label for="category_id" value="Kategori" />
                                <select id="category_id" name="category_id" class="mt-1 block w-full border-dark-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" />
                            </div>
                            <div>
                                <x-input-label for="supplier_id" value="Supplier" />
                                <select id="supplier_id" name="supplier_id" class="mt-1 block w-full border-dark-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm">
                                    <option value="">Pilih Supplier</option>
                                    @foreach ($suppliers as $sup)
                                        <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>{{ $sup->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="purchase_price" value="Harga Beli" />
                                <x-text-input id="purchase_price" name="purchase_price" type="number" value="{{ old('purchase_price', 0) }}" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('purchase_price')" />
                            </div>
                            <div>
                                <x-input-label for="selling_price" value="Harga Jual" />
                                <x-text-input id="selling_price" name="selling_price" type="number" value="{{ old('selling_price', 0) }}" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('selling_price')" />
                            </div>
                            <div>
                                <x-input-label for="stock_quantity" value="Stok Awal" />
                                <x-text-input id="stock_quantity" name="stock_quantity" type="number" value="{{ old('stock_quantity', 0) }}" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('stock_quantity')" />
                            </div>
                            <div>
                                <x-input-label for="min_stock" value="Minimal Stok" />
                                <x-text-input id="min_stock" name="min_stock" type="number" value="{{ old('min_stock', 0) }}" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('min_stock')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-dark-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm" placeholder="Deskripsi barang (opsional)">{{ old('description') }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <x-primary-button>Simpan</x-primary-button>
                            <a href="{{ route('items.index') }}" class="text-sm text-dark-500 hover:text-dark-700 transition">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
