<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class SizeController extends Controller
{
    public function index() 
    {
        $sizes = Size::orderBy('size_id', 'asc');
        if (!empty(request()->input('value'))) {
            $sizes = $sizes->where('value', 'LIKE', '%'.request()->input('value').'%');
        }
        $sizes = $sizes->paginate(5);
        return view('admin-views.size.index', compact('sizes'));
    }
    public function add() 
    {
        return view('admin-views.size.add_or_edit');
    }
    public function edit($id) 
    {
        $size = Size::find($id);
        if ($size) {
            return view('admin-views.size.add_or_edit', compact('size'));
        }
        return abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                Rule::unique('Size', 'value'),
                'max:50',
            ],
        ]);
        $size = new Size();
        $size->value = $request->value;
        $size->save();
        return redirect('/admin/size/index')->with('success', 'Size created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                Rule::unique('Size')->ignore($id, 'size_id'),
                'max:50',
            ],
        ]);
        $size = Size::find($id);
        if ($size) {
            $size->value = $request->input('value');
            $size->save();
            return redirect('/admin/size/index')->with('success', 'Size updated successfully');
        }
        return abort(404);
    }

    public function delete($id)
    {
        try {
            $size = Size::find($id);
            if ($size) {
                $size->delete();
                return redirect('/admin/size/index')->with('success', 'Size deleted successfully');
            }
            return abort(404);
        } catch (\Exception $e) {
            return redirect('/admin/size/index')->with('errors', 'Size deleted unsuccessfully');
        }
    }
}
