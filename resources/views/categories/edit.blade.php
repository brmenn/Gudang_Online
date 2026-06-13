<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('categories.index') }}" class="text-dark-400 hover:text-dark-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-dark-900 leading-tight">Edit Kategori</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-dark-200">
                <div class="p-6">
                    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                        @csrf @method('PUT')
                        <div>
                            <x-input-label for="name" value="Nama Kategori" />
                            <x-text-input id="name" name="name" value="{{ old('name', $category->name) }}" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="description" value="Deskripsi" />
                            <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-dark-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm">{{ old('description', $category->description) }}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <x-primary-button>Update</x-primary-button>
                            <a href="{{ route('categories.index') }}" class="text-sm text-dark-500 hover:text-dark-700 transition">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
