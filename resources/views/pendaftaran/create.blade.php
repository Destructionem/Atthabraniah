<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Formulir Pendaftaran Santri Baru</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (! $gelombang)
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg">
                    Saat ini belum ada gelombang pendaftaran yang dibuka.
                </div>
            @elseif ($sudahDaftar)
                <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-lg">
                    Anda sudah melakukan pendaftaran. Cek status di
                    <a href="{{ route('dashboard') }}" class="underline font-semibold">Dashboard</a>.
                </div>
            @else
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-lg mb-6">
                    <p class="font-semibold">{{ $gelombang->nama }}</p>
                    <p class="text-sm">Biaya pendaftaran: Rp {{ number_format($gelombang->biaya_pendaftaran, 0, ',', '.') }}</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6">
                        <p class="font-semibold mb-1">Ada isian yang belum benar:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Data Calon Santri</h3>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIK</label>
                                <input type="text" name="nik" value="{{ old('nik') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin *</label>
                                <select name="jenis_kelamin" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">- Pilih -</option>
                                    <option value="L" @selected(old('jenis_kelamin')=='L')>Laki-laki</option>
                                    <option value="P" @selected(old('jenis_kelamin')=='P')>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tempat Lahir *</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="alamat" rows="2" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">Data Orang Tua / Wali</h3>
                        <p class="text-sm text-gray-500 mb-4">Data ayah/ibu boleh dikosongkan salah satu, tetapi No. HP wajib diisi.</p>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                                <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                                <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. HP Aktif *</label>
                                <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="mt-1 w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Alamat Orang Tua</label>
                                <textarea name="alamat_ortu" rows="2" class="mt-1 w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat_ortu') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="font-semibold text-lg text-gray-800 mb-1">Upload Berkas</h3>
                        <p class="text-sm text-gray-500 mb-4">Format JPG/PNG/PDF, maksimal 2 MB per file (pas foto: JPG/PNG saja).</p>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kartu Keluarga (KK) *</label>
                                <input type="file" name="kk" class="mt-1 w-full text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Akta Kelahiran *</label>
                                <input type="file" name="akta" class="mt-1 w-full text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ijazah *</label>
                                <input type="file" name="ijazah" class="mt-1 w-full text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pas Foto *</label>
                                <input type="file" name="foto" class="mt-1 w-full text-sm" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-emerald-700 text-white font-semibold px-6 py-3 rounded-lg hover:bg-emerald-800">Kirim Pendaftaran</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>