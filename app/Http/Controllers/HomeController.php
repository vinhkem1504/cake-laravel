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
            ->paginate(8);

        $category = Category::all();
        return view('client-views.home', compact('products', 'category'));
    }

    public function showUserInfo()
    {
        return view('client-views.user');
    }
    public function showUserBills(){
        return view('client-views.userBills');
    }

    public function getListProducts(Request $request)
    {
        $value = $request->input('category_name');
        if($value == null){
             $products = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->select('Products.productname', 'Products.product_avt_iamge', 'Products.price_default', 'Category.category_name')
            ->paginate(8);
        }
        return response()->json($products);
    }

    public function filterCategory(Request $request)
    {
        $value = $request->input('category_name');
            $products = DB::table('Products')
                ->join('Category', 'Products.category_id', '=', 'Category.category_id')
                ->where('Category.category_name', '=', $value)
                ->select('Products.productname', 'Products.product_avt_iamge', 'Products.price_default', 'Category.category_name')
                ->paginate(8);
        return response()->json($products);
    }
}
