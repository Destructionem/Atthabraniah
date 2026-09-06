<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Pengaturan Tampilan</h2></x-slot>
    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))<div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-3 rounded-lg">{{ session('success') }}</div>@endif
        <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm space-y-4 mt-4">
            @csrf
            @if ($errors->any())<div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Latar Hero (Beranda)</label>
                <p class="text-xs text-gray-500 mb-2">Disarankan foto melebar (landscape) gedung/kegiatan pesantren.</p>
                <input type="file" name="hero_image" class="mt-1 w-full text-sm">
                @if ($pengaturan->hero_image)
                    <img src="{{ asset('storage/' . $pengaturan->hero_image) }}" class="mt-3 rounded-lg h-40 w-full object-cover">
                @else
                    <p class="mt-2 text-xs text-gray-400">Belum ada foto. Hero akan memakai latar hijau.</p>
                @endif
            </div>
            <div class="flex justify-end"><button class="bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button></div>
        </form>
    </div>
</x-admin-layout>