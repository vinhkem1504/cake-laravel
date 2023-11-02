<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    // Request $request
    public function index($value)
    {
        $product  = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->where('Products.product_id', '=', $value)
            ->select('*')
            ->get();
        $product_details = DB::table('Products_details')
            ->where('Products_details.product_id', '=', $value)
            ->select('*')
            ->get();
        $products_related = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->where('Category.category_id', '=', $product[0]->category_id)
            ->where('Products.product_id', '!=', $value)
            ->select('Products.productname', 'Products.product_avt_iamge', 'Products.price_default', 'Category.category_name')
            ->get();
        $size = DB::table('Products_details')
            ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
            ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
            ->where('Products_details.product_id', '=', $value)
            ->select('Size.value')
            ->groupBy('Size.value')
            ->get();
        $flavour = DB::table('Products_details')
            ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
            ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
            ->where('Products_details.product_id', '=', $value)
            ->select('Flavour.value')
            ->groupBy('Flavour.value')
            ->get();
        return view(
            'client-views.productDetails',
            compact('value', 'product', 'product_details', 'products_related', 'size', 'flavour')
        );
    }

    public function getSize($value)
    {
        $size = DB::table('Products_details')
            ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
            ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
            ->where('Products_details.product_id', '=', $value)
            ->select('Size.value')
            ->groupBy('Size.value')
            ->get();
        return response()->json($size);
    }

    public function getProductDetails(Request $request)
    {
        $size = $request->input('size');
        $flavour = $request->input('flavour');
        $product_id = $request->input('product_id');

        $productDetailInfo = DB::table('Products_details')
            ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
            ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
            ->where('Products_details.product_id', '=', $product_id)
            ->where('Size.value', '=', $size)
            ->where('Flavour.value', '=', $flavour)
            ->select('Products_details.price', 'Products_details.image')
            ->get();

        if (empty(json_decode($productDetailInfo))) {
            return response()->json(['data'=>$productDetailInfo,'error' => true]);
        } else {
            return response()->json(['data'=>$productDetailInfo,'error' => false]);
        }
    }
}
