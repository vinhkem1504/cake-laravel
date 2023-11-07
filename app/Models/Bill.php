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
    protected $primaryKey = "bill_id";

    public function getAllUserBill(){
        $userId = Auth::user()->user_id;
        $allBills = DB::table('Bill')
        ->where('user_id', '=', $userId)
        ->orderBy('status', 'asc')
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

        $billId = DB::table('Bill')->insertGetId($data);

        return $billId;
    }

    public function cancelBill($billId){
        $data = ['status' => 2];
        $bill = DB::table('Bill')
        ->where('bill_id', '=', $billId)
        ->first();

        if($bill->status == 0){
            $cancel = DB::table('Bill')
            ->where('bill_id', '=', $billId)
            ->update($data);

            return $cancel;
        }
        
        return false;
    }
}
