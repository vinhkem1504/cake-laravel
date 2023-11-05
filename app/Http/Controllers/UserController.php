<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Bill_details;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $bill;
    private $billDetails;
    private $cart;

    function __construct()
    {
        $this->bill = new Bill();
        $this->billDetails = new Bill_details();
        $this->cart = new Cart();
    }

    function getUser(){
        $user = Auth::user();
        return $user;
    }

    function updateUser(Request $req){
        // dd($req);
        $user = User::find(Auth::user()->user_id);
        $userName = $req->userName;
        $userImage = $req->file('userImage'); // Lấy tệp hình ảnh
        $password = $req->password;
        $newPassword = $req->newPassword;
        
        if ($userImage) {
            $name = $userImage->getClientOriginalName();
            $userImage->move(public_path('user-images'),$name);
            $user->avatar_image = '/user-images/'.$name;
            $user->save();
            return redirect('/user')->with('message', 'update success');
        }

        if($userName !== $user->name){
            $user->name = $userName;
            $user->save();
        }

        if($password){
            
            if(Hash::check($password, $user->password)){
                $user->password = Hash::make($newPassword);
                $user->save();
            }
        }
        
        return redirect('/user');
    }

    function getProductsFromCart(){
        $products = $this->cart->getProductsFromCart();

        return $products;
    }

    function createUserBill(Request $request){
        $address = $request->address;
        $phoneNumber = $request->phoneNumber;
        $newBill = $this->bill->createBill($address, $phoneNumber);
        dd($newBill);
        return 'ok';
    }

    function showCheckoutCart(){
        $products = $this->cart->getProductsFromCart();
        return view('client-views.checkout', compact('products'));
    }

    function getUserBill(){
        $bill = $this->bill->getAllUserBill();

        return view('client-views.userBills', compact('bill'));
    }

    function getDetailsBill($billId){
        $products = $this->billDetails->getDetailsBillById($billId);

        return $products;
    }
}
