<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Exports\PendaftarExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total'    => Pendaftaran::count(),
            'lunas'    => Pendaftaran::where('status', 'lunas')->count(),
            'menunggu' => Pendaftaran::where('status', 'menunggu_pembayaran')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'pemasukan'=> Pembayaran::where('status', 'lunas')->sum('jumlah'),
        ];

        $query = \App\Models\Pendaftaran::with(['calonSantri', 'gelombang'])->latest();

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('no_pendaftaran', 'like', "%{$cari}%")
                  ->orWhereHas('calonSantri', fn($s) => $s->where('nama_lengkap', 'like', "%{$cari}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftar = $query->get();

        return view('admin.index', compact('stats', 'pendaftar'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['calonSantri', 'orangTua', 'berkas', 'pembayaran', 'gelombang', 'user']);
        return view('admin.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate(['status' => 'required|in:diterima,ditolak']);
        $pendaftaran->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftar berhasil diperbarui menjadi ' . $request->status . '.');
    }

    public function resetPassword(\App\Models\User $user)
    {
        $passwordSementara = 'santri' . rand(1000, 9999);
        $user->update(['password' => Hash::make($passwordSementara)]);
        return back()->with('reset_password', "Password untuk {$user->name} berhasil direset menjadi: {$passwordSementara}");
    }

    public function exportExcel()
    {
        return Excel::download(new PendaftarExport, 'data-pendaftar-' . date('Y-m-d') . '.xlsx');
    }
}