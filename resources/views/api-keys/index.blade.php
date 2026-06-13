<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-dark-900 leading-tight">API Keys</h2>
            <a href="{{ route('api-keys.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 transition">
                + Buat Key Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('new_api_key'))
                <div class="mb-6 p-4 bg-primary-50 border border-primary-200 rounded-xl">
                    <p class="text-sm font-medium text-primary-800 mb-2">API Key berhasil dibuat! Salin key ini sekarang — tidak akan ditampilkan lagi.</p>
                    <div class="flex items-center gap-2">
                        <code class="flex-1 p-3 bg-white border border-primary-200 rounded-lg text-sm font-mono text-dark-800 break-all">{{ session('new_api_key') }}</code>
                        <button onclick="navigator.clipboard.writeText('{{ session('new_api_key') }}')" class="shrink-0 px-3 py-2 bg-primary-600 text-white rounded-lg text-sm hover:bg-primary-500 transition">
                            Salin
                        </button>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="font-semibold text-dark-900">Daftar API Keys</h3>
                </div>
                <div class="card-body p-0">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-dark-200 bg-dark-50">
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Nama</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Key</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Status</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Terakhir Dipakai</th>
                                <th class="text-left px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Dibuat</th>
                                <th class="text-right px-6 py-3 text-xs font-semibold text-dark-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark-100">
                            @forelse ($apiKeys as $apiKey)
                                <tr class="hover:bg-dark-50/50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-dark-900">{{ $apiKey->name }}</td>
                                    <td class="px-6 py-4">
                                        <code class="text-xs font-mono text-dark-500 bg-dark-100 px-2 py-1 rounded">{{ substr($apiKey->key, 0, 20) }}...</code>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($apiKey->is_active)
                                            <span class="badge badge-green">Aktif</span>
                                        @else
                                            <span class="badge badge-red">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-dark-500">
                                        {{ $apiKey->last_used_at ? $apiKey->last_used_at->diffForHumans() : 'Belum pernah' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-dark-500">{{ $apiKey->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <form action="{{ route('api-keys.toggle', $apiKey) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-sm {{ $apiKey->is_active ? 'text-red-600 hover:text-red-500' : 'text-green-600 hover:text-green-500' }} transition">
                                                    {{ $apiKey->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                            <form action="{{ route('api-keys.destroy', $apiKey) }}" method="POST" class="inline" onsubmit="return confirm('Hapus API key ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-600 hover:text-red-500 transition">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-dark-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-dark-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                        <p class="text-sm">Belum ada API Key. Buat key pertama untuk integrasi.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
