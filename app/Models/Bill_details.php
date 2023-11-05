<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_details extends Model
{
    use HasFactory;
    protected $table = "Bill_details";
    protected $primaryKey = "bill_product_id";
}
