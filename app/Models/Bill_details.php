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
        ->join('Products_details', 'Products_details.product_details_id', '=', 'Bill_details.product_details_id')
        ->join('Products', 'Products.product_id', '=', 'Products_details.product_id')
        ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
        ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
        ->where('bill_id', '=', $billId)
        ->select(['Products_details.product_details_id', 'Bill_details.quanlity', 'Products_details.price', 'Size.value AS sizeValue', 'Flavour.value AS flavourValue', 'Products.productname'])
        ->groupBy(['Products_details.product_details_id', 'Bill_details.quanlity', 'Products_details.price', 'Size.value', 'Flavour.value', 'Products.productname'])
        ->get();

        return $products;
    }
}
