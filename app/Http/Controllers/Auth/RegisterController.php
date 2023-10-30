<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        $user = User::create($data);
        if ($user) {
            //Đoạn mã này đăng nhập người dùng mới đăng ký bằng cách sử dụng auth(), 
            //một đối tượng Laravel được sử dụng cho xác thực người dùng. 
            // Phương thức login() được gọi với đối tượng $user, điều này sẽ xác thực người dùng và tạo một phiên đăng nhập cho họ.
            auth()->login($user);

            // register susscess => vao Home page luon 
            return redirect('/')->with('success', "Account successfully registered.");
        } else {
            return response()->json(['success' => false, 'error' => 'Registration failed']);
        }
    }

}
