<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class UploadService.
 */
class UploadService
{
    public static function uploadImage($file, $folder)
    {
        $newFilename = Str::after($file, 'tmp/');
        Storage::disk('public')->move($file, "{$folder}/{$newFilename}");
        return $newFilename;
    }

    public static function updateImage($file, $preview, $folder)
    {
        if ($file === null) {
            return $preview;
        }

        $newFilename = $file;
        $preview = $preview ?? '';
        if (Str::afterLast($file, '/') !== Str::afterLast($preview, '/')) {
            Storage::disk('public')->delete("{$folder}/{$preview}");
            $newFilename = Str::after($file, 'tmp/');
            Storage::disk('public')->move($file, "{$folder}/{$newFilename}");
        }
        return $newFilename;
    }
}
