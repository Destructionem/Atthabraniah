<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $fasilitas->exists ? 'Edit' : 'Tambah' }} Fasilitas</h2></x-slot>
    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.fasilitas.index') }}" class="text-emerald-700 hover:underline text-sm">&larr; Kembali</a>
        @if ($errors->any())<div class="my-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <form method="POST" action="{{ $fasilitas->exists ? route('admin.fasilitas.update', $fasilitas) : route('admin.fasilitas.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm space-y-4 mt-4">
            @csrf
            @if ($fasilitas->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Fasilitas *</label>
                <input type="text" name="nama" value="{{ old('nama', $fasilitas->nama) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" value="{{ old('keterangan', $fasilitas->keterangan) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar Fasilitas (opsional, maks 2 MB)</label>
                <input type="file" name="gambar" class="mt-1 w-full text-sm">
                @if ($fasilitas->exists && $fasilitas->gambar)
                    <img src="{{ asset('storage/' . $fasilitas->gambar) }}" class="mt-2 h-24 rounded-lg object-cover">
                @endif
            </div>
            
            <div class="flex justify-end"><button class="bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button></div>
        </>
    </div>
</x-admin-layout>