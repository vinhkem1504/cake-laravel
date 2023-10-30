<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        return view('client-views.home');
    }

    public function showUserInfo(){
        return view('client-views.user');
    }
}
