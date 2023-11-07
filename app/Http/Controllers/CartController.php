<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cart;

    function __construct(){
        $this->cart = new Cart;
    }

    public function showCart(){
        $check = Auth::check();
        
        if($check){
            $userId = Auth::user()->user_id;
            $cart = $this->cart->getCartUser($userId);

            $total = 0;
            foreach ($cart as $product) {
                $total += $product->price * $product->quanlity;
            }
            Session::put('cartLength', $cart->count());
            Session::put('total', $total);
            return view('client-views.cart', compact('cart', 'total'));
        }
        else{
            $cart = null;
            $total = null;
            return view('client-views.cart', compact('cart', 'total'));
        }
        
    }

    public function addProductToCart(Request $request){
        // Get data from request
        $productId = $request->productId;
        $sizeId = $request->sizeId;
        $flavourId = $request->flavourId;
        $quantity = $request->quantity;
        //Check user login
        $check = Auth::check();
        
        if($check){
            $userId = Auth::user()->user_id;
            $cart = $this->cart->addProductToCartUser($userId, $productId, $sizeId, $flavourId, $quantity);
            return $cart;
        }
        else{
            $product = $this->cart->addProductToCartGuest($productId, $sizeId, $flavourId, $quantity);
            return $product;
        }

        return 'error';
    }

    public function addOneProductFromCart(Request $request){
        // Get data from request
        $detailsId = $request->detailsId;

        //Check user login
        $check = Auth::check();
        
        if($check){
            $userId = Auth::user()->user_id;
            $cart = $this->cart->addOneProductFromCartUser($userId, $detailsId);
            $total = 0;
            foreach ($cart as $product) {   
                $total += $product->price * $product->quanlity;
            }
            Session::put('cartLength', $cart->count());
            Session::put('total', $total);
            return $cart;
        }
        return json_encode('guest');
    }

    public function deleteOneProductFromCart(Request $request){
        // Get data from request
        $detailsId = $request->detailsId;

        //Check user login
        $check = Auth::check();
        
        if($check){
            $userId = Auth::user()->user_id;
            $cart = $this->cart->deleteOneProductFromCartUser($userId, $detailsId);
            $total = 0;
            foreach ($cart as $product) {   
                $total += $product->price * $product->quanlity;
            }
            Session::put('cartLength', $cart->count());
            Session::put('total', $total);
            return $cart;
        }
        return json_encode('guest');
    }

    public function deleteOneTypeProductFromCart(Request $request){
        // Get data from request
        $detailsId = $request->detailsId;

        //Check user login
        $check = Auth::check();
        
        if($check){
            $userId = Auth::user()->user_id;
            $cart = $this->cart->deleteOneTypeProductFromCartUser($userId, $detailsId);
            $total = 0;
            foreach ($cart as $product) {   
                $total += $product->price * $product->quanlity;
            }
            Session::put('cartLength', $cart->count());
            Session::put('total', $total);
            return $cart;
        }
        return json_encode('guest');
    }
}
