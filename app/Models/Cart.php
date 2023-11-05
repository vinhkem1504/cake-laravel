<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Cart extends Model
{
    use HasFactory;
    protected $table = "Cart";
    
    //Login case
    public function getCartUser($userId){
        $cart = DB::table('Cart')
        ->join('Products_details', 'Products_details.product_details_id', '=', 'Cart.product_details_id')
        ->join('Products', 'Products.product_id', '=', 'Products_details.product_id')
        ->where('user_id', '=', $userId)
        ->select(['Cart.quanlity', 'Products_details.price', 'Products_details.image', 'Products.productname', 'Products_details.product_details_id'])
        ->groupBy(['Cart.quanlity', 'Products_details.price', 'Products_details.image', 'Products.productname', 'Products_details.product_details_id'])
        ->get();
        return $cart;
    }

    public function checkExistProductUser($userId, $detailsId){
        $productQuantity = DB::table('Cart')
        ->where('user_id', '=', $userId)
        ->where('product_details_id', '=', $detailsId)
        ->first();

        if($productQuantity && intval($productQuantity->quanlity) > 0){
            return intval($productQuantity->quanlity);
        }
        return 0;
    }

    public function addProductToCartUser($userId, $productId, $sizeId, $flavourId, $quantity){
        //get detailsId
        $detailsId = DB::table('Products_details')
        ->where('product_id', '=', $productId)
        ->where('size_id', '=', $sizeId)
        ->where('flavour_id', '=', $flavourId)
        ->select('product_details_id')
        ->first();

        //check exist product
        $check = $this->checkExistProductUser($userId, $detailsId->product_details_id);

        if($check > 0){
            $data = [
                'quanlity' => intval($quantity) + $check
            ];
            DB::table('Cart')
            ->where('user_id', '=', $userId)
            ->where('product_details_id', '=', $detailsId->product_details_id)
            ->update($data);
            $cart = DB::table('Cart')->where('user_id', '=', $userId)->get();
            return $cart;
        }
        else{
            $data = [
                'user_id' => intval($userId),
                'product_details_id' => intval($detailsId->product_details_id),
                'quanlity' => intval($quantity)
            ];
            DB::table('Cart')->insert($data);
            $cart = DB::table('Cart')->where('user_id', '=', $userId)->get();
            return $cart;
        }
    }

    public function addOneProductFromCartUser($userId, $detailsId){
        $productQuantity = DB::table('Cart')
        ->where('user_id', '=', $userId)
        ->where('product_details_id', '=', $detailsId)
        ->first();

        $data = [
            'quanlity' => intval($productQuantity->quanlity) + 1
        ];

        DB::table('Cart')
        ->where('user_id', '=', $userId)
        ->where('product_details_id', '=', $detailsId)
        ->update($data);

        $cart = DB::table('Cart')->where('user_id', '=', $userId)->get();
        return $cart;
    }

    public function deleteOneProductFromCartUser($userId, $detailsId){
        $productQuantity = DB::table('Cart')
        ->where('user_id', '=', $userId)
        ->where('product_details_id', '=', $detailsId)
        ->first();

        $data = [
            'quanlity' => intval($productQuantity->quanlity) - 1
        ];

        DB::table('Cart')
        ->where('user_id', '=', $userId)
        ->where('product_details_id', '=', $detailsId)
        ->update($data);

        $cart = DB::table('Cart')->where('user_id', '=', $userId)->get();
        return $cart;
    }

    public function deleteOneTypeProductFromCartUser($userId, $detailsId){
        DB::table('Cart')
        ->where('user_id', '=', $userId)
        ->where('product_details_id', '=', $detailsId)
        ->delete();

        $cart = DB::table('Cart')
        ->join('Products_details', 'Products_details.product_details_id', '=', 'Cart.product_details_id')
        ->join('Products', 'Products.product_id', '=', 'Products_details.product_id')
        ->where('user_id', '=', $userId)
        ->select(['Cart.quanlity', 'Products_details.price', 'Products_details.image', 'Products.productname', 'Products_details.product_details_id'])
        ->groupBy(['Cart.quanlity', 'Products_details.price', 'Products_details.image', 'Products.productname', 'Products_details.product_details_id'])
        ->get();
        return $cart;
    }

    //Guest case

    //Data: quantity, price, detailsId, imageDetails, name
    public function getCartGuest($userId){
        $cart = DB::table('Cart')
        ->join('Products_details', 'Products_details.product_details_id', '=', 'Cart.product_details_id')
        ->join('Products', 'Products.product_id', '=', 'Products_details.product_id')
        ->where('user_id', '=', $userId)
        ->select(['Cart.quanlity', 'Products_details.price', 'Products_details.image', 'Products.productname', 'Products_details.product_details_id'])
        ->groupBy(['Cart.quanlity', 'Products_details.price', 'Products_details.image', 'Products.productname', 'Products_details.product_details_id'])
        ->get();
        return $cart;
    }

    //Data: quantity, price, detailsId, imageDetails, name
    public function addProductToCartGuest($productId, $sizeId, $flavourId, $quantity){
        //get detailsId
        $detailsId = DB::table('Products_details')
        ->join('Products', 'Products.product_id', '=', 'Products_details.product_id')
        ->where('Products_details.product_id', '=', $productId)
        ->where('size_id', '=', $sizeId)
        ->where('flavour_id', '=', $flavourId)
        ->select(['Products_details.product_details_id', 'Products_details.image', 'Products_details.price', 'Products.productname'])
        ->groupBy(['Products_details.product_details_id', 'Products_details.image', 'Products_details.price', 'Products.productname'])
        ->first();

        $product = array(
            'guest' => 'true',
            'product_details_id' => $detailsId->product_details_id, 
            'quanlity' => $quantity, 
            'price' => $detailsId->price, 
            'image' => $detailsId->image, 
            'productname' => $detailsId->productname
        );

        return $product;
        
    }
}
