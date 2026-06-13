<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark-900 leading-tight">Riwayat Stok Keluar</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-dark-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-dark-100">
                    <h3 class="font-semibold text-dark-900">Semua Riwayat Stok Keluar</h3>
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
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">User</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark-100">
                            @forelse ($stockOuts as $stockOut)
                                <tr class="hover:bg-dark-50/50 transition">
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-dark-900">{{ $stockOut->item->name }}</td>
                                    <td class="px-6 py-4"><span class="badge badge-red">{{ $stockOut->quantity }}</span></td>
                                    <td class="px-6 py-4 text-sm text-dark-700">Rp {{ number_format($stockOut->selling_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-700">Rp {{ number_format($stockOut->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $stockOut->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $stockOut->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-6 py-12 text-center text-sm text-dark-400">Belum ada riwayat stok keluar</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-dark-100">{{ $stockOuts->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
