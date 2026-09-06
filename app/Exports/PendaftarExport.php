<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftarExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pendaftaran::with(['calonSantri', 'orangTua', 'gelombang'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No. Pendaftaran', 'Nama Santri', 'NIK', 'Jenis Kelamin',
            'Tempat Lahir', 'Tanggal Lahir', 'Asal Sekolah',
            'Nama Ayah', 'Nama Ibu', 'No. HP',
            'Gelombang', 'Status', 'Tanggal Daftar',
        ];
    }

    public function map($p): array
    {
        return [
            $p->no_pendaftaran,
            $p->calonSantri->nama_lengkap ?? '-',
            $p->calonSantri->nik ?? '-',
            $p->calonSantri->jenis_kelamin ?? '-',
            $p->calonSantri->tempat_lahir ?? '-',
            $p->calonSantri->tanggal_lahir ?? '-',
            $p->calonSantri->asal_sekolah ?? '-',
            $p->orangTua->nama_ayah ?? '-',
            $p->orangTua->nama_ibu ?? '-',
            $p->orangTua->no_hp ?? '-',
            $p->gelombang->nama ?? '-',
            ucwords(str_replace('_', ' ', $p->status)),
            $p->created_at->format('d-m-Y'),
        ];
    }
}