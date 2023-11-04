<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Flavour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class FlavourController extends Controller
{
    public function index() 
    {
        $flavours = Flavour::orderBy('flavour_id', 'asc');
        if (!empty(request()->input('value'))) {
            $flavours = $flavours->where('value', 'LIKE', '%'.request()->input('value').'%');
        }
        $flavours = $flavours->paginate(5);
        return view('admin-views.flavour.index', compact('flavours'));
    }
    public function add() 
    {
        return view('admin-views.flavour.add_or_edit');
    }
    public function edit($id) 
    {
        $flavour = Flavour::find($id);
        if ($flavour) {
            return view('admin-views.flavour.add_or_edit', compact('flavour'));
        }
        return abort(404);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                Rule::unique('Flavour', 'value'),
                'max:50',
            ],
        ]);
        $flavour = new Flavour();
        $flavour->value = $request->value;
        $flavour->save();
        return redirect('/admin/flavour/index')->with('success', 'Flavour created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'value' => [
                'required',
                Rule::unique('Flavour')->ignore($id, 'flavour_id'),
                'max:50',
            ],
        ]);
        $flavour = Flavour::find($id);
        if ($flavour) {
            $flavour->value = $request->input('value');
            $flavour->save();
            return redirect('/admin/flavour/index')->with('success', 'Flavour updated successfully');
        }
        return abort(404);
    }

    public function delete($id)
    {
        try {
            $flavour = Flavour::find($id);
            if ($flavour) {
                $flavour->delete();
                return redirect('/admin/flavour/index')->with('success', 'Flavour deleted successfully');
            }
            return abort(404);
        } catch (\Exception $e) {
            return redirect('/admin/flavour/index')->with('errors', 'Flavour deleted unsuccessfully');
        }
    }
}
