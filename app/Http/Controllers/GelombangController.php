<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index()
    {
        $gelombang = Gelombang::latest()->get();
        return view('admin.gelombang.index', compact('gelombang'));
    }

    public function create()
    {
        return view('admin.gelombang.form', ['gelombang' => new Gelombang()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $this->handleAktif($data);
        Gelombang::create($data);
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang ditambahkan.');
    }

    public function edit(Gelombang $gelombang)
    {
        return view('admin.gelombang.form', compact('gelombang'));
    }

    public function update(Request $request, Gelombang $gelombang)
    {
        $data = $this->validateData($request);
        $this->handleAktif($data, $gelombang->id);
        $gelombang->update($data);
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang diperbarui.');
    }

    public function destroy(Gelombang $gelombang)
    {
        $gelombang->delete();
        return back()->with('success', 'Gelombang dihapus.');
    }

    // Jika gelombang ini diaktifkan, non-aktifkan yang lain (hanya 1 aktif)
    private function handleAktif(array &$data, $kecualiId = null)
    {
        $data['is_aktif'] = $data['is_aktif'] ?? false;
        if ($data['is_aktif']) {
            Gelombang::when($kecualiId, fn($q) => $q->where('id', '!=', $kecualiId))->update(['is_aktif' => false]);
        }
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'nama'              => 'required|string|max:255',
            'tanggal_buka'      => 'required|date',
            'tanggal_tutup'     => 'required|date|after_or_equal:tanggal_buka',
            'biaya_pendaftaran' => 'required|integer|min:0',
            'kuota'             => 'required|integer|min:1',
            'is_aktif'          => 'nullable|boolean',
        ]);
    }
}