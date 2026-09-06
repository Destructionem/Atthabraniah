<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-9 w-9 object-contain">
            <span class="font-bold text-emerald-700 text-lg">At-Thabraniah Paseban</span>
        </a>

            {{-- Menu desktop --}}
            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="/" class="hover:text-emerald-700">Beranda</a>
                <a href="/#profil" class="hover:text-emerald-700">Profil</a>
                <a href="/#fasilitas" class="hover:text-emerald-700">Fasilitas</a>
                <a href="/#galeri" class="hover:text-emerald-700">Galeri</a>
                <a href="/#kegiatan" class="hover:text-emerald-700">Kegiatan</a>
                <a href="/#kontak" class="hover:text-emerald-700">Kontak</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-emerald-700 text-white px-4 py-2 rounded-lg hover:bg-emerald-800">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-emerald-700 text-white px-4 py-2 rounded-lg hover:bg-emerald-800">Masuk</a>
                @endauth
            </div>

            {{-- Tombol hamburger (HP) --}}
            <button onclick="document.getElementById('menuHp').classList.toggle('hidden')"
                    class="md:hidden text-3xl text-emerald-700 leading-none" aria-label="Menu">&#9776;</button>
        </div>

        {{-- Menu HP --}}
        <div id="menuHp" class="hidden md:hidden pb-4 space-y-1 text-sm font-medium text-gray-600">
            <a href="/" class="block py-1 hover:text-emerald-700">Beranda</a>
            <a href="/#profil" class="block py-1 hover:text-emerald-700">Profil</a>
            <a href="/#fasilitas" class="block py-1 hover:text-emerald-700">Fasilitas</a>
            <a href="/#galeri" class="block py-1 hover:text-emerald-700">Galeri</a>
            <a href="/#kegiatan" class="block py-1 hover:text-emerald-700">Kegiatan</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block py-1 text-emerald-700 font-semibold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="block py-1 text-emerald-700 font-semibold">Masuk</a>
            @endauth
        </div>
    </div>
</nav>