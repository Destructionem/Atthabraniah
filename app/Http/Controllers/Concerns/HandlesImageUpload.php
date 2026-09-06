<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

trait HandlesImageUpload
{
    protected function uploadImage($file, string $folder): string
    {
        // Perkecil bila lebar > 1000px (rasio terjaga), lalu kompres JPEG
        $image = Image::read($file)->scaleDown(width: 1000);
        $path = $folder . '/' . uniqid() . '.jpg';
        Storage::disk('public')->put($path, (string) $image->toJpeg(75));
        return $path;
    }
}