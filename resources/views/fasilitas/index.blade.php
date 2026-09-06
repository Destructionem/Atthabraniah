<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fasilitas — Ponpes At-Thabraniah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    @include('partials.public-nav')
    <header class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-14 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Fasilitas Pesantren</h1>
            <p class="text-emerald-100">Seluruh fasilitas penunjang kegiatan santri</p>
        </div>
    </header>
    <div class="max-w-6xl mx-auto px-4 py-12">
        @if ($fasilitas->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($fasilitas as $f)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition">
                        @if ($f->gambar)
                            <img class="rounded-t-lg h-52 w-full object-cover" src="{{ asset('storage/' . $f->gambar) }}" alt="{{ $f->nama }}" />
                        @else
                            <div class="rounded-t-lg h-52 w-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-4xl">&#10003;</div>
                        @endif
                        <div class="p-5">
                            <h5 class="mb-2 text-xl font-bold text-gray-900">{{ $f->nama }}</h5>
                            <p class="text-sm text-gray-500">{{ $f->keterangan ?: 'Fasilitas penunjang kegiatan santri.' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-400">Belum ada fasilitas.</p>
        @endif
    </div>
    @include('partials.footer')
</body>
</html>