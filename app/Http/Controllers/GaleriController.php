<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concerns\HandlesImageUpload;


class GaleriController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $galeri = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'  => 'nullable|string|max:255',
            'gambar' => 'required|image|max:10240',
        ]);
        $data['gambar'] = $this->uploadImage($request->file('gambar'), 'galeri');
        Galeri::create($data);
        return back()->with('success', 'Foto ditambahkan ke galeri.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar) Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();
        return back()->with('success', 'Foto dihapus.');
    }
}