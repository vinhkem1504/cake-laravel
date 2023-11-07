<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Import_Bill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Details_Import_Bill;
use App\Models\Material;

class DetailsImportBillController extends Controller
{
    public function add($import_bill_id) 
    {
        $materials = Material::all();
        return view('admin-views.details_import_bill.add_or_edit', compact('materials', 'import_bill_id'));
    }
    public function edit($id) 
    {
        $details_import_bill = Details_Import_Bill::find($id);
        if(!$details_import_bill) {
            return abort(404);
        }
        $import_bill_id = $details_import_bill->import_bill_id;
        $materials = Material::all();
        return view('admin-views.details_import_bill.add_or_edit', compact('details_import_bill', 'materials', 'import_bill_id'));
    }
    public function insert($import_bill_id, Request $request)
    {
        $request->validate([
            'price' => [
                'required',
                'numeric',
                'min:0.5',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'material_id' => [
                'required',
            ],
            'import_bill_id'=> [
                'required',
            ]
        ]);
        $details_import_bill = new Details_Import_Bill();
        $details_import_bill->price = $request->input('price');
        $details_import_bill->quantity = $request->input('quantity');
        $details_import_bill->material_id = $request->input('material_id');
        $details_import_bill->import_bill_id = $request->input('import_bill_id');
        $details_import_bill->save();
        return redirect('/admin/import_bill/edit/'.$details_import_bill->import_bill_id)->with('success', 'Import Bill Detail created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'price' => [
                'required',
                'numeric',
                'min:0.5',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],
            'material_id' => [
                'required',
            ],
            'import_bill_id'=> [
                'required',
            ]
        ]);
        $details_import_bill = Details_Import_Bill::find($id);
        if (!$details_import_bill) {
            return abort(404);
        }
        $details_import_bill->price = $request->input('price');
        $details_import_bill->quantity = $request->input('quantity');
        $details_import_bill->material_id = $request->input('material_id');
        $details_import_bill->save();
        return redirect('/admin/import_bill/edit/'.$details_import_bill->import_bill_id)->with('success', 'Import Bill Detail updated successfully');
    }

    public function delete($id)
    {
        try {
            $details_import_bill = Details_Import_Bill::find($id);
            if (!$details_import_bill) {
                return abort(404);
            } 
            $details_import_bill->delete();
            return redirect('/admin/import_bill/edit/'.$details_import_bill->import_bill_id)->with('success', 'Import Bill Detail deleted successfully');
        } catch (\Exception $e) {
            return redirect('/admin/import_bill/edit/'.$details_import_bill->import_bill_id)->with('errors', 'Import Bill Detail deleted unsuccessfully');
        }
    }
}
