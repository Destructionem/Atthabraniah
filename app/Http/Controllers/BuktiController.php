<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;

class BuktiController extends Controller
{
    public function cetak(Pendaftaran $pendaftaran)
    {
        $user = auth()->user();
        // Admin boleh cetak semua; wali hanya boleh cetak miliknya sendiri
        if ($user->role !== 'admin' && $pendaftaran->user_id !== $user->id) {
            abort(403);
        }

        $pendaftaran->load(['calonSantri', 'orangTua', 'gelombang', 'pembayaran']);
        $pdf = Pdf::loadView('pdf.bukti', compact('pendaftaran'));
        return $pdf->stream('bukti-pendaftaran-' . $pendaftaran->no_pendaftaran . '.pdf');
    }
}