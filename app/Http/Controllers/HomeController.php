<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $data =
            [
                [
                    'title' => 'Womens Footwears',
                    'card' => [
                        [
                            'desc' => 'Black Low Heel Shoes Suede Womens Footwears For Office Daily And Workplace Wear',
                            'image' => 'assets/images/product_1.jpg'
                        ]
                    ],
                    'linkButton' => '/'
                ],
                [
                    'title' => 'Womens High Heel Sandals',
                    'card' => [
                        [
                            'desc' => 'Black Low Heel Shoes Suede Womens Footwears For Office Daily And Workplace Wear',
                            'image' => 'assets/images/product_1.jpg'
                        ]
                    ],
                    'linkButton' => '/'
                ],
            ];
        return view('home', ['data' => $data]);
    }
}
