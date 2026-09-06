<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Kelola Pengumuman</h2></x-slot>
    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))<div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>@endif

        {{-- Form tambah --}}
        <form method="POST" action="{{ route('admin.pengumuman.store') }}" class="bg-white border border-gray-200 p-6 rounded-xl shadow-sm space-y-4">
            @csrf
            @if ($errors->any())<div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul *</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Isi *</label>
                <textarea name="isi" rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>{{ old('isi') }}</textarea>
            </div>
            <div class="flex justify-end"><button class="bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-emerald-800">Terbitkan</button></div>
        </form>

        {{-- Daftar --}}
        <div class="space-y-3">
            @forelse ($pengumuman as $pg)
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex justify-between items-start">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $pg->judul }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $pg->isi }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $pg->created_at->translatedFormat('d M Y') }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.pengumuman.destroy', $pg) }}" onsubmit="return confirm('Hapus pengumuman ini?')">@csrf @method('DELETE')<button class="text-red-600 text-sm hover:underline">Hapus</button></form>
                </div>
            @empty
                <p class="text-center text-gray-400 py-4">Belum ada pengumuman.</p>
            @endforelse
        </div>
    </div>
</x-admin-layout>