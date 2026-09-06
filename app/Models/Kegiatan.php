<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $guarded = [];

    // Ubah link YouTube biasa menjadi link "embed" agar bisa ditampilkan
    public function getEmbedUrlAttribute()
    {
        if (! $this->video_url) return null;
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([\w-]+)/', $this->video_url, $m);
        return isset($m[1]) ? 'https://www.youtube.com/embed/' . $m[1] : null;
    }
}