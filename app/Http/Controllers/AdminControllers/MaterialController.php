<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index() 
    {
        $materials = Material::orderBy('material_id', 'asc');
        if (!empty(request()->input('material_name'))) {
            $materials = $materials->where('material_name', 'LIKE', '%'.request()->input('material_name').'%');
        }
        // if (!empty(request()->input('quantity'))) {
        //     $materials = $materials->where('quantity', '=', request()->input('quantity'));
        // }
        if (!empty(request()->input('unit'))) {
            $materials = $materials->where('unit', '=', request()->input('unit'));
        }
        $materials = $materials->paginate(5);
        return view('admin-views.material.index', compact('materials'));
    }
    public function add() 
    {
        return view('admin-views.material.add_or_edit');
    }
    public function edit($id) 
    {
        $material = Material::find($id);
        if ($material) {
            return view('admin-views.material.add_or_edit', compact('material'));
        }
        return abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'material_name' => [
                'required',
                Rule::unique('Material', 'material_name'),
                'max:50',
            ],
            'unit' => [
                'required',
                'max:50',
            ],
        ]);
        
        $material = new Material();
        $material->material_name = $request->material_name;
        $material->unit = $request->unit;
        $material->save();
        return redirect('/admin/material/index')->with('success', 'Material created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'material_name' => [
                'required',
                Rule::unique('Material')->ignore($id, 'material_id'),
                'max:50',
            ],
        ]);
        $material = Material::find($id);
        if ($material) {
            $material->material_name = $request->input('material_name');
            $material->unit = $request->input('unit');
            $material->save();
            return redirect('/admin/material/index')->with('success', 'Material updated successfully');
        }
        return abort(404);
    }

    public function delete($id)
    {
        //dd($id);
        try {
            $material = Material::find($id);
            if ($material) {
                $material->delete();
                return redirect('/admin/material/index')->with('success', 'Material deleted successfully');
            }
            return abort(404);
        } catch (\Exception $e) {
            return redirect('/admin/material/index')->with('errors', 'Material deleted unsuccessfully');
        }
    }
}
