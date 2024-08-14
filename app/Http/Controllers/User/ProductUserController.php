<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;

class ProductUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        $data = [];
        foreach ($categories as $key) {
            $list_product = [];
            if (count($list_product) < 5) {
                foreach ($products as $key2) {
                    if ($key->id === $key2->category_id) {
                        $row = [
                            'desc' => $key2->description,
                            'image' => $key2->cover,
                        ];
                        $list_product[] = $row;
                    }
                }
            }

            if (count($list_product) < 1) {
                continue;
            }

            $row = [
                'title' => $key->name,
                'card' => $list_product,
                'linkButton' => "/products/$key->id"
            ];

            $data[] = $row;
        }

        return view('user.product.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::with('category')->where('category_id', $id)->get();
        return view('user.product.show', ['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::where('id', $id)->first();
        $product_image = ProductImage::where('product_id', $id)->get();
        return view('user.product.detail', ['products' => $products, 'product_image' => $product_image]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
