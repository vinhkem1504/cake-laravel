<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->select('Products.productname', 'Products.product_avt_iamge', 'Products.price_default', 'Category.category_name')
            ->paginate(12);

        $category = Category::all();
        return view('client-views.home', compact('products', 'category'));
    }

    public function showUserInfo()
    {
        return view('client-views.user');
    }

    public function getListProducts()
    {
        $products = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->select('Products.productname', 'Products.product_avt_iamge', 'Products.price_default', 'Category.category_name')
            ->paginate(12);

        return response()->json($products);
    }
}
