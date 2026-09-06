<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden text-center">
    @if ($p->foto)
        <img src="{{ asset('storage/' . $p->foto) }}" class="h-48 w-full object-cover" alt="{{ $p->nama }}">
    @else
        <div class="h-48 w-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-5xl font-bold">{{ strtoupper(substr($p->nama, 0, 1)) }}</div>
    @endif
    <div class="p-4">
        <h4 class="font-semibold text-gray-800">{{ $p->nama }}</h4>
        <p class="text-sm text-emerald-700">{{ $p->jabatan }}</p>
    </div>
</div>