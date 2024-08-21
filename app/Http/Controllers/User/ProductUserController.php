<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProductUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('status', 1)->get();

        $data = [];
        foreach ($categories as $key) {
            $list_product = [];
            if (count($list_product) < 5) {
                foreach ($products as $key2) {
                    if ($key->id === $key2->category_id) {
                        $row = [
                            'desc' => $key2->description,
                            'image' => $key2->cover,
                            'detail' => "products_detail/$key2->slug"
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
                'linkButton' => "/products/$key->slug"
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
    public function show(string $id, Request $request)
    {

        $category = Category::where('slug', $id)->first();
        $category_id = $category->id;

        $products = Product::where('category_id', $category_id)->where('status', 1)->filter();
        if ($request->search) {
            $search_field = $request->search;
            $products->where('name', 'like', '%' . $search_field . '%');
        } else {
            $search_field = '';
        }

        return view('user.product.show', [
            'category_name' => $category->name,
            'products' => $products->simplePaginate(2)->withQueryString(),
            'products_count' => $products->count(),
            'search_field' => $search_field
        ]);
    }

    public function detail(string $slug)
    {
        $products = Product::where('slug', $slug)->first();
        $product_image = ProductImage::where('product_id', $products->id)->get();

        $similar_products = Product::where('slug', '!=', $slug)->where('category_id', $products->category_id)->get();

        return view('user.product.detail', ['products' => $products, 'product_image' => $product_image, 'similar_products' => $similar_products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

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
