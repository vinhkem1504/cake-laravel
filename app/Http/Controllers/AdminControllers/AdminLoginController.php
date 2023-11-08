<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Authenticatable;

class AdminLoginController extends Controller   
{
    public function index()
    {
        return view("admin-views.login");
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            "username" => 'required|string',
            'password'  => 'required'
        ]);

        if($validator->passes()){
            if(Auth::guard('admin')->attempt(['username'=> $request->username, 'password'=> 
            $request->password])){
                //$admin = Auth::guard('admin')->admin();

                return redirect()->route('admin-views.dashboard');
            }
            else{
                return redirect()->route('admin-views.login')->with('error', 'Either username/password is incorrect');
            }
            // if (auth('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            //     // Authentication successful
            //     return redirect()->route('admin-views.dashboard'); // Redirect to the admin dashboard or any other route
            // } else {
            //     // Authentication failed
            //     return redirect()->route('admin-views.login')->with('error', 'Either username/password is incorrect'); // Redirect back with an error message
            // }
             
            
        } else{
            return redirect()->route('admin-views.login')
            ->withErrors($validator)
            ->withInput($request->only('username'));
        }
    }

    
    
}