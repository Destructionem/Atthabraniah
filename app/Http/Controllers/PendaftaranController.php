<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create()
    {
        $gelombang = Gelombang::where('is_aktif', true)->latest()->first();
        $sudahDaftar = Pendaftaran::where('user_id', auth()->id())->exists();

        return view('pendaftaran.create', compact('gelombang', 'sudahDaftar'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nik'            => 'nullable|string|max:16',
            'jenis_kelamin'  => 'required|in:L,P',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'asal_sekolah'   => 'nullable|string|max:255',
            'alamat'         => 'nullable|string',
            'nama_ayah'      => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu'       => 'nullable|string|max:255',
            'pekerjaan_ibu'  => 'nullable|string|max:255',
            'no_hp'          => 'required|string|max:20',
            'alamat_ortu'    => 'nullable|string',
            'kk'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto'   => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gelombang = Gelombang::where('is_aktif', true)->latest()->firstOrFail();

        $pendaftaran = Pendaftaran::create([
            'user_id'        => auth()->id(),
            'gelombang_id'   => $gelombang->id,
            'no_pendaftaran' => 'PSB-' . now()->format('YmdHis') . '-' . auth()->id(),
            'status'         => 'menunggu_pembayaran',
        ]);

        $pendaftaran->calonSantri()->create([
            'nama_lengkap'  => $validated['nama_lengkap'],
            'nik'           => $validated['nik'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir'  => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'asal_sekolah'  => $validated['asal_sekolah'] ?? null,
            'alamat'        => $validated['alamat'] ?? null,
        ]);

        $pendaftaran->orangTua()->create([
            'nama_ayah'      => $validated['nama_ayah'] ?? null,
            'pekerjaan_ayah' => $validated['pekerjaan_ayah'] ?? null,
            'nama_ibu'       => $validated['nama_ibu'] ?? null,
            'pekerjaan_ibu'  => $validated['pekerjaan_ibu'] ?? null,
            'no_hp'          => $validated['no_hp'],
            'alamat'         => $validated['alamat_ortu'] ?? null,
        ]);

        foreach (['kk', 'akta', 'ijazah', 'foto'] as $jenis) {
            $path = $request->file($jenis)->store('berkas', 'public');
            $pendaftaran->berkas()->create([
                'jenis' => $jenis,
                'path'  => $path,
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil disimpan! Status: menunggu pembayaran.');
    }

    public function uploadUlang(Request $request)
    {
        $pendaftaran = \App\Models\Pendaftaran::where('user_id', auth()->id())->latest()->firstOrFail();

        // Hanya boleh saat status ditolak
        if ($pendaftaran->status !== 'ditolak') {
            abort(403);
        }

        $request->validate([
            'kk'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'akta'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'ijazah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'foto'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        foreach (['kk', 'akta', 'ijazah', 'foto'] as $jenis) {
            if ($request->hasFile($jenis)) {
                $path = $request->file($jenis)->store('berkas', 'public');
                $berkas = $pendaftaran->berkas()->where('jenis', $jenis)->first();
                if ($berkas) {
                    Storage::disk('public')->delete($berkas->path);
                    $berkas->update(['path' => $path]);
                } else {
                    $pendaftaran->berkas()->create(['jenis' => $jenis, 'path' => $path]);
                }
            }
        }

        // Kembali ke antrean verifikasi
        $pendaftaran->update(['status' => 'lunas']);

        return redirect()->route('dashboard')->with('success', 'Berkas berhasil diperbarui. Pendaftaran Anda kembali menunggu verifikasi.');
    }
}