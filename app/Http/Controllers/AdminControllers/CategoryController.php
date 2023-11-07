<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index() 
    {
        $categories = Category::orderBy('category_id', 'asc');
        if (!empty(request()->input('category_name'))) {
            $categories = $categories->where('category_name', 'LIKE', '%'.request()->input('category_name').'%');
        }
        $categories = $categories->paginate(5);
        return view('admin-views.category.index', compact('categories'));
    }
    public function add() 
    {
        return view('admin-views.category.add_or_edit');
    }
    public function edit($id) 
    {
        $category = Category::find($id);
        if (!$category) {
            return abort(404);
        }
        return view('admin-views.category.add_or_edit', compact('category'));

    }
    public function insert(Request $request)
    {
        $request->validate([
            'category_name' => [
                'required',
                Rule::unique('Category', 'category_name'),
                'max:50',
            ],
        ]);
        
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return redirect('/admin/category/index')->with('success', 'Category created successfully');
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'category_name' => [
                'required',
                Rule::unique('Category')->ignore($id, 'category_id'),
                'max:50',
            ],
        ]);
        $category = Category::find($id);
        if (!$category) {
            return abort(404);
        }
        $category->category_name = $request->input('category_name');
        $category->save();
        return redirect('/admin/category/index')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return abort(404);
            }
            $category->delete();
            return redirect('/admin/category/index')->with('success', 'Category deleted successfully');                
        } catch (\Exception $e) {
            return redirect('/admin/category/index')->with('errors', 'Category deleted unsuccessfully');
        }
    }
}
