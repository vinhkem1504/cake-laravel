<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        $value = $this->checkRegister($request->email);
        $json = json_decode($value, true);
        dd($json);
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

    public function checkRegister($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json(['success' => true, 'data' => $user]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
