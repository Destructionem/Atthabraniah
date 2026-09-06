<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concerns\HandlesImageUpload;


class KegiatanController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.form', ['kegiatan' => new Kegiatan()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->uploadImage($request->file('gambar'), 'kegiatan');
        }
        Kegiatan::create($data);
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.form', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar) Storage::disk('public')->delete($kegiatan->gambar);
            $data['gambar'] = $this->uploadImage($request->file('gambar'), 'kegiatan');
        }
        $kegiatan->update($data);
        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar) Storage::disk('public')->delete($kegiatan->gambar);
        $kegiatan->delete();
        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }

    // Halaman publik detail kegiatan
    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'judul'     => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|max:10240',
            'video_url' => 'nullable|url',
        ]);
    }
}   