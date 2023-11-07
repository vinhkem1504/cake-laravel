<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller   
{
    public function index()
    {
        return view("admin-views.login");
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            "username"=> 'required|string',
            'password'=> 'required'
        ]);

        if($validator->passes()){
            if(Auth::guard('admin')->attempt(['username'=> $request->username, 'password'=> 
            $request->password], $request->get('remember'))){
                $admin = Auth::guard('admin')->user();

                return redirect()->route('admin-views.dashboard');
            }
            else{
                return redirect()->route('admin-views.login')->with('error', 'Either username/Password is incorrect');
            }
            
        } else{
            return redirect()->route('admin-views.login')
            ->withErrors($validator)
            ->withInput($request->only('username'));
        }
    }
}