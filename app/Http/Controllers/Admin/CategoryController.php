<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $validatedData = $request->validate([
            'image' => 'nullable|max:4096|mimes:png,jpg,svg',
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories,slug',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('category', $validatedData['image']);
        }
        $validatedData['status'] = $request->status == true ? 0 : 1;

        Category::create($validatedData);

        return redirect('/dashboard/category')->with('success', 'Kategori Berhasil Ditambahkan!');
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
        $rules = [
            'image' => 'nullable|max:4096|mimes:png,jpg,svg',
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,' . $category->id,
        ];

        $validatedData = $request->validate($rules);

        $validatedData['image'] = $request->oldImage;
        if ($request->file('image')) {
            $path = 'category';
            if ($request->oldImage) {
                Storage::delete($path . '/' . $request->oldImage);
            }
            $validatedData['image'] = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs($path, $validatedData['image']);
        }
        $validatedData['status'] = $request->status == true ? 0 : 1;

        Category::findOrFail($category->id)->update($validatedData);

        return redirect('/admin/category')->with('success', 'Kategori Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::delete('category/' . $category->image);
        }
        Category::destroy($category->id);

        return redirect('/admin/category')->with('success', 'Kategori Berhasil Dihapus!');
    }
}
