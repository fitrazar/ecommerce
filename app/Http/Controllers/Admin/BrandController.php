<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brands = Brand::all();

            return DataTables::of($brands)
                ->make();
        }
        return view('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug',
        ]);

        $validatedData['status'] = $request->status == true ? 0 : 1;

        Brand::create($validatedData);

        return redirect('/admin/brand')->with('success', 'Brand Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $rules = [
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug,' . $brand->id,
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = $request->status == true ? 0 : 1;

        Brand::findOrFail($brand->id)->update($validatedData);

        return redirect('/admin/brand')->with('success', 'Brand Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        Brand::destroy($brand->id);
        return redirect('/admin/brand')->with('success', 'Brand Berhasil Dihapus');
    }
}
