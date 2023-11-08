<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_details;
use App\Models\Details_Import_Bill;
use App\Models\Products;
use App\Models\Suplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeAdminController extends Controller
{    
    public function index()
    {
        $totalOrders = Bill::where('status', '!=', 2)->count();
        $totalProducts = Products::count(); 
        $totalUsers = User::count();
        $totalSuppliers = Suplier::count();

        //$totalSales = DB::table('Bill_details')->sum('quanlity * price');
        $totalSales = Bill_details::query()->sum(DB::raw('quanlity * price'));
        $totalImportBills = Details_Import_Bill::query()->sum(DB::raw('quantity * price'));       

        return view('admin-views.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'totalSuppliers',
            'totalSales',
            'totalImportBills'
        ));

        
    }
    

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin-views.login');
    }
}