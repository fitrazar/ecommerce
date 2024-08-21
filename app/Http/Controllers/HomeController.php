<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)->get();


        $categories = Category::all();
        $products_2 = Product::where('status', 1)->get();

        $data = [];
        foreach ($categories as $key) {
            $list_product = [];

            if (count($list_product) < 3) {
                foreach ($products_2 as $key2) {
                    if ($key->id === $key2->category_id) {
                        $row = [
                            'desc' => $key2->description,
                            'image' => $key2->cover,
                            'name' => $key2->name,
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
                'cover' => $list_product[0]['image'],
                'linkButton' => "/products/$key->slug"
            ];

            $data[] = $row;
        }


        return view('home', ['slider_data' => $products, 'data' => $data]);
    }
}
