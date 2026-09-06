<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Gelombang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataAwalSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pesantren',
            'email' => 'admin@atthabraniah.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'ubah-lewat-env')),
            'role' => 'admin',
        ]);

        Gelombang::create([
            'nama' => 'Gelombang 1',
            'tanggal_buka' => now(),
            'tanggal_tutup' => now()->addMonths(2),
            'biaya_pendaftaran' => 250000,
            'kuota' => 100,
            'is_aktif' => true,
        ]);
    }
}