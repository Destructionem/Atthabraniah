<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $gelombang->exists ? 'Edit' : 'Tambah' }} Gelombang</h2></x-slot>
    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.gelombang.index') }}" class="text-emerald-700 hover:underline text-sm">&larr; Kembali</a>
        @if ($errors->any())<div class="my-4 bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <form method="POST" action="{{ $gelombang->exists ? route('admin.gelombang.update', $gelombang) : route('admin.gelombang.store') }}" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 space-y-4 mt-4">
            @csrf
            @if ($gelombang->exists) @method('PUT') @endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Gelombang *</label>
                <input type="text" name="nama" value="{{ old('nama', $gelombang->nama) }}" placeholder="mis. Gelombang 1" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Buka *</label>
                    <input type="date" name="tanggal_buka" value="{{ old('tanggal_buka', $gelombang->tanggal_buka) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Tutup *</label>
                    <input type="date" name="tanggal_tutup" value="{{ old('tanggal_tutup', $gelombang->tanggal_tutup) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Biaya Pendaftaran (Rp) *</label>
                    <input type="number" name="biaya_pendaftaran" value="{{ old('biaya_pendaftaran', $gelombang->biaya_pendaftaran) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kuota *</label>
                    <input type="number" name="kuota" value="{{ old('kuota', $gelombang->kuota) }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            </div>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_aktif" value="1" @checked(old('is_aktif', $gelombang->is_aktif)) class="rounded border-gray-300 text-emerald-600">
                <span class="text-sm text-gray-700">Jadikan gelombang aktif (hanya boleh satu yang aktif)</span>
            </label>
            <div class="flex justify-end"><button class="bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button></div>
        </form>
    </div>
</x-admin-layout>