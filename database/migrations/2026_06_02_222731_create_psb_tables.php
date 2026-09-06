<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gelombangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->unsignedInteger('biaya_pendaftaran');
            $table->unsignedInteger('kuota')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('gelombang_id')->constrained();
            $table->string('no_pendaftaran')->unique();
            $table->enum('status', ['draft', 'menunggu_pembayaran', 'lunas', 'diverifikasi', 'diterima', 'ditolak'])->default('draft');
            $table->timestamps();
        });

        Schema::create('calon_santris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nik', 16)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('asal_sekolah')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp');
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->enum('jenis', ['kk', 'akta', 'ijazah', 'foto']);
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->unsignedInteger('jumlah');
            $table->string('metode')->nullable();
            $table->enum('status', ['pending', 'settlement', 'lunas', 'expire', 'cancel', 'gagal'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('berkas');
        Schema::dropIfExists('orang_tuas');
        Schema::dropIfExists('calon_santris');
        Schema::dropIfExists('pendaftarans');
        Schema::dropIfExists('gelombangs');
    }
};