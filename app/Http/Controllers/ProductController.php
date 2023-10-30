<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function show()
    {
        $products = Products::all();

        return view('client-views.productList', compact('products'));
    }
}



