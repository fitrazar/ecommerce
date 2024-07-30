<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $size = Size::all();

            return DataTables::of($size)
                ->make();
        }
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.size.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.size.manage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'size_number' => 'required|integer',
                'size_chart' => 'nullable|string',
            ]);

            $validatedData['status'] = $request->has('status') ? 0 : 1;
            Size::create($validatedData);

            toast('Berhasil Menambah Ukuran', 'success');
            return redirect('/admin/size');
        } catch (Exception $e) {
            toast('Gagal Menambah Ukuran', 'error');
            return redirect('admin/size');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Ukuran', 'error');
            return redirect('admin/size');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('admin.size.manage', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        try {

            $rules = [
                'size_number' => 'required|integer',
                'size_chart' => 'nullable|string',
            ];

            $validatedData = $request->validate($rules);
            $validatedData['status'] = $request->has('status') ? 0 : 1;
            Size::findOrFail($size->id)->update($validatedData);

            toast('Berhasil Mengedit Ukuran', 'success');
            return redirect('/admin/size');
        } catch (Exception $e) {
            toast('Gagal Mengedit Ukuran', 'error');
            return redirect('admin/size');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Ukuran', 'error');
            return redirect('admin/size');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        try {
            Size::destroy($size->id);
            toast('Berhasil Hapus Ukuran', 'success');
            return redirect('/admin/size');
        } catch (Exception $e) {
            toast('Gagal Menghapus Ukuran', 'error');
            return redirect('admin/size');
        } catch (QueryException $qe) {
            toast('Gagal Menghapus Ukuran', 'error');
            return redirect('admin/size');
        }
    }
}
