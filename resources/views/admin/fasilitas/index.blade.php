<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Kelola Fasilitas</h2></x-slot>
    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))<div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>@endif
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.fasilitas.create') }}" class="bg-emerald-700 text-white font-semibold px-4 py-2 rounded-lg hover:bg-emerald-800">+ Tambah Fasilitas</a>
        </div>
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600"><tr><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Keterangan</th><th class="px-4 py-3">Aksi</th></tr></thead>
                <tbody class="divide-y">
                    @forelse ($fasilitas as $f)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $f->nama }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $f->keterangan }}</td>
                            <td class="px-4 py-3 flex gap-3 items-center">
                                <a href="{{ route('admin.fasilitas.edit', $f) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.fasilitas.destroy', $f) }}" onsubmit="return confirm('Hapus fasilitas ini?')">@csrf @method('DELETE')<button class="text-red-600 hover:underline">Hapus</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-6 text-center text-gray-400">Belum ada fasilitas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>