<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\GelombangController;
use App\Http\Controllers\BuktiController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $kegiatan   = \App\Models\Kegiatan::latest()->take(3)->get();
    $fasilitas  = \App\Models\Fasilitas::latest()->take(3)->get();
    $galeri     = \App\Models\Galeri::latest()->take(12)->get();
    $pengaturan = \App\Models\Pengaturan::get();
    return view('home', compact('kegiatan', 'fasilitas', 'galeri', 'pengaturan'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/fasilitas', function () {
    $fasilitas = \App\Models\Fasilitas::latest()->get();
    return view('fasilitas.index', compact('fasilitas'));
})->name('fasilitas.index');

Route::get('/galeri', function () {
    $galeri = \App\Models\Galeri::latest()->get();
    return view('galeri.index', compact('galeri'));
})->name('galeri.index');

Route::get('/kegiatan', function () {
    $kegiatan = \App\Models\Kegiatan::latest()->get();
    return view('kegiatan.index', compact('kegiatan'));
})->name('kegiatan.index');

Route::get('/profil', function () {
    $pengurus = \App\Models\Pengurus::where('tipe', 'pengurus')->latest()->get();
    $pengajar = \App\Models\Pengurus::where('tipe', 'pengajar')->latest()->get();
    return view('profil.index', compact('pengurus', 'pengajar'));
})->name('profil.index');


Route::post('/midtrans/webhook', [WebhookController::class, 'handle'])->name('midtrans.webhook');
Route::get('/kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/{pendaftaran}/bayar', [PembayaranController::class, 'bayar'])->name('pembayaran.bayar');

    Route::get('/bukti/{pendaftaran}', [BuktiController::class, 'cetak'])->name('bukti.cetak');

    Route::post('/pendaftaran/upload-ulang', [PendaftaranController::class, 'uploadUlang'])->name('pendaftaran.uploadUlang');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/pendaftar/{pendaftaran}', [AdminController::class, 'show'])->name('show');
    Route::patch('/pendaftar/{pendaftaran}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');

    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');
    Route::get('/fasilitas/create', [FasilitasController::class, 'create'])->name('fasilitas.create');
    Route::post('/fasilitas', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/fasilitas/{fasilitas}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/fasilitas/{fasilitas}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{fasilitas}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');

    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/pengurus', [PengurusController::class, 'index'])->name('pengurus.index');
    Route::get('/pengurus/create', [PengurusController::class, 'create'])->name('pengurus.create');
    Route::post('/pengurus', [PengurusController::class, 'store'])->name('pengurus.store');
    Route::get('/pengurus/{pengurus}/edit', [PengurusController::class, 'edit'])->name('pengurus.edit');
    Route::put('/pengurus/{pengurus}', [PengurusController::class, 'update'])->name('pengurus.update');
    Route::delete('/pengurus/{pengurus}', [PengurusController::class, 'destroy'])->name('pengurus.destroy');

    Route::get('/gelombang', [GelombangController::class, 'index'])->name('gelombang.index');
    Route::get('/gelombang/create', [GelombangController::class, 'create'])->name('gelombang.create');
    Route::post('/gelombang', [GelombangController::class, 'store'])->name('gelombang.store');
    Route::get('/gelombang/{gelombang}/edit', [GelombangController::class, 'edit'])->name('gelombang.edit');
    Route::put('/gelombang/{gelombang}', [GelombangController::class, 'update'])->name('gelombang.update');
    Route::delete('/gelombang/{gelombang}', [GelombangController::class, 'destroy'])->name('gelombang.destroy');

    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::delete('/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    Route::get('/export-excel', [AdminController::class, 'exportExcel'])->name('export.excel');

    Route::post('/user/{user}/reset-password', [AdminController::class, 'resetPassword'])->name('user.resetPassword');
});

require __DIR__.'/auth.php';

