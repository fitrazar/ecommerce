<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $units = Unit::all();

            return DataTables::of($units)
                ->make();
        }
        return view('admin.unit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'acronym' => 'required|string|unique:units,slug',
        ]);

        $validatedData['status'] = $request->status == true ? 0 : 1;

        Unit::create($validatedData);

        return redirect('/admin/unit')->with('success', 'Satuan Berhasil Ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $rules = [
            'name' => 'required|string',
            'acronym' => 'required|string|unique:units,slug,' . $unit->id,
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = $request->status == true ? 0 : 1;

        Unit::findOrFail($unit->id)->update($validatedData);

        return redirect('/admin/unit')->with('success', 'Satuan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        Unit::destroy($unit->id);
        return redirect('/admin/unit')->with('success', 'Satuan Berhasil Dihapus');
    }
}
