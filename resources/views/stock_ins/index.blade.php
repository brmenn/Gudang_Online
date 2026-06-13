<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark-900 leading-tight">Riwayat Stok Masuk</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-dark-100">
                    <h3 class="font-semibold text-dark-900">Semua Riwayat Stok Masuk</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-dark-50">
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">No</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Barang</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Qty</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Harga</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Total</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Supplier</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">User</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark-100">
                            @forelse ($stockIns as $stockIn)
                                <tr class="hover:bg-dark-50/50 transition">
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-dark-900">{{ $stockIn->item->name }}</td>
                                    <td class="px-6 py-4"><span class="badge badge-green">{{ $stockIn->quantity }}</span></td>
                                    <td class="px-6 py-4 text-sm text-dark-700">Rp {{ number_format($stockIn->purchase_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-700">Rp {{ number_format($stockIn->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $stockIn->supplier->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $stockIn->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $stockIn->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="px-6 py-12 text-center text-sm text-dark-400">Belum ada riwayat stok masuk</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-dark-100">{{ $stockIns->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
