<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}?v=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Ponpes At-Thabraniah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @php
        $items = [
            ['Dashboard', 'admin.index', 'admin.index'],
            ['Pengumuman', 'admin.pengumuman.index', 'admin.pengumuman.*'],
            ['Gelombang', 'admin.gelombang.index', 'admin.gelombang.*'],
            ['Kegiatan', 'admin.kegiatan.index', 'admin.kegiatan.*'],
            ['Fasilitas', 'admin.fasilitas.index', 'admin.fasilitas.*'],
            ['Galeri', 'admin.galeri.index', 'admin.galeri.*'],
            ['Pengurus', 'admin.pengurus.index', 'admin.pengurus.*'],
            ['Pengaturan', 'admin.pengaturan.edit', 'admin.pengaturan.*'],
        ];
    @endphp

    {{-- Sidebar --}}
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-emerald-900 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-200">
        <div class="h-16 flex items-center gap-2 px-5 border-b border-emerald-800">
            <x-application-logo class="h-9 w-9" />
            <div class="leading-tight">
                <p class="font-bold">At-Thabraniah</p>
                <p class="text-[11px] text-emerald-300">Panel Admin</p>
            </div>
        </div>
        <nav class="p-4 space-y-1">
            @foreach ($items as $it)
                <a href="{{ route($it[1]) }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs($it[2]) ? 'bg-emerald-600 text-white' : 'text-emerald-100 hover:bg-emerald-800' }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-current opacity-70"></span>
                    {{ $it[0] }}
                </a>
            @endforeach
        </nav>
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-emerald-800 space-y-1">
            <a href="/" class="block px-4 py-2 text-sm text-emerald-100 hover:bg-emerald-800 rounded-lg">Lihat Website</a>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button class="w-full text-left px-4 py-2 text-sm text-emerald-100 hover:bg-emerald-800 rounded-lg">Keluar</button>
            </form>
        </div>
    </aside>

    {{-- Overlay (mobile) --}}
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 z-30 hidden md:hidden"></div>

    {{-- Konten utama --}}
    <div class="md:ml-64 flex flex-col min-h-screen">
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-gray-600 text-2xl leading-none">&#9776;</button>
                <div class="font-semibold text-gray-800">@isset($header){{ $header }}@else Dashboard @endisset</div>
            </div>
            <div class="text-sm text-gray-500">{{ auth()->user()->name }}</div>
        </header>
        <main class="flex-1 p-4 sm:p-6">
            {{ $slot }}
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('overlay').classList.toggle('hidden');
        }
    </script>
</body>
</html>