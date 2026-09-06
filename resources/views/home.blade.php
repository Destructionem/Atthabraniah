<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>At-Thabraniah Paseban</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">
    {{-- ===== NAVBAR ===== --}}
    
    @include('partials.public-nav')

    {{-- ===== HERO  ===== --}}
    <section id="beranda" class="relative min-h-[calc(100vh-4rem)] flex items-center overflow-hidden bg-emerald-900 text-white">
        {{-- Foto latar (jika ada) --}}
        @if ($pengaturan->hero_image)
            <img src="{{ asset('storage/' . $pengaturan->hero_image) }}" alt="Pondok Pesantren At-Thabraniah" class="absolute inset-0 w-full h-full object-cover">
        @endif
        {{-- Lapisan gelap agar teks terbaca --}}
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-900/70 to-emerald-900/40"></div>

        <div class="relative max-w-6xl mx-auto px-4 py-24 w-full">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-4xl font-bold mb-4 leading-tight">Selamat Datang Di Website</h1>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Pondok Pesantren</h1>
                <h1 class="text-4xl md:text-6xl font-bold mb-4 text-amber-300">At-Thabraniah Paseban</h1>
                <p class="text-emerald-100 text-lg mb-8">Membentuk generasi Qur'ani yang berakhlak mulia, berilmu, dan mandiri.</p>
                <span class="inline-block bg-white/10 border border-white/20 text-amber-300 text-sm font-medium px-4 py-1.5 rounded-full mb-6">Penerimaan Santri Baru Tahun Ajaran 2026-2027 Telah Dibuka</span>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('register') }}" class="bg-emerald-600 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-emerald-500 transition text-center">Daftar Santri Baru</a>
                    <a href="{{ route('profil.index') }}" class="bg-white/10 border border-white/30 text-white font-semibold px-8 py-3.5 rounded-xl hover:bg-white/20 transition text-center">Tentang Kami</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PROFIL ===== --}}
    <section id="profil" class="scroll-mt-16 py-20 bg-emerald-50" style="background-image: radial-gradient(rgba(5,150,105,0.07) 1px, transparent 1px); background-size: 22px 22px;">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Profil Pesantren</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-4"></div>
            </div>
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-bold text-emerald-700 mb-3">Sejarah</h3>
                    <p class="text-gray-600 leading-relaxed">Pondok Pesantren At-Thabraniah didirikan untuk menyelenggarakan pendidikan Islam yang memadukan ilmu agama dan ilmu umum, serta membina santri menjadi pribadi yang berakhlak dan berilmu.</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-bold text-emerald-700 mb-3">Visi</h3>
                    <p class="text-gray-600 leading-relaxed">Menjadi lembaga pendidikan Islam yang unggul dalam membentuk generasi Qur'ani.</p>
                </div>
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                    <h3 class="text-xl font-bold text-emerald-700 mb-3">Misi</h3>
                    <ul class="list-disc list-inside text-gray-600 space-y-1">
                        <li>Pendidikan berbasis Al-Qur'an dan Sunnah.</li>
                        <li>Membina akhlak dan kemandirian santri.</li>
                        <li>Mengembangkan potensi akademik.</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('profil.index') }}" class="inline-block bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Selengkapnya tentang Kami</a>
            </div>
        </div>
    </section>

    {{-- ===== FASILITAS ===== --}}
    <section id="fasilitas" class="scroll-mt-16 py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Sarana</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Fasilitas</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-4"></div>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($fasilitas as $f)
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
                        @if ($f->gambar)
                            <img src="{{ asset('storage/' . $f->gambar) }}" alt="{{ $f->nama }}" class="h-52 w-full object-cover">
                        @else
                            <div class="h-52 w-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-4xl">&#10003;</div>
                        @endif
                        <div class="p-5">
                            <h3 class="font-semibold text-gray-800 text-lg">{{ $f->nama }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $f->keterangan ?: 'Fasilitas penunjang kegiatan santri.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-400">Fasilitas belum ditambahkan.</p>
                @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('fasilitas.index') }}" class="inline-block bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Lihat Semua Fasilitas</a>
            </div>
        </div>
    </section>


    {{-- ===== GALERI (marquee berjalan) ===== --}}
    <section id="galeri" class="scroll-mt-16 py-20 bg-emerald-50" style="background-image: radial-gradient(rgba(5,150,105,0.07) 1px, transparent 1px); background-size: 22px 22px;">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Dokumentasi</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Galeri</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-4"></div>
            </div>

            @if (isset($galeri) && $galeri->count())
                {{-- Wadah marquee: overflow disembunyikan, fade di tepi kiri/kanan --}}
                <div class="marquee-wrap">
                    <div class="marquee-track">
                        {{-- Daftar foto ditampilkan DUA KALI agar perputaran menyambung mulus --}}
                        @foreach ($galeri as $g)
                            <div class="marquee-item">
                                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                                    <img src="{{ asset('storage/' . $g->gambar) }}" alt="{{ $g->judul ?: 'Dokumentasi kegiatan' }}" class="h-56 w-full object-cover">
                                    <div class="p-3"><p class="text-sm text-gray-600 truncate">{{ $g->judul ?: 'Dokumentasi kegiatan' }}</p></div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($galeri as $g)
                            <div class="marquee-item" aria-hidden="true">
                                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                                    <img src="{{ asset('storage/' . $g->gambar) }}" alt="" class="h-56 w-full object-cover">
                                    <div class="p-3"><p class="text-sm text-gray-600 truncate">{{ $g->judul ?: 'Dokumentasi kegiatan' }}</p></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-gray-400">Belum ada foto di galeri.</p>
            @endif

            <div class="text-center mt-10">
                <a href="{{ route('galeri.index') }}" class="inline-block bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Lihat Semua Foto</a>
            </div>
        </div>
    </section>

    {{-- ===== KEGIATAN ===== --}}
    <section id="kegiatan" class="scroll-mt-16 py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Informasi</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Kegiatan Terbaru</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-4"></div>
            </div>
            @if (isset($kegiatan) && $kegiatan->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($kegiatan as $k)
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden">
                            <a href="{{ route('kegiatan.show', $k) }}">
                                @if ($k->gambar)
                                    <img src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}" class="h-52 w-full object-cover">
                                @else
                                    <div class="h-52 w-full bg-emerald-100"></div>
                                @endif
                            </a>
                            <div class="p-5">
                                <p class="text-xs text-gray-400 mb-1">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</p>
                                <a href="{{ route('kegiatan.show', $k) }}"><h3 class="font-semibold text-gray-800 text-lg mb-1">{{ $k->judul }}</h3></a>
                                <p class="text-sm text-gray-500 mb-3">{{ \Illuminate\Support\Str::limit($k->deskripsi, 80) }}</p>
                                <a href="{{ route('kegiatan.show', $k) }}" class="text-emerald-700 font-medium text-sm hover:underline">Selengkapnya &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-400">Belum ada kegiatan.</p>
            @endif
            <div class="text-center mt-10">
                <a href="{{ route('kegiatan.index') }}" class="inline-block bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Lihat Semua Kegiatan</a>
            </div>
        </div>
    </section>

    {{-- ===== KONTAK ===== --}}
    <section id="kontak" class="scroll-mt-16 py-20 bg-emerald-50" style="background-image: radial-gradient(rgba(5,150,105,0.07) 1px, transparent 1px); background-size: 22px 22px;">
        <div class="text-center mb-12">
                <span class="text-emerald-600 font-semibold text-sm uppercase tracking-wider">Lokasi & Kontak</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2">Hubungi Kami</h2>
                <div class="w-16 h-1 bg-emerald-500 rounded-full mx-auto mt-4"></div>

            <div class="grid lg:grid-cols-2 gap-8 items-stretch">
                {{-- Kiri: Peta lokasi --}}
                <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-200 min-h-[420px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d350.5962482556931!2d106.85161468581882!3d-6.191747250880457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5e6ddb53b8d%3A0xcc77ba48adcf686b!2sPondok%20Pesantren%20At%20Thabraniyah%20-%20Paseban!5e0!3m2!1sid!2sid!4v1780629645936!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                {{-- Kanan: Ajakan daftar (CTA) --}}
                <div class="bg-emerald-700 text-white rounded-2xl p-8 flex flex-col justify-center min-h-[420px]">
                    <h3 class="text-2xl font-bold mb-2">Siap Bergabung?</h3>
                    <p class="text-emerald-100 mb-6">Daftarkan putra/putri Anda sebagai santri baru sekarang juga.</p>
                    <a href="{{ route('register') }}" class="bg-white text-emerald-800 font-semibold text-center px-6 py-3 rounded-lg hover:bg-emerald-50">
                        Daftar Sekarang
                    </a>
                    <p class="text-emerald-200 text-sm mt-4">
                        Atau hubungi kami di <a href="https://wa.me/6281770066435" target="_blank" class="underline hover:text-white">WhatsApp</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
@endpush

    <style>
        .marquee-wrap {
            overflow: hidden;
            position: relative;
            /* efek pudar di tepi kiri & kanan */
            -webkit-mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent);
                    mask-image: linear-gradient(to right, transparent, #000 6%, #000 94%, transparent);
        }
        .marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 35s linear infinite;
        }
        .marquee-wrap:hover .marquee-track {
            animation-play-state: paused; /* berhenti saat disorot kursor */
        }
        .marquee-item {
            flex: 0 0 auto;
            width: 300px;
            padding: 0 8px;
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); } /* geser setengah = panjang 1 set foto */
        }
        @media (max-width: 640px) {
            .marquee-item { width: 240px; }
        }
    </style>
    
    {{-- ===== FOOTER ===== --}}
    @include('partials.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>