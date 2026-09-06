<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
    {
        protected $guarded = [];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function gelombang()
        {
            return $this->belongsTo(Gelombang::class);
        }

        public function calonSantri()
        {
            return $this->hasOne(CalonSantri::class);
        }

        public function orangTua()
        {
            return $this->hasOne(OrangTua::class);
        }

        public function berkas()
        {
            return $this->hasMany(Berkas::class);
        }

        public function pembayaran()
        {
            return $this->hasOne(Pembayaran::class);
        }

        public function riwayat()
    {
        return $this->hasMany(RiwayatPendaftaran::class)->latest();
    }

    protected static function booted()
    {
        // Catat status awal saat pendaftaran dibuat
        static::created(function ($pendaftaran) {
            $pendaftaran->riwayat()->create(['status' => $pendaftaran->status]);
        });

        // Catat setiap kali status berubah (bayar, verifikasi, dll.)
        static::updated(function ($pendaftaran) {
            if ($pendaftaran->wasChanged('status')) {
                $pendaftaran->riwayat()->create(['status' => $pendaftaran->status]);
            }
        });
    }
}