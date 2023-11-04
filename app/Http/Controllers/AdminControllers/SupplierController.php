<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index() 
    {
        $suppliers = Suplier::orderBy('supplier_id', 'asc');
        if (!empty(request()->input('name'))) {
            $suppliers = $suppliers->where('name', 'LIKE', '%'.request()->input('value').'%');
        }
        if (!empty(request()->input('phone'))) {
            $suppliers = $suppliers->where('phone', '=', request()->input('phone'));
        }
        if (!empty(request()->input('address'))) {
            $suppliers = $suppliers->where('name', 'LIKE', '%'.request()->input('address').'%');
        }
        $suppliers = $suppliers->paginate(5);
        return view('admin-views.supplier.index', compact('suppliers'));
    }
    public function add() 
    {
        return view('admin-views.supplier.add_or_edit');
    }
    public function edit($id) 
    {
        $supplier = Suplier::find($id);
        if ($supplier) {
            return view('admin-views.supplier.add_or_edit', compact('supplier'));
        }
        return abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:50',
            ],
            'phone' => [
                'required',
                Rule::unique('Suplier'),
                'regex:/^\d{9,10}$/',
            ],
            'address' => [
                'required',
                'max:100'
            ],
        ]);
        $supplier = new Suplier();
        $supplier->name = $request->input('name');
        $supplier->phone = $request->input('phone');
        $supplier->address = $request->input('address');
        $supplier->save();
        return redirect('/admin/supplier/index')->with('success', 'Suplier created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:50',
            ],
            'phone' => [
                'required',
                Rule::unique('Suplier')->ignore($id, 'supplier_id'),
                'regex:/^\d{9,10}$/',
            ],
            'address' => [
                'required',
                'max:100'
            ],
        ]);
        $supplier = Suplier::find($id);
        if ($supplier) {
            $supplier->name = $request->input('name');
            $supplier->phone = $request->input('phone');
            $supplier->address = $request->input('address');
            $supplier->save();
            return redirect('/admin/supplier/index')->with('success', 'Suplier updated successfully');
        }
        return abort(404);
    }

    public function delete($id)
    {
        try {
            $supplier = Suplier::find($id);
            if ($supplier) {
                $supplier->delete();
                return redirect('/admin/supplier/index')->with('success', 'Suplier deleted successfully');
            }
            return abort(404);
        } catch (\Exception $e) {
            return redirect('/admin/supplier/index')->with('errors', 'Suplier deleted unsuccessfully');
        }
    }
}
