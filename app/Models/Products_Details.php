<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_Details extends Model
{
    use HasFactory;
    protected $table = "Products_details";
    protected $primaryKey = "product_details_id"; 
}
