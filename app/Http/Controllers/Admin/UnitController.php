<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
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
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'acronym' => 'required|string|unique:units,acronym',
            ]);

            $validatedData['name'] = Str::title($validatedData['name']);
            $validatedData['acronym'] = Str::lower($validatedData['acronym']);
            $validatedData['status'] = $request->status == true ? 0 : 1;

            Unit::create($validatedData);
            toast('Berhasil Menambah Satuan', 'success');
            return redirect('/admin/unit');
        } catch (Exception $e) {
            toast('Gagal Menambah Satuan', 'error');
            return redirect('admin/unit');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Satuan', 'error');
            return redirect('admin/unit');
        }
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
        try {
            $rules = [
                'name' => 'required|string',
                'acronym' => 'required|string|unique:units,acronym,' . $unit->id,
            ];

            $validatedData = $request->validate($rules);
            $validatedData['name'] = Str::title($validatedData['name']);
            $validatedData['acronym'] = Str::lower($validatedData['acronym']);
            $validatedData['status'] = $request->status == true ? 0 : 1;

            Unit::findOrFail($unit->id)->update($validatedData);
            toast('Berhasil Mengedit Satuan', 'success');
            return redirect('/admin/unit');
        } catch (Exception $e) {
            toast('Gagal Menambah Satuan', 'error');
            return redirect('admin/unit');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Satuan', 'error');
            return redirect('admin/unit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        try {
            Unit::destroy($unit->id);
            toast('Berhasil Menghapus Satuan', 'success');
            return redirect('/admin/unit');
        } catch (Exception $e) {
            toast('Gagal Menambah Satuan', 'error');
            return redirect('admin/unit');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Satuan', 'error');
            return redirect('admin/unit');
        }
    }
}
