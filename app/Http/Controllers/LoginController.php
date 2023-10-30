<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $users;

    function __construct()
    {
        $this->users = new Users();
    }

    public function index(){
        return view('client-views.login');
    }

    public function checkLogin(Request $req){
        // echo $req->email;
        $isLogin = $this->users->checkLogin($req->email, $req->password);
        // dd($isLogin);
        if($isLogin){
            // dd($isLogin);
            return 'ok';
        }
        return view('client-views.login', ['message'=>'Login Failed']);
    }
}
