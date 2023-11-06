<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Rate_Comments;
use Illuminate\Support\Facades\Auth;
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
            ->select(['Size.value', 'Size.size_id'])
            ->groupBy(['Size.value', 'Size.size_id'])
            ->get();
        $flavour = DB::table('Products_details')
            ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
            ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
            ->where('Products_details.product_id', '=', $value)
            ->select(['Flavour.value', 'Flavour.flavour_id'])
            ->groupBy(['Flavour.value', 'Flavour.flavour_id'])
            ->get();
        $cmt = DB::table('Rate_comments')
            ->join('User', 'User.user_id', '=', 'Rate_comments.user_id')
            ->where('Rate_comments.product_id', '=', $product[0]->product_id)
            ->select('User.name', 'User.avatar_image', 'Rate_comments.description', 'Rate_comments.value', 'Rate_comments.created_at')
            ->get()->count();
        return view(
            'client-views.productDetails',
            compact('value', 'product', 'product_details', 'products_related', 'size', 'flavour', 'cmt')
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
            ->where('Size.size_id', '=', $size)
            ->where('Flavour.flavour_id', '=', $flavour)
            ->select('Products_details.price', 'Products_details.image')
            ->get();

        if (empty(json_decode($productDetailInfo))) {
            return response()->json(['data' => $productDetailInfo, 'error' => true]);
        } else {
            return response()->json(['data' => $productDetailInfo, 'error' => false]);
        }
    }

    public function getRating($product_id)
    {
        $cmt = DB::table('Rate_comments')
            ->join('User', 'User.user_id', '=', 'Rate_comments.user_id')
            ->where('Rate_comments.product_id', '=', $product_id)
            ->select('User.name', 'User.avatar_image', 'Rate_comments.description', 'Rate_comments.value', 'Rate_comments.created_at')
            ->get();

        return response()->json(['data' => $cmt]);
    }

    public function createRating(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->user_id;
            // $comment = Rate_Comments::created($data);
            $comment = new Rate_Comments;
            $comment->user_id = $user_id;
            $comment->description = $request->input('description');
            $comment->value = $request->input('value');
            $comment->product_id = $request->input('product_id');
            $comment->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Please sign in to comment']);
        }
    }


    // get list + phan trang
    public function getAllProduct()
    {
        $products = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->select('*')
            ->paginate(16);
        $count = DB::table('Products')
        ->join('Category', 'Products.category_id', '=', 'Category.category_id')
        ->select('*')->get()->count();
        
        return response()->json(['products' => $products, 'count' => $count]);
    }

    public function showAllProduct()
    {
        $products = DB::table('Products')
            ->join('Category', 'Products.category_id', '=', 'Category.category_id')
            ->select('*')
            ->paginate(16);

        $category = Category::all();
        return view('client-views.shopProduct', compact('products', 'category'));
    }
}
