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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productImages = ProductImage::with('product')->get()->groupBy('product_id');

            $data = $productImages->map(function ($images, $productId) {
                $imageHtml = $images->map(function ($image) {
                    return '<img src="' . asset('storage/product_image/' . $image->image) . '" class="w-[100px] object-cover border mx-1" />';
                })->implode('');

                $productName = $images->first()->product->name;

                return [
                    'product_id' => $productId,
                    'product_name' => $productName,
                    'images' => '<div class="flex flex-wrap gap-2">' . $imageHtml . '</div>',
                ];
            });

            return DataTables::of($data)
                ->addColumn('images', function ($row) {
                    return $row['images'];
                })
                ->rawColumns(['images'])
                ->make();
        }

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.product_image.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.product_image.manage', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'product_id' => 'required|string',
                'image.*' => 'nullable|max:2048',
            ]);

            if ($request->input('image')) {
                foreach ($request->input('image') as $file) {
                    $newFilename = Str::after($file, 'tmp/');
                    Storage::disk('public')->move($file, "product_image/$newFilename");
                    ProductImage::create([
                        'product_id' => $request->input('product_id'),
                        'image' => $newFilename,
                    ]);
                }
            }

            toast('Berhasil Menambah Gambar Product', 'success');
            return redirect('/admin/product_image');
        } catch (Exception $e) {
            dd($e);
            toast('Gagal Menambah Gambar Product', 'error');
            return redirect('admin/product_image');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Gambar Product', 'error');
            return redirect('admin/product_image');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImage)
    {
        $images = ProductImage::get(['image']);
        $products = Product::all();
        return view('admin.product_image.manage', compact('productImage', 'images', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        try {

            $rules = [
                'image' => 'nullable|max:4096|mimes:png,jpg,svg',
                'product_id' => 'required|string',
            ];

            $validatedData = $request->validate($rules);
            $validatedData['image'] = $request->oldImage;
            if ($request->file('image')) {
                $path = 'ProductImage';
                if ($request->oldImage) {
                    Storage::delete($path . '/' . $request->oldImage);
                }
                $validatedData['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs($path, $validatedData['image']);
            }
            ProductImage::findOrFail($productImage->id)->update($validatedData);

            toast('Berhasil Mengedit Gambar Product', 'success');
            return redirect('/admin/product_image');
        } catch (Exception $e) {
            toast('Gagal Mengedit Gambar Product', 'error');
            return redirect('admin/product_image');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Gambar Product', 'error');
            return redirect('admin/product_image');
        }
    }


    public function show(ProductImage $productImage)
    {
        $data = ProductImage::with(['product'])
            ->findOrFail($productImage->id);

        return view('admin.product.detail', compact('data'));
    }

    public function uploadProductImages(Request $request)
    {;
        if ($request->file('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('tmp', 'public');
            }
        }
        return $path;
    }
    // public function uploadProductImages(Request $request)
    // {
    //     $paths = [];
    //     if ($request->file('images')) {
    //         foreach ($request->file('images') as $file) {
    //             $paths[] = $file->store('tmp', 'public');
    //         }
    //     }
    //     return $paths;
    // }
}
