<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-dark-900">Dashboard</h1>
                <p class="text-sm text-dark-500 mt-0.5">Selamat datang kembali, <span class="font-medium text-dark-700">{{ Auth::user()->name }}</span></p>
            </div>
            <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-50 text-primary-700 border border-primary-200">
                {{ now()->format('l, d F Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-primary-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <span class="text-xs font-medium text-dark-400 bg-dark-100 px-2 py-0.5 rounded-full">Total</span>
                    </div>
                    <p class="text-3xl font-bold text-dark-900">{{ $totalItems }}</p>
                    <p class="text-sm text-dark-500 mt-1">Barang</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Tersedia</span>
                    </div>
                    <p class="text-3xl font-bold text-dark-900">{{ $totalItems - $lowStockItems }}</p>
                    <p class="text-sm text-dark-500 mt-1">Stok Tersedia</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-red-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-0.5 rounded-full">Kritis</span>
                    </div>
                    <p class="text-3xl font-bold text-dark-900">{{ $lowStockItems }}</p>
                    <p class="text-sm text-dark-500 mt-1">Stok Menipis</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-dark-200 p-5 hover:shadow-md transition">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-11 h-11 bg-dark-50 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-dark-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <span class="text-xs font-medium text-dark-400 bg-dark-100 px-2 py-0.5 rounded-full">Total</span>
                    </div>
                    <p class="text-3xl font-bold text-dark-900">{{ $totalCategories }}</p>
                    <p class="text-sm text-dark-500 mt-1">Kategori</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-dark-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <h3 class="font-semibold text-dark-900">Stok Masuk Terbaru</h3>
                        </div>
                        <a href="{{ route('stock-ins.index') }}" class="text-xs font-medium text-primary-600 hover:text-primary-500 transition">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-dark-50">
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Barang</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-dark-100">
                                @forelse ($recentStockIns as $stockIn)
                                    <tr class="hover:bg-dark-50/50 transition">
                                        <td class="px-6 py-3.5 text-sm font-medium text-dark-900">{{ $stockIn->item->name }}</td>
                                        <td class="px-6 py-3.5"><span class="badge badge-green">+{{ $stockIn->quantity }}</span></td>
                                        <td class="px-6 py-3.5 text-sm text-dark-500">{{ $stockIn->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-6 py-10 text-center text-sm text-dark-400">Belum ada transaksi stok masuk</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-dark-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <h3 class="font-semibold text-dark-900">Stok Keluar Terbaru</h3>
                        </div>
                        <a href="{{ route('stock-outs.index') }}" class="text-xs font-medium text-primary-600 hover:text-primary-500 transition">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-dark-50">
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Barang</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-dark-100">
                                @forelse ($recentStockOuts as $stockOut)
                                    <tr class="hover:bg-dark-50/50 transition">
                                        <td class="px-6 py-3.5 text-sm font-medium text-dark-900">{{ $stockOut->item->name }}</td>
                                        <td class="px-6 py-3.5"><span class="badge badge-red">-{{ $stockOut->quantity }}</span></td>
                                        <td class="px-6 py-3.5 text-sm text-dark-500">{{ $stockOut->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-6 py-10 text-center text-sm text-dark-400">Belum ada transaksi stok keluar</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
