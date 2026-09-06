<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kegiatan — Ponpes At-Thabraniah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.public-nav')
    <header class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-14 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Kegiatan</h1>
            <p class="text-emerald-100">Seluruh Kegiatan Dan Informasi Terbaru</p>
        </div>
    </header>
    <div class="max-w-6xl mx-auto px-4 py-12">
        @if ($kegiatan->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($kegiatan as $k)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                        <a href="{{ route('kegiatan.show', $k) }}">
                            @if ($k->gambar)
                                <img class="rounded-t-lg h-52 w-full object-cover" src="{{ asset('storage/' . $k->gambar) }}" alt="{{ $k->judul }}" />
                            @else
                                <div class="rounded-t-lg h-52 w-full bg-emerald-100"></div>
                            @endif
                        </a>
                        <div class="p-5">
                            <p class="text-xs text-gray-400 mb-1">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</p>
                            <a href="{{ route('kegiatan.show', $k) }}"><h5 class="mb-2 text-lg font-bold text-gray-900">{{ $k->judul }}</h5></a>
                            <p class="mb-3 text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($k->deskripsi, 100) }}</p>
                            <a href="{{ route('kegiatan.show', $k) }}" class="inline-block px-3 py-2 text-sm font-medium text-white bg-emerald-700 rounded-lg hover:bg-emerald-800">Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400">Belum ada kegiatan.</p>
        @endif
    </div>
    @include('partials.footer') 
</body>
</html>