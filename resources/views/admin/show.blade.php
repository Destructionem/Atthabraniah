<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Pendaftar</h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <a href="{{ route('admin.index') }}" class="text-emerald-700 hover:underline text-sm">&larr; Kembali ke daftar</a>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm text-gray-500">No. Pendaftaran</p>
                    <p class="font-semibold">{{ $pendaftaran->no_pendaftaran }}</p>
                </div>
                <span class="px-3 py-1 rounded text-sm font-semibold
                    @if($pendaftaran->status==='lunas') bg-emerald-100 text-emerald-800
                    @elseif($pendaftaran->status==='diterima') bg-blue-100 text-blue-800
                    @elseif($pendaftaran->status==='ditolak') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ str_replace('_', ' ', $pendaftaran->status) }}
                </span>
            </div>

            <h3 class="font-semibold text-gray-800 mt-4 mb-2">Data Calon Santri</h3>
            <div class="grid sm:grid-cols-2 gap-2 text-sm text-gray-700">
                <p>Nama: <b>{{ $pendaftaran->calonSantri->nama_lengkap ?? '-' }}</b></p>
                <p>NIK: {{ $pendaftaran->calonSantri->nik ?? '-' }}</p>
                <p>Jenis Kelamin: {{ $pendaftaran->calonSantri->jenis_kelamin ?? '-' }}</p>
                <p>TTL: {{ $pendaftaran->calonSantri->tempat_lahir ?? '-' }}, {{ $pendaftaran->calonSantri->tanggal_lahir ?? '-' }}</p>
                <p>Asal Sekolah: {{ $pendaftaran->calonSantri->asal_sekolah ?? '-' }}</p>
                <p class="sm:col-span-2">Alamat: {{ $pendaftaran->calonSantri->alamat ?? '-' }}</p>
            </div>

            <h3 class="font-semibold text-gray-800 mt-4 mb-2">Data Orang Tua</h3>
            <div class="grid sm:grid-cols-2 gap-2 text-sm text-gray-700">
                <p>Ayah: {{ $pendaftaran->orangTua->nama_ayah ?? '-' }} ({{ $pendaftaran->orangTua->pekerjaan_ayah ?? '-' }})</p>
                <p>Ibu: {{ $pendaftaran->orangTua->nama_ibu ?? '-' }} ({{ $pendaftaran->orangTua->pekerjaan_ibu ?? '-' }})</p>
                <p>No. HP: {{ $pendaftaran->orangTua->no_hp ?? '-' }}</p>
            </div>

            @if (session('reset_password'))
            <div class="mb-4 bg-amber-50 border border-amber-200 text-amber-800 p-3 rounded-lg text-sm">
                {{ session('reset_password') }}<br>
                <span class="text-xs">Sampaikan password ini kepada wali, dan minta segera menggantinya setelah login (menu Profil).</span>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.user.resetPassword', $pendaftaran->user) }}" onsubmit="return confirm('Reset password akun wali ini?')" class="mt-3">
                @csrf
                <button class="text-amber-700 border border-amber-400 hover:bg-amber-50 px-4 py-2 rounded-lg text-sm font-medium">Reset Password Akun Wali</button>
            </form>

            <h3 class="font-semibold text-gray-800 mt-4 mb-2">Berkas</h3>
            <div class="flex flex-wrap gap-3 text-sm">
                @foreach ($pendaftaran->berkas as $b)
                    <a href="{{ asset('storage/' . $b->path) }}" target="_blank"
                       class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Lihat {{ strtoupper($b->jenis) }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Verifikasi: hanya jika sudah lunas --}}
        @if ($pendaftaran->status === 'lunas')
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-3">Verifikasi Pendaftar</h3>
                <p class="text-sm text-gray-500 mb-4">Setelah memeriksa berkas, tentukan keputusan:</p>
                <div class="flex gap-3">
                    <form method="POST" action="{{ route('admin.updateStatus', $pendaftaran) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="diterima">
                        <button class="bg-emerald-700 text-white font-semibold px-5 py-2 rounded-lg hover:bg-emerald-800">Terima Santri</button>
                    </form>
                    <form method="POST" action="{{ route('admin.updateStatus', $pendaftaran) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <button class="bg-red-600 text-white font-semibold px-5 py-2 rounded-lg hover:bg-red-700">Tolak</button>
                    </form>
                </div>
            </div>
        @elseif (in_array($pendaftaran->status, ['diterima', 'ditolak']))
            <div class="bg-gray-50 border p-4 rounded-lg text-sm text-gray-600">
                Pendaftar ini sudah <b>{{ $pendaftaran->status }}</b>.
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg text-sm text-yellow-800">
                Pendaftar belum melunasi pembayaran, verifikasi belum bisa dilakukan.
            </div>
        @endif
    </div>
</x-admin-layout>