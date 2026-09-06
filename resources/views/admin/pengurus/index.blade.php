<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Kelola Pengurus & Ustadz</h2></x-slot>
    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))<div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>@endif
        <div class="flex justify-between items-center mb-4">
            <!-- <a href="{{ route('admin.index') }}" class="text-emerald-700 hover:underline text-sm">&larr; Dashboard Admin</a> -->
            <a href="{{ route('admin.pengurus.create') }}" class="bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg hover:bg-emerald-800">+ Tambah</a>
        </div>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600"><tr><th class="px-4 py-3">Foto</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Jabatan</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Aksi</th></tr></thead>
                <tbody class="divide-y">
                    @forelse ($pengurus as $p)
                        <tr>
                            <td class="px-4 py-3">
                                @if ($p->foto)<img src="{{ asset('storage/' . $p->foto) }}" class="w-10 h-10 rounded-full object-cover">@else<div class="w-10 h-10 rounded-full bg-emerald-100"></div>@endif
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $p->nama }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $p->jabatan }}</td>
                            <td class="px-4 py-3"><span class="px-2 py-1 rounded-full text-xs {{ $p->tipe === 'pengajar' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700' }}">{{ $p->tipe === 'pengajar' ? 'Ustadz/Pengajar' : 'Pengurus' }}</span></td>
                            <td class="px-4 py-3 flex gap-3 items-center">
                                <a href="{{ route('admin.pengurus.edit', $p) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.pengurus.destroy', $p) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="text-red-600 hover:underline">Hapus</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>