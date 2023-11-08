<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
    public function index() 
    {
        $users = DB::table('User')
        ->select('User.user_id', 'User.name', 'User.email')
        ->selectRaw('COUNT(Bill.bill_id) as total_bills')
        ->selectRaw('COALESCE(SUM(Bill_details.price), 0) as total_bill_amount')
        ->leftJoin('Bill', 'User.user_id', '=', 'Bill.user_id')
        ->leftJoin('Bill_details', 'Bill.bill_id', '=', 'Bill_details.bill_id')
        ->groupBy('User.user_id');
        if (!empty(request()->input('name'))) {
            $users = $users->where('name', 'LIKE', '%'.request()->input('name').'%');
        }
        if (!empty(request()->input('email'))) {
            $users = $users->where('email', 'LIKE', '%'.request()->input('email').'%');
        }
        $users = $users->paginate(5);   
        return view('admin-views.user.index', compact('users'));
    }
}
