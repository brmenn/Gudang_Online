<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-dark-900 leading-tight">Kategori</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-dark-100 flex items-center justify-between">
                    <h3 class="font-semibold text-dark-900">Semua Kategori</h3>
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center px-3 py-1.5 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-500 transition">
                        + Tambah
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-dark-50">
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">No</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Nama</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="text-right px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark-100">
                            @forelse ($categories as $category)
                                <tr class="hover:bg-dark-50/50 transition">
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-dark-900">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $category->description ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('categories.edit', $category) }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 transition">Edit</a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button class="text-sm font-medium text-red-500 hover:text-red-700 transition">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-6 py-12 text-center text-sm text-dark-400">Belum ada data kategori</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-dark-100">{{ $categories->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
