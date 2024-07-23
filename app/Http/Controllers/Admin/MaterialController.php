<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,slug',
        ]);

        $validatedData['status'] = $request->status == true ? 0 : 1;

        Material::create($validatedData);

        return redirect('/admin/material')->with('success', 'Bahan Berhasil Ditambahkan!');
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
        $rules = [
            'name' => 'required|string',
            'slug' => 'required|string|unique:materials,slug,' . $material->id,
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = $request->status == true ? 0 : 1;

        Material::findOrFail($material->id)->update($validatedData);

        return redirect('/admin/material')->with('success', 'Bahan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        Material::destroy($material->id);
        return redirect('/admin/material')->with('success', 'Bahan Berhasil Dihapus');
    }
}
