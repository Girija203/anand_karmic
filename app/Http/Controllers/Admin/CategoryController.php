<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('Admin.category.index', compact('category'));
    }
    public function indexData()
    {

        $category = Category::get();
        return DataTables::of($category)->make(true);
    }

    public function create()
    {

        return view('Admin.category.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'status'=>'required'
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {

        $category = Category::findOrfail($id);

        return view('Admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',

        ]);

        $category = Category::findOrfail($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = Category::findOrfail($id);

        $category->delete();
        $result = "Category deleted successfully";
        return $result;
    }
}
