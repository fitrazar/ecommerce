<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\Store as StoreRequest;
use App\Http\Requests\Product\Update as UpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::all();

            return DataTables::of($products)
                ->editColumn('created_at', function (Product $product) {
                    return $product->created_at;
                })
                ->editColumn('updated_at', function (Product $product) {
                    return $product->updated_at;
                })
                ->make(true);
        }

        return view('admin.product.index');
    }

    public function create()
    {
        $units = Unit::all();
        $brands = Brand::all();
        $materials = Material::all();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $productImages = ProductImage::all();

        return view('admin.product.manage', compact(
            'units',
            'brands',
            'categories',
            'productImages',
            'materials',
            'colors',
            'sizes'
        ));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        try {

            $data['status'] = $request->has('status') ? 0 : 1;

            $newFilename = Str::after($request->input('cover'), 'tmp/');
            Storage::disk('public')->move($request->input('cover'), "product/$newFilename");

            $data['cover'] = "product/$newFilename";

            $product = Product::create($data);

            $this->attachRelatedData($product, $request);

            toast('Berhasil Menambah Product', 'success');

            return redirect()->route('product.index');
        } catch (Exception $e) {
            toast('Gagal Menambah Product', 'error');
            return redirect()->route('product.create');
        }
    }

    public function show(Product $product)
    {
        $data = Product::with(['unit', 'brand', 'material', 'category'])
            ->findOrFail($product->id);

        return view('admin.product.detail', compact('data'));
    }

    public function edit(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $units = Unit::all();
        $brands = Brand::all();
        $materials = Material::all();
        $categories = Category::all();
        $colors = Color::all();
        $selectedColorIds = $product->productColors->pluck('id')->toArray();
        $selectedSizeIds = $product->productSizes->pluck('id')->toArray();
        $sizes = Size::all();
        $productImages = $product->productImages ?? [];

        return view('admin.product.manage', compact(
            'product',
            'units',
            'brands',
            'categories',
            'productImages',
            'materials',
            'colors',
            'selectedSizeIds',
            'selectedColorIds',
            'sizes'
        ));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->all();
        try {

            $newFilename = null;
            $data['status'] = $request->has('status') ? 0 : 1;
            if (Str::afterLast($request->input('cover'), '/') !== Str::afterLast($product->cover, '/')) {
                Storage::disk('public')->delete($product->cover);
                $newFilename = Str::after($request->input('cover'), 'tmp/');
                Storage::disk('public')->move($request->input('cover'), "product/$newFilename");
            }

            $data['cover'] = $request->has('cover') ? "product/$newFilename" : $product->cover;

            $product->update($data);

            $this->syncRelatedData($product, $request);

            toast('Berhasil Mengedit Product', 'success');

            return redirect()->route('product.index');
        } catch (Exception $e) {
            toast('Gagal Mengedit Product', 'error');
            return back();
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            toast('Berhasil Menghapus Product', 'success');

            return redirect()->route('product.index');
        } catch (Exception $e) {
            toast('Gagal Menghapus Product', 'error');

            return redirect()->route('product.index');
        }
    }

    private function attachRelatedData(Product $product, Request $request)
    {
        if ($request->has('colors')) {
            $colorIds = array_unique($request->input('colors'));
            $product->productColors()->attach($colorIds);
        }

        if ($request->has('sizes')) {
            $sizeIds = array_unique($request->input('sizes'));
            $product->productSizes()->attach($sizeIds);
        }
    }

    private function syncRelatedData(Product $product, Request $request)
    {
        if ($request->has('colors')) {
            $colorIds = array_unique($request->input('colors'));
            $product->productColors()->sync($colorIds);
        } else {
            $product->productColors()->sync([]);
        }

        if ($request->has('sizes')) {
            $sizeIds = array_unique($request->input('sizes'));
            $product->productSizes()->sync($sizeIds);
        } else {
            $product->productSizes()->sync([]);
        }
    }

    public function uploadCover(Request $request)
    {
        if ($request->file('cover')) {
            $path = $request->file('cover')->store('tmp', 'public');
        }
        return $path;
    }

    public function revertCover(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }

}
