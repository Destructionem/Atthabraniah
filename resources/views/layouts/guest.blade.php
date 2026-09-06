<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head >
        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login — Ponpes At-Thabraniah</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @php $pengaturanLogin = \App\Models\Pengaturan::get(); @endphp
        <div class="min-h-screen relative flex flex-col justify-center items-center py-10 px-4 bg-emerald-900">
            {{-- Foto latar (pakai foto hero dari Pengaturan) --}}
            @if ($pengaturanLogin->hero_image)
                <img src="{{ asset('storage/' . $pengaturanLogin->hero_image) }}" alt="Pondok Pesantren At-Thabraniah" class="absolute inset-0 w-full h-full object-cover">
            @endif
            {{-- Lapisan gelap agar kartu & teks terbaca --}}
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/90 to-emerald-900/70"></div>

            <div class="relative w-full sm:max-w-md">
                {{-- Logo + nama di atas kartu --}}
                <a href="/" class="flex flex-col items-center mb-5">
                    <x-application-logo class="h-16 w-16" />
                    <span class="mt-2 text-xl font-bold text-emerald-200">Pondok Pesantren At-Thabraniah Paseban</span>
                    <!-- <span class="text-xs text-emerald-200">Penerimaan Santri Baru</span> -->
                </a>
                {{-- Kartu form --}}
                <div class="bg-white shadow-2xl overflow-hidden rounded-2xl">
                    <div class="h-1.5 bg-emerald-600"></div>
                    <div class="px-6 py-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
