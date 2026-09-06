<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kegiatan->judul }} — Ponpes At-Thabraniah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-3xl mx-auto px-4 py-10">
        <a href="/#kegiatan" class="text-emerald-700 hover:underline text-sm">&larr; Kembali ke beranda</a>
        <h1 class="text-3xl font-bold mt-4 mb-1">{{ $kegiatan->judul }}</h1>
        <p class="text-gray-500 text-sm mb-6">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</p>
        @if ($kegiatan->gambar)
            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="w-full rounded-xl mb-6">
        @endif
        <div class="text-gray-700 leading-relaxed whitespace-pre-line mb-6">{{ $kegiatan->deskripsi }}</div>
        @if ($kegiatan->embed_url)
            <div class="aspect-video mb-6">
                <iframe class="w-full h-full rounded-xl" src="{{ $kegiatan->embed_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif
    </div>
</body>
</html>