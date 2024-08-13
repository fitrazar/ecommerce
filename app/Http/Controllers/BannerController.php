<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    public function uploadBanner(Request $request)
    {
        $path = null;
        if ($request->file('banner')) {
            foreach ($request->file('banner') as $file) {
                $path = $file->store('tmp', 'public');
            }
        }
        return $path;
    }

    public function revertBanner(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }
}
