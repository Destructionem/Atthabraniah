<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $guarded = [];

    // Selalu ambil 1 baris pengaturan (buat jika belum ada)
    public static function get()
    {
        return static::firstOrCreate(['id' => 1]);
    }
}