<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlugHelper;
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

        $categories = Category::all()->slice(1);
        return DataTables::of($categories)->make(true);
    }

    public function create()
    {

        return view('Admin.category.create');
    }

    public function store(Request $request)

    {
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->slug = SlugHelper::generateUniqueSlug(Category::class, $request->input('name'));

        $category->save();

        if ($request->action === 'save') {
            return redirect()->route('category.index')->with('success', 'Category created successfully');
        } elseif ($request->action === 'save_and_new') {
            return redirect()->route('category.create')->with('success', 'Category created successfully');
        }
    }

    public function edit($id)
    {

        $category = Category::findOrfail($id);

        return view('Admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id . '|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $id . '|max:255', 
        ]);

        $category = Category::findOrfail($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('slug'));
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
