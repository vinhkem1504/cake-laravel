<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;
    protected $table = "Bill";

    public function getAllBill(){
        $allBills = DB::table('Bill')->get();
        return $allBills;
    }

    public function createBill($address, $phoneNumber){
        $userId = Auth::user()->user_id;
        $date = new DateTime();
        $data = [
            'user_id' => $userId,
            'address' => $userId,
            'phone_number' => $userId,
            'status' => 0,
            'date' => $date
        ];
        
    }

    public function cancleBill(){
        //Code
    }
}
