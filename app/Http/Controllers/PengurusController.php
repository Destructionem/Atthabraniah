<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Http\Controllers\Concerns\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    use HandlesImageUpload;

    public function index()
    {
        $pengurus = Pengurus::latest()->get();
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        return view('admin.pengurus.form', ['pengurus' => new Pengurus()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->uploadImage($request->file('foto'), 'pengurus');
        }
        Pengurus::create($data);
        return redirect()->route('admin.pengurus.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.form', compact('pengurus'));
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('foto')) {
            if ($pengurus->foto) Storage::disk('public')->delete($pengurus->foto);
            $data['foto'] = $this->uploadImage($request->file('foto'), 'pengurus');
        }
        $pengurus->update($data);
        return redirect()->route('admin.pengurus.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) Storage::disk('public')->delete($pengurus->foto);
        $pengurus->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tipe'    => 'required|in:pengurus,pengajar',
            'foto'    => 'nullable|image|max:10240',
        ]);
    }
}