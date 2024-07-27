<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
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
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);

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
        try {

            $validatedData = $request->validate([
                'name' => 'required|string',
                'slug' => 'required|string|unique:brands,slug',
            ]);

            $validatedData['status'] = $request->status == true ? 0 : 1;

            Brand::create($validatedData);

            toast('Berhasil Menambah Brand!', 'success');
            return redirect('/admin/brand');
        } catch (Exception $e) {
            toast('Gagal Menambah Brand!', 'error');
            return redirect('admin/brand');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Brand!', 'error');
            return redirect('admin/brand');
        }
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
        try {

            $rules = [
                'name' => 'required|string',
                'slug' => 'required|string|unique:brands,slug,' . $brand->id,
            ];

            $validatedData = $request->validate($rules);
            $validatedData['status'] = $request->status == true ? 0 : 1;

            Brand::findOrFail($brand->id)->update($validatedData);

            toast('Berhasil Mengedit Brand!', 'success');
            return redirect('/admin/brand');
        } catch (Exception $e) {
            toast('Gagal Mengedit Brand!', 'error');
            return redirect('admin/brand');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Brand!', 'error');
            return redirect('admin/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            Brand::destroy($brand->id);
            toast('Berhasil Hapus Brand!', 'success');
            return redirect('/admin/brand');
        } catch (Exception $e) {
            toast('Gagal Menghapus Brand!', 'error');
            return redirect('admin/brand');
        } catch (QueryException $qe) {
            toast('Gagal Menghapus Brand!', 'error');
            return redirect('admin/brand');
        }
    }
}
