<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
class Users extends Model
{
    use HasFactory;

    function checkLogin($email, $password){
        if($email && $password){
            $user = DB::table('user')->where('email', '=', $email)->where('password', '=', $password)->first();
            return $user;
        }
        return false;
    }

    function register($name, $email, $password){
        if($name && $email && $password){
            try{
                $user = DB::table('user')->insert([
                    'name'=>$name,
                    'email'=>$email,
                    'password'=>$password,
                    'role'=>'0'
                ]);
                
            }catch(QueryException $e){
                return false;
            }
            return $user;
        }

        return false;
    }
}
