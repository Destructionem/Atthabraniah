<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Kelola Gelombang</h2></x-slot>
    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))<div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>@endif
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.gelombang.create') }}" class="bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg hover:bg-emerald-800">+ Tambah Gelombang</a>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500"><tr><th class="px-4 py-3 font-medium">Nama</th><th class="px-4 py-3 font-medium">Periode</th><th class="px-4 py-3 font-medium">Biaya</th><th class="px-4 py-3 font-medium">Kuota</th><th class="px-4 py-3 font-medium">Aktif</th><th class="px-4 py-3 font-medium">Aksi</th></tr></thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($gelombang as $g)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $g->nama }}</td>
                            <td class="px-4 py-3 text-gray-600 text-xs">{{ \Carbon\Carbon::parse($g->tanggal_buka)->format('d M Y') }} &ndash; {{ \Carbon\Carbon::parse($g->tanggal_tutup)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-gray-600">Rp {{ number_format($g->biaya_pendaftaran, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $g->kuota }}</td>
                            <td class="px-4 py-3">
                                @if ($g->is_aktif)<span class="px-2 py-1 rounded-full text-xs bg-emerald-100 text-emerald-700">Aktif</span>@else<span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-500">Nonaktif</span>@endif
                            </td>
                            <td class="px-4 py-3 flex gap-3 items-center">
                                <a href="{{ route('admin.gelombang.edit', $g) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.gelombang.destroy', $g) }}" onsubmit="return confirm('Hapus gelombang ini?')">@csrf @method('DELETE')<button class="text-red-600 hover:underline">Hapus</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-6 text-center text-gray-400">Belum ada gelombang.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>