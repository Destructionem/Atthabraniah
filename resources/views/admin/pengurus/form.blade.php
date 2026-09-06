<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $pengurus->exists ? 'Edit' : 'Tambah' }} Pengurus / Ustadz</h2></x-slot>
    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.pengurus.index') }}" class="text-emerald-700 hover:underline text-sm">&larr; Kembali</a>
        @if ($errors->any())<div class="my-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <form method="POST" action="{{ $pengurus->exists ? route('admin.pengurus.update', $pengurus) : route('admin.pengurus.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm space-y-4 mt-4">
            @csrf
            @if ($pengurus->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama *</label>
                <input type="text" name="nama" value="{{ old('nama', $pengurus->nama) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jabatan *</label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $pengurus->jabatan) }}" placeholder="mis. Kepala Pesantren / Guru Tahfidz" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                <select name="tipe" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="pengurus" @selected(old('tipe', $pengurus->tipe) === 'pengurus')>Pengurus</option>
                    <option value="pengajar" @selected(old('tipe', $pengurus->tipe) === 'pengajar')>Ustadz / Pengajar</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto (opsional)</label>
                <input type="file" name="foto" class="mt-1 w-full text-sm">
                @if ($pengurus->exists && $pengurus->foto)<img src="{{ asset('storage/' . $pengurus->foto) }}" class="mt-2 h-20 w-20 rounded-full object-cover">@endif
            </div>
            <div class="flex justify-end"><button class="bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button></div>
        </form>
    </div>
</x-admin-layout>