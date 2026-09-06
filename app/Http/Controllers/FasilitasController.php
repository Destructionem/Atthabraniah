<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concerns\HandlesImageUpload;


class FasilitasController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $fasilitas = Fasilitas::latest()->get();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.form', ['fasilitas' => new Fasilitas()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->uploadImage($request->file('gambar'), 'fasilitas');
        }
        Fasilitas::create($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.form', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('gambar')) {
            if ($fasilitas->gambar) Storage::disk('public')->delete($fasilitas->gambar);
            $data['gambar'] = $this->uploadImage($request->file('gambar'), 'fasilitas');
        }
        $fasilitas->update($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        if ($fasilitas->gambar) Storage::disk('public')->delete($fasilitas->gambar);
        $fasilitas->delete();
        return back()->with('success', 'Fasilitas dihapus.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'nama'       => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|max:10240',
        ]);
    }
}