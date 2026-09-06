<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class WebhookController extends Controller
{
        public function handle(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');

        // === VERIFIKASI TANDA TANGAN — wajib, sebelum memproses apa pun ===
        $signature = hash(
            'sha512',
            $request->order_id . $request->status_code . $request->gross_amount . $serverKey
        );

        if (! hash_equals($signature, (string) $request->signature_key)) {
            Log::warning('Webhook Midtrans ditolak: signature tidak valid', [
                'order_id' => $request->order_id,
                'ip'       => $request->ip(),
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        // === akhir verifikasi ===

        Config::$serverKey = $serverKey;
        Config::$isProduction = config('services.midtrans.is_production');

        try {
            $notif = new Notification();
        } catch (\Throwable $e) {
            Log::error('Webhook Midtrans: gagal ambil notifikasi', ['pesan' => $e->getMessage()]);
            return response()->json(['message' => 'Notification error'], 200);
        }
        // ... sisa kode lama biarkan apa adanya

        $orderId = $notif->order_id;
        $statusMidtrans = $notif->transaction_status;
        $fraud = $notif->fraud_status ?? null;

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();
        if (! $pembayaran) {
            return response()->json(['message' => 'Order tidak ditemukan'], 404);
        }

        if ($statusMidtrans == 'capture' || $statusMidtrans == 'settlement') {
            if ($fraud != 'challenge') {
                $pembayaran->update([
                    'status'  => 'lunas',
                    'metode'  => $notif->payment_type ?? null,
                    'paid_at' => now(),
                ]);
                $pembayaran->pendaftaran->update(['status' => 'lunas']);
            }
        } elseif (in_array($statusMidtrans, ['expire', 'cancel', 'deny'])) {
            $pembayaran->update(['status' => $statusMidtrans == 'expire' ? 'expire' : 'cancel']);
        } elseif ($statusMidtrans == 'pending') {
            $pembayaran->update(['status' => 'pending']);
        }

        return response()->json(['message' => 'OK']);
    }
}