<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Unit;
use Exception;
use App\Http\Requests\Product\Store as StoreRequest; //penerapan form request agar memudahkan validasi
use App\Http\Requests\Product\Update as UpdateRequest; //penerapan form request agar memudahkan validasi
use App\Models\Color;
use App\Models\Material;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::all();

            return DataTables::of($products)
                ->editColumn('created_at', function ($product) {
                    return $product->created_at;
                })
                ->editColumn('updated_at', function ($product) {
                    return $product->updated_at;
                })
                ->make();
        }
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        $brands = Brand::all();
        $materials = Material::all();
        $categories = Category::all();
        $colors = Color::all();
        $productImages = ProductImage::all();
        return view('admin.product.manage', compact('units', 'brands', 'categories', 'productImages', 'materials', 'colors'));
    }


    public function store(StoreRequest $request)
    {
        $data = $request->all();
        try {
            if ($request->hasFile('cover')) {
                $data['cover'] = time() . '.' . $request->file('cover')->getClientOriginalExtension();
                $request->file('cover')->storeAs('product', $data['cover']);
            }

            $data['status'] = $request->has('status') ? 0 : 1;

            $product = Product::create($data);

            if ($request->has('colors')) {
                $colorIds = $request->input('colors');
                $product->productColors()->attach($colorIds);
            }

            toast('Berhasil Menambah Product', 'success');
            return redirect()->route('product.index');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Product', 'error');
            return redirect()->route('product.create');
        } catch (Exception $e) {
            toast('Gagal Menambah Product', 'error');
            return redirect()->route('product.create');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = Product::with(['unit', 'brand', 'material', 'category'])
            ->findOrFail($product->id);
        return view('admin.product.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $units = Unit::all();
        $brands = Brand::all();
        $materials = Material::all();
        $categories = Category::all();
        $colors = Color::all();
        $selectedColorIds = $product->productColors->pluck('id')->toArray();
        $productImages = ProductImage::all();
        return view('admin.product.manage', compact('product', 'units', 'brands', 'categories', 'productImages', 'materials', 'colors', 'selectedColorIds'));
    }



    public function update(UpdateRequest $request, Product $product)
    {
        try {
            $data = $request->all();

            if ($request->hasFile('cover')) {
                $path = 'product';
                if ($product->cover) {
                    Storage::delete($path . '/' . $product->cover);
                }
                $data['cover'] = time() . '.' . $request->file('cover')->getClientOriginalExtension();
                $request->file('cover')->storeAs($path, $data['cover']);
            } else {
                $data['cover'] = $product->cover;
            }

            $data['status'] = $request->has('status') ? 0 : 1;

            $product->update($data);

            if ($request->has('colors')) {
                $colorIds = array_unique($request->input('colors'));
                $product->productColors()->sync($colorIds);
            } else {
                $product->productColors()->sync([]);
            }
            toast('Berhasil Mengedit Product', 'success');
            return redirect()->route('admin.product.index');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Product', 'error');
            return redirect()->route('admin.product.edit', ['product' => $product->id]);
        } catch (Exception $e) {
            toast('Gagal Mengedit Product', 'error');
            return redirect()->route('admin.product.edit', ['product' => $product->id]);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // penerapan try catch agar mudah error handling
        try {
            if ($product->cover) {
                Storage::delete('product/' . $product->cover);
            }
            $dataProduct = Product::findOrFail($product->id);
            $dataProduct->delete();
            toast('Berhasil Menghapus Product', 'success');
            return redirect('admin/product');
        } catch (Exception $e) {
            toast('Gagal Menghapus Product', 'error');
            return redirect('admin/product');
        } catch (QueryException $qe) {
            toast('Gagal Menghapus Product', 'error');
            return redirect('admin/product');
        }
    }
}
