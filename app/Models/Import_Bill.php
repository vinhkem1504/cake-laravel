<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import_Bill extends Model
{
    use HasFactory;
    protected $table = "Import_Bill";
    protected $primaryKey = "import_bill_id";
}
