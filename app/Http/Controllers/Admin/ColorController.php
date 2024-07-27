<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $colors = Color::all();

            return DataTables::of($colors)
                ->make();
        }
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.color.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.color.manage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'name' => 'required|string',
                'image' => 'nullable|max:4096|mimes:png,jpg,svg',
            ]);

            if ($request->hasFile('image')) {
                $validatedData['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('color', $validatedData['image']);
            }
            Color::create($validatedData);

            toast('Berhasil Menambah Warna', 'success');
            return redirect('/admin/color');
        } catch (Exception $e) {
            toast('Gagal Menambah Warna', 'error');
            return redirect('admin/color');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Warna', 'error');
            return redirect('admin/color');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('admin.color.manage', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        try {

            $rules = [
                'image' => 'nullable|max:4096|mimes:png,jpg,svg',
                'name' => 'required|string',
            ];

            $validatedData = $request->validate($rules);
            $validatedData['image'] = $request->oldImage;
            if ($request->file('image')) {
                $path = 'color';
                if ($request->oldImage) {
                    Storage::delete($path . '/' . $request->oldImage);
                }
                $validatedData['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs($path, $validatedData['image']);
            }
            Color::findOrFail($color->id)->update($validatedData);

            toast('Berhasil Mengedit Warna', 'success');
            return redirect('/admin/color');
        } catch (Exception $e) {
            toast('Gagal Mengedit Warna', 'error');
            return redirect('admin/color');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Warna', 'error');
            return redirect('admin/color');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        try {
            if ($color->image) {
                Storage::delete('color/' . $color->image);
            }
            Color::destroy($color->id);
            toast('Berhasil Hapus Warna', 'success');
            return redirect('/admin/color');
        } catch (Exception $e) {
            toast('Gagal Menghapus Warna', 'error');
            return redirect('admin/color');
        } catch (QueryException $qe) {
            toast('Gagal Menghapus Warna', 'error');
            return redirect('admin/color');
        }
    }
}
