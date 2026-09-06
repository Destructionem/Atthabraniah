<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { color: #1f2937; font-size: 12px; margin: 0; }
        .header { text-align: center; border-bottom: 2px solid #047857; padding-bottom: 10px; margin-bottom: 16px; }
        .header h1 { color: #047857; font-size: 18px; margin: 0; }
        .header p { margin: 2px 0; font-size: 11px; color: #6b7280; }
        .title { text-align: center; font-size: 14px; font-weight: bold; margin: 12px 0; text-transform: uppercase; }
        .no { text-align: center; margin-bottom: 16px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
        td { padding: 5px 8px; vertical-align: top; }
        .label { width: 35%; color: #6b7280; }
        .section { background: #ecfdf5; color: #047857; font-weight: bold; padding: 5px 8px; margin-top: 8px; }
        .badge { padding: 3px 8px; border-radius: 10px; font-size: 11px; }
        .footer { margin-top: 30px; font-size: 11px; color: #6b7280; text-align: right; }
        .ttd { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="height:60px; margin-bottom:6px;">
    <div class="header">
        <h1>PONDOK PESANTREN AT-THABRANIAH</h1>
        <p>[Alamat pesantren] &mdash; Telp: [No. Telepon]</p>
    </div>

    <div class="title">Bukti Pendaftaran Santri Baru</div>
    <div class="no">No. Pendaftaran: <strong>{{ $pendaftaran->no_pendaftaran }}</strong></div>

    <div class="section">Data Calon Santri</div>
    <table>
        <tr><td class="label">Nama Lengkap</td><td>: {{ $pendaftaran->calonSantri->nama_lengkap ?? '-' }}</td></tr>
        <tr><td class="label">NIK</td><td>: {{ $pendaftaran->calonSantri->nik ?? '-' }}</td></tr>
        <tr><td class="label">Tempat, Tanggal Lahir</td><td>: {{ $pendaftaran->calonSantri->tempat_lahir ?? '-' }}, {{ $pendaftaran->calonSantri->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->calonSantri->tanggal_lahir)->format('d M Y') : '-' }}</td></tr>
        <tr><td class="label">Jenis Kelamin</td><td>: {{ $pendaftaran->calonSantri->jenis_kelamin ?? '-' }}</td></tr>
        <tr><td class="label">Asal Sekolah</td><td>: {{ $pendaftaran->calonSantri->asal_sekolah ?? '-' }}</td></tr>
        <tr><td class="label">Alamat</td><td>: {{ $pendaftaran->calonSantri->alamat ?? '-' }}</td></tr>
    </table>

    <div class="section">Data Orang Tua / Wali</div>
    <table>
        <tr><td class="label">Nama Ayah</td><td>: {{ $pendaftaran->orangTua->nama_ayah ?? '-' }}</td></tr>
        <tr><td class="label">Nama Ibu</td><td>: {{ $pendaftaran->orangTua->nama_ibu ?? '-' }}</td></tr>
        <tr><td class="label">No. HP</td><td>: {{ $pendaftaran->orangTua->no_hp ?? '-' }}</td></tr>
    </table>

    <div class="section">Informasi Pendaftaran</div>
    <table>
        <tr><td class="label">Gelombang</td><td>: {{ $pendaftaran->gelombang->nama ?? '-' }}</td></tr>
        <tr><td class="label">Biaya Pendaftaran</td><td>: Rp {{ number_format($pendaftaran->gelombang->biaya_pendaftaran ?? 0, 0, ',', '.') }}</td></tr>
        <tr><td class="label">Status</td><td>: {{ ucwords(str_replace('_', ' ', $pendaftaran->status)) }}</td></tr>
        <tr><td class="label">Tanggal Daftar</td><td>: {{ $pendaftaran->created_at->format('d M Y H:i') }}</td></tr>
    </table>

    <div class="ttd">
        <p>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Panitia Penerimaan Santri Baru</p>
        <br><br><br>
        <p>( ____________________ )</p>
    </div>

    <div class="footer">Dokumen ini dicetak otomatis dari Sistem Informasi PSB Pondok Pesantren At-Thabraniah.</div>
</body>
</html>