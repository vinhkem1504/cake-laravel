<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Import_Bill;
use App\Models\Suplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Details_Import_Bill;

class ImportBillController extends Controller
{
    public function index() {
        $import_bills = Import_Bill::orderBy('date', 'desc');
        
        if (!empty(request()->input('date'))) {
            $import_bills = $import_bills->where('Import_Bill.date', 'LIKE', '%' . request()->input('date') . '%');
        }
        if (!empty(request()->input('supplier_id'))) {
            $import_bills = $import_bills->where('Import_Bill.supplier_id', '=', request()->input('supplier_id'));
        }
        $import_bills = $import_bills->join('Suplier', 'Import_Bill.supplier_id', '=', 'Suplier.supplier_id')
            ->select('Import_Bill.*', 'Suplier.name as supplier_name');
            
        $import_bills = $import_bills->selectSub(function ($query) {
            $query->selectRaw('COALESCE(SUM(price * quantity), 0)')
                ->from('Details_Import_Bill')
                ->whereColumn('Details_Import_Bill.import_bill_id', 'Import_Bill.import_bill_id');
        }, 'total_price');
    
        $import_bills = $import_bills->paginate(5);
        $suppliers = Suplier::all();
        return view('admin-views.import_bill.index', compact('import_bills', 'suppliers'));
    }
    public function add() 
    {
        $suppliers = Suplier::all();
        return view('admin-views.import_bill.add_or_edit', compact('suppliers'));
    }
    public function edit($id) 
    {
        $import_bill = Import_Bill::find($id);
        if (!$import_bill) {
            return abort(404);
        }
        $details_import_bills = Details_Import_Bill::where('import_bill_id','=', $id);
        $total = 0;
        foreach ($details_import_bills->get() as $detail) {
            $total += $detail->price * $detail->quantity;
        }

        $details_import_bills = $details_import_bills->join('Material', 'Details_Import_Bill.material_id', '=', 'Material.material_id')
            ->select('Details_Import_Bill.*', 'Material.material_name as material_name')->paginate(5);
            

        $suppliers = Suplier::all();
        if ($import_bill) {
            return view('admin-views.import_bill.add_or_edit', compact('import_bill', 'suppliers', 'details_import_bills', 'total'));
        }
        return abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'date' => [
                'required',
            ],
            'supplier_id' => [
                'required',
            ]
        ]);
        
        $import_bill = new Import_Bill();
        $import_bill->date = $request->input('date');
        $import_bill->supplier_id = $request->input('supplier_id');
        $import_bill->save();
        return redirect('/admin/import_bill/edit/'.$import_bill->id)->with('success', 'Import Bill created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'date' => [
                'required',
            ],
            'supplier_id' => [
                'required',
            ],
        ]);
        //$details_import_bills = Details_Import_Bill::where('import_bill_id','=', $id);
        $import_bill = Import_Bill::find($id);
        if ($import_bill) {
            $import_bill->date = $request->input('date');
            $import_bill->supplier_id = $request->input('supplier_id');
            $import_bill->save();
            return redirect('/admin/import_bill/index')->with('success', 'Import Bill updated successfully');
        }
        return abort(404);
    }

    public function delete($id)
    {
        try {
            $import_bill = Import_Bill::find($id);
            if ($import_bill) {
                $import_bill->delete();
                return redirect('/admin/import_bill/index')->with('success', 'Import Bill deleted successfully');
            }
            return abort(404);
        } catch (\Exception $e) {
            return redirect('/admin/import_bill/index')->with('errors', 'Import Bill deleted unsuccessfully');
        }
    }
}
