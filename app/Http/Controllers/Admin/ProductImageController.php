<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class ProductImageController extends Controller
{
    public function uploadProductImages(Request $request)
    {
        $path = null;
        if ($request->file('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $path = $file->store('tmp', 'public');
            }
        }
        return $path;
    }

    public function revertProductImages(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }

}
