<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Flavour;
use App\Models\Products_Details;
use App\Models\Size;
use Illuminate\Validation\Rule;


class ProductDetailsController extends Controller
{
    public function index($product_id) 
    {
        $product_details = Products_Details::where("product_id", $product_id);
        if(!$product_details) {
            return abort(404);
        }
        if (!empty(request()->input('size_id'))) {
            $product_details = $product_details->where('Products_details.size_id', '=', request()->input('size_id'));
        }
        if (!empty(request()->input('flavour_id'))) {
            $product_details = $product_details->where('Products_details.flavour_id', '=', request()->input('flavour_id'));
        }
        $product_details = $product_details 
        ->join('Size', 'Size.size_id', '=', 'Products_details.size_id')
        ->join('Flavour', 'Flavour.flavour_id', '=', 'Products_details.flavour_id')
        ->select('Products_details.*', 'Size.value as size', 'Flavour.value as flavour')
        ->paginate(5);
        $sizes = Size::all();
        $flavours = Flavour::all();
        return view('admin-views.product_details.index', compact('product_details','sizes', 'flavours', 'product_id'));
    }
    public function add($product_id) 
    {
        $sizes = Size::all();
        $flavours = Flavour::all();
        return view('admin-views.product_details.add_or_edit', compact('sizes', 'flavours', 'product_id'));
    }
    public function edit($id) 
    {
        $product_details = Products_Details::find($id);
        if(!$product_details) {
            return abort(404);
        }
        $product_id = $product_details->product_id;
        $sizes = Size::all();
        $flavours = Flavour::all();
        return view('admin-views.product_details.add_or_edit', compact('product_details', 'flavours', 'sizes', 'product_id'));
    }
    public function insert($product_id, Request $request)
    {
        $request->validate([
            'ImageFile' => [
                'required',
                'image',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0.5',
            ],
            'flavour_id' => [
                'required',
            ],
            'size_id' => [
                'required',
            ],
        ]);
        
        $product_details = new Products_Details();
        $product_details->price = $request->input('price');
        $product_details->size_id = $request->input('size_id');
        $product_details->flavour_id = $request->input('flavour_id');
        $product_details->product_id = $request->input('product_id');
        if ($request->hasFile('ImageFile')) {
            $image = $request->file('ImageFile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product_details'), $imageName);
            $product_details->image = '/product_details/' . $imageName;
        }
        $product_details->save();
        return redirect('/admin/product_details/index/'.$product_id)->with('success', 'Product Detail created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'ImageFile' => ['image'],
            'price' => ['required', 'numeric', 'min:0.5'],
            'flavour_id' => [
                'required',
            ],
            'size_id' => [
                'required',
            ],
        ]);
        
        $product_details = Products_Details::find($id);
        if (!$product_details) {
            return abort(404);
        }
        $product_details->size_id = $request->input('size_id');
        $product_details->flavour_id = $request->input('flavour_id');
        $product_details->price = $request->input('price');

        if ($request->hasFile('ImageFile')) {
            $imagePath = public_path($product_details->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image = $request->file('ImageFile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product_details'), $imageName);
            $product_details->image = '/product_details/' . $imageName;
            
        }
        $product_details->save();
        return redirect('/admin/product_details/index/'.$product_details->product_id)->with('success', 'Detail updated successfully');
    }

    public function delete($id)
    {
        try {
            $product_details = Products_Details::find($id);
            if (!$product_details) {
                return abort(404);
            } 
            $imagePath = public_path($product_details->image);
            $product_details->delete();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return redirect('/admin/product_details/index/'.$product_details->product_id)->with('success', 'Detail deleted successfully');
        } catch (\Exception $e) {
            return redirect('/admin/product_details/index/'.$product_details->product_id)->with('errors', 'Detail deleted unsuccessfully');
        }
    }
}
