<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlugHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategory = SubCategory::with('category')->get();
        return view('Admin.subcategory.index', compact('subcategory'));
    }
    public function indexData()
    {

        $subcategory = SubCategory::with('category')->get()->slice(1);

        return DataTables::of($subcategory)
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : 'N/A';
            })
            ->make(true);
    }

    public function create()
    {

        $category = Category::all();

        return view('Admin.subcategory.create', compact('category'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                }),
            ],
        ]);

        $subcategory = new SubCategory();
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->status = $request->input('status');
        $subcategory->slug = SlugHelper::generateUniqueSlug(SubCategory::class, $request->input('name'));
        $subcategory->save();

        if ($request->action === 'save') {
            return redirect()->route('subcategory.index')->with('success', 'Sub Category created successfully');
        } elseif ($request->action === 'save_and_new') {
            return redirect()->route('subcategory.create')->with('success', 'Sub Category created successfully');
        }
    }

    public function edit($id)
    {

        $category = Category::where('status', 1)->get();
        $subcategory = SubCategory::findOrfail($id);

        return view('Admin.subcategory.edit', compact('category', 'subcategory'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'category_id' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')->where(function ($query) use ($request, $id) {
                    return $query->where('category_id', $request->category_id)->where('id', '<>', $id);
                }),
            ],
            'slug' => 'required|string|unique:sub_categories,slug,' . $id . '|max:255',

        ]);

        $subcategory = SubCategory::findOrfail($id);
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->slug = Str::slug($request->input('slug'));
        $subcategory->status = $request->input('status');
        $subcategory->save();

        return redirect()->route('subcategory.index')->with('success', 'subcategory updated successfully');
    }

    public function delete($id)
    {

        $subcategory = SubCategory::findOrfail($id);

        $subcategory->delete();
        $result = "SubCategory deleted successfully";
        return $result;
    }
}
