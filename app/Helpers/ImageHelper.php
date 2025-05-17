<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function resize($path, $photo)
    {
        $img_path = $path ?? 'public/';
        $img = Image::make($photo)->orientate();
        $width = $img->width();
        $height = $img->height();

        if ($width > 800 || $height > 800) {
            $img = $img->fit(800);
        }
        $img = $img->encode('jpg', 100);
        $image_path = $img_path . str()->random(3) . '-' . now()->format('Hisu') . '.jpg';
        Storage::put($image_path, $img);
        return $image_path;
    }
}
