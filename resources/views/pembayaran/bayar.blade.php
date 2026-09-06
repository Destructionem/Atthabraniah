<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Pembayaran Pendaftaran</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <p class="text-gray-600">No. Pendaftaran</p>
                <p class="font-semibold text-lg mb-4">{{ $pendaftaran->no_pendaftaran }}</p>
                <p class="text-gray-600">Total Pembayaran</p>
                <p class="font-bold text-2xl text-emerald-700 mb-6">
                    Rp {{ number_format($pendaftaran->gelombang->biaya_pendaftaran, 0, ',', '.') }}
                </p>
                <button id="bayar-button" class="bg-emerald-700 text-white font-semibold px-8 py-3 rounded-lg hover:bg-emerald-800">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.getElementById('bayar-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function () { window.location = '{{ route('dashboard') }}'; },
                onPending: function () { window.location = '{{ route('dashboard') }}'; },
                onError: function ()   { alert('Pembayaran gagal. Coba lagi.'); },
                onClose: function ()   { alert('Anda menutup jendela pembayaran sebelum selesai.'); }
            });
        };
    </script>
</x-app-layout>