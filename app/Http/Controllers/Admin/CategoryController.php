<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::all();

            return DataTables::of($categories)
                ->make();
        }
        $title = 'Hapus Data!';
        $text = "Apakah anda yakin untuk menghapus data ini?";
        confirmDelete($title, $text);
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image' => 'nullable',
                'name' => 'required|string',
                'slug' => 'required|string|unique:categories,slug',
            ]);

            if ($request->has('image')) {
                $file = $request['image'];
                $upload = UploadService::uploadImage($file, 'category');
                $validatedData['image'] = $upload;
            }

            $validatedData['status'] = $request->status == true ? 0 : 1;

            Category::create($validatedData);
            toast('Berhasil Tambah Kategori!', 'success');
            return redirect('/admin/category');
        } catch (Exception $e) {
            toast('Gagal Menambah Kategori!', 'error');
            return redirect('admin/category');
        } catch (QueryException $qe) {
            toast('Gagal Menambah Kategori!', 'error');
            return redirect('admin/category');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $rules = [
                'image' => 'nullable',
                'name' => 'required|string',
                'slug' => 'required|string|unique:categories,slug,' . $category->id,
            ];

            $validatedData = $request->validate($rules);

            if ($request->has('image')) {
                $file = $request['image'];
                $upload = UploadService::updateImage($file, $category->image, 'category');
                $validatedData['image'] = $upload;
            } else {
                Storage::disk('public')->delete('category/' . $category->image);
                $validatedData['image'] = null;
            }

            $validatedData['status'] = $request->status == true ? 0 : 1;

            Category::findOrFail($category->id)->update($validatedData);
            toast('Berhasil Edit Kategori!', 'success');

            return redirect('/admin/category');
        } catch (Exception $e) {
            toast('Gagal Mengedit Kategori!', 'error');
            return redirect('admin/category');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Kategori!', 'error');
            return redirect('admin/category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            if ($category->image) {
                Storage::delete('category/' . $category->image);
            }
            Category::destroy($category->id);
            toast('Berhasil Hapus Kategori!', 'success');
            return redirect('/admin/category');
        } catch (Exception $e) {
            toast('Gagal Mengedit Kategori!', 'error');
            return redirect('admin/category');
        } catch (QueryException $qe) {
            toast('Gagal Mengedit Kategori!', 'error');
            return redirect('admin/category');
        }
    }


    public function uploadCategory(Request $request)
    {
        if ($request->file('image')) {
            $path = $request->file('image')->store('tmp', 'public');
        }
        return $path;
    }

    public function revertCategory(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }
}
