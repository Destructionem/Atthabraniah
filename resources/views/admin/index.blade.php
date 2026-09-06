<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard Admin</h2>
    </x-slot>

    @php
        $icon = 'w-5 h-5';
    @endphp

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-xl">{{ session('success') }}</div>
        @endif

        {{-- Sapaan + aksi (ringan, tanpa banner berat) --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm text-gray-400">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <h3 class="text-2xl font-bold text-gray-800">Halo, {{ auth()->user()->name }}</h3>
                <p class="text-gray-500 text-sm">Ringkasan Penerimaan Santri Baru.</p>
            </div>
            <a href="{{ route('admin.export.excel') }}" class="inline-flex items-center gap-2 bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-emerald-800 self-start">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export Excel
            </a>
        </div>

        {{-- Kartu statistik (berikon, lega) --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-gray-500">Total Pendaftar</span>
                    <span class="w-9 h-9 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center">
                        <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-gray-500">Sudah Lunas</span>
                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-emerald-700">{{ $stats['lunas'] }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-gray-500">Menunggu Bayar</span>
                    <span class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-amber-600">{{ $stats['menunggu'] }}</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm text-gray-500">Diterima</span>
                    <span class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    </span>
                </div>
                <p class="text-3xl font-bold text-blue-700">{{ $stats['diterima'] }}</p>
            </div>
        </div>

        {{-- Pemasukan + grafik --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-emerald-700 text-white p-6 rounded-2xl shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 text-emerald-100 text-sm">
                    <svg class="{{ $icon }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3"/></svg>
                    Total Pemasukan
                </div>
                <p class="text-3xl font-bold mt-2">Rp {{ number_format($stats['pemasukan'], 0, ',', '.') }}</p>
                <p class="text-emerald-100 text-xs mt-2">dari pendaftaran yang lunas</p>
            </div>
            <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm md:col-span-2">
                <h3 class="font-semibold text-gray-800 mb-4">Grafik Status Pendaftaran</h3>
                <div style="max-width:340px; margin:auto;"><canvas id="grafikStatus"></canvas></div>
            </div>
        </div>

        {{-- Tabel pendaftar --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100"><h3 class="font-semibold text-gray-800">Daftar Pendaftar</h3></div>
            <form method="GET" action="{{ route('admin.index') }}" class="flex flex-col sm:flex-row gap-2 px-5 py-4 border-b border-gray-100">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama atau no. pendaftaran..." class="flex-1 rounded-lg border-gray-300 text-sm shadow-sm">
                <select name="status" class="rounded-lg border-gray-300 text-sm shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="menunggu_pembayaran" @selected(request('status')==='menunggu_pembayaran')>Menunggu Bayar</option>
                    <option value="lunas" @selected(request('status')==='lunas')>Lunas</option>
                    <option value="diterima" @selected(request('status')==='diterima')>Diterima</option>
                    <option value="ditolak" @selected(request('status')==='ditolak')>Ditolak</option>
                </select>
                <button class="bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-emerald-800">Cari</button>
                @if (request('cari') || request('status'))
                    <a href="{{ route('admin.index') }}" class="text-sm text-gray-500 px-3 py-2 hover:underline self-center">Reset</a>
                @endif
            </form>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="px-5 py-3 font-medium">No. Pendaftaran</th>
                            <th class="px-5 py-3 font-medium">Nama Santri</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                            <th class="px-5 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($pendaftar as $p)
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-3 font-mono text-xs text-gray-600">{{ $p->no_pendaftaran }}</td>
                                <td class="px-5 py-3 font-medium text-gray-800">{{ $p->calonSantri->nama_lengkap ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($p->status==='lunas') bg-emerald-100 text-emerald-800
                                        @elseif($p->status==='diterima') bg-blue-100 text-blue-800
                                        @elseif($p->status==='ditolak') bg-red-100 text-red-800
                                        @else bg-amber-100 text-amber-800 @endif">
                                        {{ ucwords(str_replace('_', ' ', $p->status)) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.show', $p) }}" class="text-emerald-700 hover:underline font-medium">Detail</a>
                                    <a href="{{ route('bukti.cetak', $p) }}" target="_blank" class="text-gray-500 hover:underline ml-3">Cetak</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada pendaftar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('grafikStatus'), {
            type: 'doughnut',
            data: {
                labels: ['Menunggu Bayar', 'Lunas', 'Diterima'],
                datasets: [{
                    data: [{{ $stats['menunggu'] }}, {{ $stats['lunas'] }}, {{ $stats['diterima'] }}],
                    backgroundColor: ['#f59e0b', '#059669', '#2563eb'],
                    borderWidth: 0,
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });
    </script>
</x-admin-layout>