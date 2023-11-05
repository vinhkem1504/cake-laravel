<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('client-views.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $cart = json_decode($request->cart);
        // dd($cart);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // $user = Auth::user();
            // Session::put('user', $user);
            // return response()->json(['success' => true, 'queries' => $credentials]);
            // return redirect(route('client-views.home'));
            $userId = Auth::user()->user_id;
            $checkCart = DB::table('Cart')
            ->where('user_id', '=', $userId)
            ->select('*')
            ->first();
            
            if(!$checkCart){
                // dd($checkCart);
                foreach ($cart as $item) {
                    $data = [
                        'user_id' => intval($userId),
                        'product_details_id' => intval($item->product_details_id),
                        'quanlity' => intval($item->quanlity)
                    ];
                    // dd($data);
                    DB::table('Cart')->insert($data);
                }
                $cart = DB::table('Cart')
                ->join('Products_details', 'Products_details.product_details_id', '=', 'Cart.product_details_id')
                ->where('user_id', '=', $userId)
                ->select(['Products_details.price', 'Cart.quanlity'])
                ->get();
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item->price * $item->quanlity;
                }
                Session::put('cartLength', $cart->count());
                Session::put('total', $total);
                // dd($total);
            }
            else{
                $cart = DB::table('Cart')
                ->join('Products_details', 'Products_details.product_details_id', '=', 'Cart.product_details_id')
                ->where('user_id', '=', $userId)
                ->select(['Products_details.price', 'Cart.quanlity'])
                ->get();
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item->price * $item->quanlity;
                }
                Session::put('cartLength', $cart->count());
                Session::put('total', $total);
                // dd($total);
            }
            return redirect('/')->with('success', "Account successfully login.");
        } else {
            return response()->json(['error' => false, 'queries' => $credentials]);
        }
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }
}
