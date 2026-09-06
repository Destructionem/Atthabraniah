<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Kelola Galeri</h2></x-slot>
    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))<div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>@endif

        {{-- Form upload --}}
        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm space-y-4">
            @csrf
            @if ($errors->any())<div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul/Caption (opsional)</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto * (maks 2 MB)</label>
                <input type="file" name="gambar" class="mt-1 w-full text-sm" required>
            </div>
            <div class="flex justify-end"><button class="bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-emerald-800">Tambah Foto</button></div>
        </form>

        {{-- Grid foto --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($galeri as $g)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <img src="{{ asset('storage/' . $g->gambar) }}" class="h-32 w-full object-cover">
                    <div class="p-2 flex justify-between items-center">
                        <span class="text-xs text-gray-600 truncate">{{ $g->judul ?? '—' }}</span>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $g) }}" onsubmit="return confirm('Hapus foto ini?')">@csrf @method('DELETE')<button class="text-red-600 text-xs hover:underline">Hapus</button></form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 py-6">Belum ada foto di galeri.</p>
            @endforelse
        </div>
    </div>
</x-admin-layout>