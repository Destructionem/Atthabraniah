<x-app-layout>
    @if (auth()->user()->role === 'admin')
        <script>window.location = "{{ route('admin.index') }}";</script>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl">{{ session('success') }}</div>
            @endif

            @php
                $pendaftaran = \App\Models\Pendaftaran::where('user_id', auth()->id())->latest()->first();
                $pengumuman = \App\Models\Pengumuman::latest()->take(3)->get();
            @endphp

            {{-- Sambutan --}}
            <div class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white rounded-2xl p-6">
                <p class="text-emerald-100 text-sm">Assalamu'alaikum,</p>
                <h3 class="text-2xl font-bold">{{ auth()->user()->name }}</h3>
                <p class="text-emerald-100 text-sm mt-1">Selamat datang di portal Penerimaan Santri Baru.</p>
            </div>

            @if ($pengumuman->count())
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Pengumuman
                    </h4>
                    <div class="space-y-3">
                        @foreach ($pengumuman as $pg)
                            <div class="border-l-4 border-emerald-500 pl-3">
                                <p class="font-medium text-gray-800">{{ $pg->judul }}</p>
                                <p class="text-sm text-gray-600">{{ $pg->isi }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $pg->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (! $pendaftaran)
                {{-- Belum mendaftar --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8 text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
                    </div>
                    <h4 class="font-semibold text-gray-800 text-lg mb-2">Belum Mendaftar</h4>
                    <p class="text-gray-500 mb-5">Silakan lengkapi formulir pendaftaran santri baru untuk memulai.</p>
                    <a href="{{ route('pendaftaran.create') }}" class="inline-block bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Isi Formulir Pendaftaran</a>
                </div>
            @else
                {{-- Kartu info ringkas (tiles) --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">No. Pendaftaran</p>
                        <p class="font-bold text-gray-800 font-mono text-sm break-all">{{ $pendaftaran->no_pendaftaran }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Gelombang</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->gelombang?->nama ?? '-' }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <p class="text-xs text-gray-400 mb-1">Biaya Pendaftaran</p>
                        <p class="font-bold text-gray-800">Rp {{ number_format($pendaftaran->gelombang?->biaya_pendaftaran ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                        <p class="text-xs text-gray-400 mb-2">Status</p>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                            @if($pendaftaran->status==='lunas') bg-emerald-100 text-emerald-800
                            @elseif($pendaftaran->status==='diterima') bg-blue-100 text-blue-800
                            @elseif($pendaftaran->status==='ditolak') bg-red-100 text-red-800
                            @else bg-amber-100 text-amber-800 @endif">
                            {{ ucwords(str_replace('_', ' ', $pendaftaran->status)) }}
                        </span>
                    </div>
                </div>

                {{-- Kartu aksi / langkah berikutnya --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
                    @if ($pendaftaran->status === 'menunggu_pembayaran')
                        <h4 class="font-semibold text-gray-800 mb-1">Selesaikan Pembayaran</h4>
                        <p class="text-gray-500 text-sm mb-4">Pendaftaran tersimpan. Silakan selesaikan pembayaran biaya pendaftaran untuk melanjutkan.</p>
                        <a href="{{ route('pembayaran.bayar', $pendaftaran) }}" class="inline-block bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Bayar Sekarang</a>
                    @elseif ($pendaftaran->status === 'lunas')
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-lg text-sm">Pembayaran lunas. Berkas Anda sedang menunggu verifikasi dari admin pesantren.</div>
                    @elseif ($pendaftaran->status === 'diterima')
                        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-lg text-sm">Selamat! Pendaftaran Anda telah <b>diterima</b>. Silakan menunggu informasi selanjutnya dari pesantren.</div>
                    @elseif ($pendaftaran->status === 'ditolak')
                        <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-lg text-sm mb-4">
                            Mohon maaf, pendaftaran Anda belum dapat diterima. Anda dapat memperbaiki dan mengunggah ulang berkas di bawah ini, lalu kirim kembali untuk diverifikasi.
                        </div>
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm mb-3"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
                        @endif
                        <form method="POST" action="{{ route('pendaftaran.uploadUlang') }}" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            <p class="text-xs text-gray-500">Unggah hanya berkas yang perlu diperbaiki (boleh sebagian). Format JPG/PNG/PDF, maks 4 MB.</p>
                            <div><label class="block text-sm text-gray-700">Kartu Keluarga (KK)</label><input type="file" name="kk" class="mt-1 w-full text-sm"></div>
                            <div><label class="block text-sm text-gray-700">Akta Kelahiran</label><input type="file" name="akta" class="mt-1 w-full text-sm"></div>
                            <div><label class="block text-sm text-gray-700">Ijazah</label><input type="file" name="ijazah" class="mt-1 w-full text-sm"></div>
                            <div><label class="block text-sm text-gray-700">Pas Foto</label><input type="file" name="foto" class="mt-1 w-full text-sm"></div>
                            <button class="bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Unggah Ulang &amp; Kirim Lagi</button>
                        </form>
                    @endif

                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('bukti.cetak', $pendaftaran) }}" target="_blank" class="inline-block text-emerald-700 border border-emerald-600 hover:bg-emerald-50 font-semibold px-5 py-2 rounded-lg text-sm">Cetak Bukti Pendaftaran (PDF)</a>
                    </div>
                </div>

                {{-- Riwayat status (timeline) --}}
                @if ($pendaftaran->riwayat->count())
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
                        <h4 class="font-semibold text-gray-800 mb-4">Riwayat Status</h4>
                        @foreach ($pendaftaran->riwayat as $r)
                            @php
                                $map = [
                                    'menunggu_pembayaran' => ['Menunggu Pembayaran', 'bg-amber-500'],
                                    'lunas'    => ['Pembayaran Lunas', 'bg-emerald-500'],
                                    'diterima' => ['Diterima', 'bg-blue-500'],
                                    'ditolak'  => ['Ditolak', 'bg-red-500'],
                                ];
                                $info = $map[$r->status] ?? [ucwords(str_replace('_', ' ', $r->status)), 'bg-gray-400'];
                            @endphp
                            <div class="flex gap-3">
                                <div class="flex flex-col items-center">
                                    <span class="w-3 h-3 rounded-full {{ $info[1] }} mt-1.5"></span>
                                    @if (! $loop->last)<span class="w-px flex-1 bg-gray-200"></span>@endif
                                </div>
                                <div class="pb-5">
                                    <p class="font-medium text-gray-800 text-sm">{{ $info[0] }}</p>
                                    <p class="text-xs text-gray-400">{{ $r->created_at->translatedFormat('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>