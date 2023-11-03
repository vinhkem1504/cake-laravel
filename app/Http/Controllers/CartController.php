<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addProductToCart(Request $request){
        $productId = $request->productId;
        if($user = Auth::user()){
            
        }
        $token = $request->input('_token');
        return $token;
    }
}
