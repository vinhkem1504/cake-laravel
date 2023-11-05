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

    public function getAllUserBill(){
        $userId = Auth::user()->user_id;
        $allBills = DB::table('Bill')
        ->where('user_id', '=', $userId)
        ->get();

        return $allBills;
    }

    public function createBill($address, $phoneNumber){
        $userId = Auth::user()->user_id;
        $date = new DateTime();
        $data = [
            'user_id' => $userId,
            'address' => $address,
            'phone_number' => $phoneNumber,
            'status' => 0,
            'date' => $date
        ];

        $bill = DB::table('Bill')->insert($data);
        dd($bill);
        return $bill;
    }

    public function cancleBill($billId){
        $data = ['status' => 2];

        DB::table('Bill')
        ->where('bill_id', '=', $billId)
        ->update($data);
    }
}
