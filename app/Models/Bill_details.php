<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill_details extends Model
{
    use HasFactory;
    protected $table = "Bill_details";

    public function getDetailsBillById($billId){
        $products = DB::table('Bill_details')
        ->where('bill_id', '=', $billId)
        ->get();

        return $products;
    }
}
