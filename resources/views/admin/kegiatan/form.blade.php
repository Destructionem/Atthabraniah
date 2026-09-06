<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $kegiatan->exists ? 'Edit' : 'Tambah' }} Kegiatan</h2></x-slot>
    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.kegiatan.index') }}" class="text-emerald-700 hover:underline text-sm">&larr; Kembali</a>

        @if ($errors->any())
            <div class="my-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm">
                <ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $kegiatan->exists ? route('admin.kegiatan.update', $kegiatan) : route('admin.kegiatan.store') }}"
              enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm space-y-4 mt-4">
            @csrf
            @if ($kegiatan->exists) @method('PUT') @endif

            <div>
                <label class="block text-sm font-medium text-gray-700">Judul Kegiatan *</label>
                <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi *</label>
                <textarea name="deskripsi" rows="5" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar (opsional, maks 2 MB)</label>
                <input type="file" name="gambar" class="mt-1 w-full text-sm">
                @if ($kegiatan->exists && $kegiatan->gambar)
                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="mt-2 h-24 rounded-lg">
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Link Video YouTube (opsional)</label>
                <input type="url" name="video_url" value="{{ old('video_url', $kegiatan->video_url) }}" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="flex justify-end">
                <button class="bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button>
            </div>
        </form>
    </div>
</x-admin-layout>