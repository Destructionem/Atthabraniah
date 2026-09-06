<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PembayaranController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function bayar(Pendaftaran $pendaftaran)
    {
        // Pastikan hanya pemilik pendaftaran yang boleh bayar
        abort_if($pendaftaran->user_id !== auth()->id(), 403);

        $orderId = $pendaftaran->no_pendaftaran . '-' . time();

        // Buat / perbarui record pembayaran
        $pembayaran = $pendaftaran->pembayaran()->updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'order_id' => $orderId,
                'jumlah'   => $pendaftaran->gelombang->biaya_pendaftaran,
                'status'   => 'pending',
            ]
        );

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $pendaftaran->gelombang->biaya_pendaftaran,
            ],
            'customer_details' => [
                'first_name' => $pendaftaran->calonSantri->nama_lengkap ?? 'Calon Santri',
                'email'      => auth()->user()->email,
            ],
            'item_details' => [[
                'id'       => 'PSB',
                'price'    => (int) $pendaftaran->gelombang->biaya_pendaftaran,
                'quantity' => 1,
                'name'     => 'Biaya Pendaftaran ' . $pendaftaran->gelombang->nama,
            ]],
        ];

        $snapToken = Snap::getSnapToken($params);
        $pembayaran->update(['snap_token' => $snapToken]);

        return view('pembayaran.bayar', compact('pendaftaran', 'snapToken'));
    }
}