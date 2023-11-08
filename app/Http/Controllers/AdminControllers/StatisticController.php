<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Import_Bill;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index() 
    {
        if(request()->input('type') == 2) {
            $import_bills = Import_Bill::orderBy('date', 'desc');
            if (!empty(request()->input('start_date'))) {
                $import_bills = $import_bills->where(DB::raw('DATE(date)'), '>=' , Date(request()->input('start_date')));
            }
            if (!empty(request()->input('end_date'))) {
                $import_bills = $import_bills->where(DB::raw('DATE(date)'), '<=' , Date(request()->input('end_date')));
            }
            $import_bills = $import_bills->join('Suplier', 'Import_Bill.supplier_id', '=', 'Suplier.supplier_id')
            ->select('Import_Bill.*', 'Suplier.name as supplier_name');          
            $import_bills = $import_bills->selectSub(function ($query) {
                $query->selectRaw('COALESCE(SUM(price * quantity), 0)')
                    ->from('Details_Import_Bill')
                    ->whereColumn('Details_Import_Bill.import_bill_id', 'Import_Bill.import_bill_id');
            }, 'total_price');
            $import_bills = $import_bills->get();
            return view('admin-views.statistic', compact('import_bills'));
        } 

        $bills = Bill::orderBy('date', 'desc');
        if (!empty(request()->input('start_date'))) {
            $bills = $bills->where(DB::raw('DATE(date)'), '>=' , Date(request()->input('start_date')));
        }
        if (!empty(request()->input('end_date'))) {
            $bills = $bills->where(DB::raw('DATE(date)'), '<=' , Date(request()->input('end_date')));
        }
        $bills = $bills->select('Bill.*');
        $bills = $bills->selectSub(function ($query) {
            $query->selectRaw('COALESCE(SUM(price * quanlity), 0)')
                ->from('Bill_details')
                ->whereColumn('Bill_details.bill_id', 'Bill.bill_id');
        }, 'total_price');
        $bills = $bills->get();
        return view('admin-views.statistic', compact('bills'));
    }
}
