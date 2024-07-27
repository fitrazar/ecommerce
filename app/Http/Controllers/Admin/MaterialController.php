<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $materials = Material::all();

            return DataTables::of($materials)
                ->make();
        }
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.material.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.material.create');
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
            Material::create($validatedData);
            toast('Berhasil Menambah Material!', 'success');
            return redirect('/admin/material');
        } catch (Exception $e) {
            toast('Gagal Menambah Material!', 'error');
            return redirect('admin/material');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Material!', 'error');
            return redirect('admin/material');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('admin.material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {

        try {

            $rules = [
                'name' => 'required|string',
                'slug' => 'required|string|unique:materials,slug,' . $material->id,
            ];

            $validatedData = $request->validate($rules);
            $validatedData['status'] = $request->status == true ? 0 : 1;

            Material::findOrFail($material->id)->update($validatedData);
            toast('Berhasil Mengedit Material!', 'success');
            return redirect('/admin/material');
        } catch (Exception $e) {
            toast('Gagal Mengedit Material!', 'error');
            return redirect('admin/material');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Material!', 'error');
            return redirect('admin/material');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        try {

            Material::destroy($material->id);
            toast('Berhasil Menghapus Material!', 'success');
            return redirect('/admin/material');
        } catch (Exception $e) {
            toast('Gagal Menghapus Material!', 'error');
            return redirect('admin/material');
        } catch (QueryException $qe) {
            toast('Gagal Menghapus Material!', 'error');
            return redirect('admin/material');
        }
    }
}
