<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Validation\Rule;

class ProductAdminController extends Controller
{
    public function index() 
    {
        $products = Products::orderBy('product_id', 'asc')
        ->when(request()->input('productname'), function ($query) {
            return $query->where('productname', 'LIKE', '%' . request()->input('productname') . '%');
        })
        ->join('Category', 'Products.category_id', '=', 'Category.category_id')
        ->select('Products.*', 'Category.category_name as category_name')
        ->paginate(5);
        $categories = Category::all();
        return view('admin-views.product.index', compact('products', 'categories'));
    }
    public function add() 
    {
        $categories = Category::all();
        return view('admin-views.product.add_or_edit', compact('categories'));
    }
    public function edit($id) 
    {
        $product = Products::find($id);
        if (!$product) {
            return abort(404);
        }
        $categories = Category::all();
        return view('admin-views.product.add_or_edit', compact('product', 'categories'));

    }
    public function insert(Request $request)
    {
        $request->validate([
            'productname' => [
                'required',
                Rule::unique('Products'),
                'max:50',
            ],
            'info' => [
                'max:500',
            ],
            'category_id' => [
                'required',
            ],
            'price_default' => [
                'required',
                'numeric',
                'min:0.5',
            ],
            'ImageFile' => [
                'required',
                'image',
            ]
        ]);
        
        $product = new Products();
        $product->productname = $request->input('productname');
        $product->price_default = $request->input('price_default');
        $product->category_id = $request->input('category_id');
        $product->info = $request->input('info');
        if ($request->hasFile('ImageFile')) {
            $image = $request->file('ImageFile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $product->product_avt_iamge = '/products/' . $imageName;
        }
        $product->save();
        return redirect('/admin/product/index')->with('success', 'Product created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'productname' => [
                'required',
                Rule::unique('Products')->ignore($id, 'product_id'),
                'max:50',
            ],
            'info' => [
                'max:500',
            ],
            'category_id' => [
                'required',
            ],
            'price_default' => [
                'required',
                'numeric',
                'min:0.5',
            ],
            'ImageFile' => [
                'image',
            ]
        ]);
        $product = Products::find($id);
        if (!$product) {
            return abort(404);
        }
        $product->productname = $request->input('productname');
        $product->price_default = $request->input('price_default');
        $product->category_id = $request->input('category_id');
        $product->info = $request->input('info');
        if ($request->hasFile('ImageFile')) {
            $imagePath = public_path($product->product_avt_iamge);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image = $request->file('ImageFile');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imageName);
            $product->product_avt_iamge = '/products/' . $imageName;
        }
        $product->save();
        return redirect('/admin/product/index')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        try {
            $product = Products::find($id);
            if (!$product) {
                return abort(404);
            }
            $imagePath = public_path($product->product_avt_iamge);
            $product->delete();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            return redirect('/admin/product/index')->with('success', 'Product deleted successfully');                
        } catch (\Exception $e) {
            return redirect('/admin/product/index')->with('errors', 'Product deleted unsuccessfully');
        }
    }
}
