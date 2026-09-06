<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Http\Controllers\Concerns\HandlesImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    use HandlesImageUpload;

    public function edit()
    {
        $pengaturan = Pengaturan::get();
        return view('admin.pengaturan.edit', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate(['hero_image' => 'nullable|image|max:10240']);
        $pengaturan = Pengaturan::get();

        if ($request->hasFile('hero_image')) {
            if ($pengaturan->hero_image) Storage::disk('public')->delete($pengaturan->hero_image);
            $pengaturan->hero_image = $this->uploadImage($request->file('hero_image'), 'hero');
            $pengaturan->save();
        }
        return back()->with('success', 'Foto hero berhasil diperbarui.');
    }
}