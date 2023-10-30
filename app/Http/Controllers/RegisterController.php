<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class RegisterController extends Controller
{
    //
    private $users;

    function __construct()
    {
        $this->users = new Users();
    }
    public function register(Request $req){
        $name = $req->first_name . " " . $req->last_name;
        $email = $req->email;
        $password = $req->password;

        $result = $this->users->register($name, $email, $password);

        if($result){
            dd($result);
        }
        return view('client-views.register', ['message'=>'Register Failed']);
    }
}
