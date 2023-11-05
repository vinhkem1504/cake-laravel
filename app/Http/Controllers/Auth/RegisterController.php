<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    //display register page
    public function show()
    {
        return view('client-views.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */

    public function register(RegisterRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['password'] = Hash::make($request->password);
        $data['email'] = $request->email;

        $checkUser = DB::table('User')
            ->where('email', $request->email)
            ->get()
            ->count();

        if ($checkUser == 1) {
            return response()->json(['success' => false, 'error' => 'This email is already in use.']); 
        } else {
            $user = User::create($data);
            if ($user) {
                auth()->login($user);
                Session::flush();
                Auth::logout();
                return response()->json(['success'=> true,'error'=> 'Successful account registration']);
            } else {
                return response()->json(['success' => false, 'error' => 'Registration failed']);
            }
        }
    }
}
