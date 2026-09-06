<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri — Ponpes At-Thabraniah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.public-nav')
    <header class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-14 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Galeri</h1>
            <p class="text-emerald-100">Dokumentasi Kegiatan Santri</p>
        </div>
    </header>
    <div class="max-w-6xl mx-auto px-4 py-12">
        @if ($galeri->count())
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($galeri as $g)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                        <img class="h-52 w-full object-cover" src="{{ asset('storage/' . $g->gambar) }}" alt="{{ $g->judul }}" />
                        <div class="p-3">
                            <p class="text-sm text-gray-600 truncate">{{ $g->judul ?: 'Dokumentasi kegiatan' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400">Belum ada foto di galeri.</p>
        @endif
    </div>
    @include('partials.footer')
</body>
</html>