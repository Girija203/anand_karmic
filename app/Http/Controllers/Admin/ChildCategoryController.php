<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlugHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChildCategoryController extends Controller
{
    public function index()
    {
        $childcategory = ChildCategory::with('category', 'subcategory')->get();
        return view('Admin.childcategory.index', compact('childcategory'));
    }
    public function indexData()
    {

        $childcategory = ChildCategory::with('category', 'subcategory')->get()->slice(1);

        return DataTables::of($childcategory)
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->name : 'N/A';
            })
            ->addColumn('subcategory_name', function ($row) {
                return $row->subcategory ? $row->subcategory->name : 'N/A';
            })
            ->make(true);
    }

    public function create()
    {

        $category = Category::all();
        return view('Admin.childcategory.create', compact('category'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('child_categories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id)
                        ->where('subcategory_id', $request->subcategory_id);
                }),
            ],
        ]);

        $childcategory = new ChildCategory();
        $childcategory->category_id = $request->input('category_id');
        $childcategory->subcategory_id = $request->input('subcategory_id');
        $childcategory->name = $request->input('name');
        $childcategory->status = $request->input('status');
        $childcategory->slug = SlugHelper::generateUniqueSlug(ChildCategory::class, $request->input('name'));
        $childcategory->save();

        if ($request->action === 'save') {
            return redirect()->route('childcategory.index')->with('success', 'Sub Category created successfully');
        } elseif ($request->action === 'save_and_new') {
            return redirect()->route('childcategory.create')->with('success', 'Sub Category created successfully');
        }
    }

    public function edit($id)
    {

        $category = Category::where('status', 1)->get();
        $subcategory = SubCategory::where('status', 1)->get();
        $childcategory = ChildCategory::findOrfail($id);

        return view('Admin.childcategory.edit', compact('category', 'childcategory', 'subcategory'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'category_id' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('child_categories')->where(function ($query) use ($request, $id) {
                    return $query->where('category_id', $request->category_id)->where('id', '<>', $id);
                }),
            ],
            'slug' => 'required|string|unique:child_categories,slug,' . $id . '|max:255',

        ]);

        $childcategory = ChildCategory::findOrfail($id);
        $childcategory->category_id = $request->input('category_id');
        $childcategory->subcategory_id = $request->input('subcategory_id');
        $childcategory->name = $request->input('name');
        $childcategory->slug = Str::slug($request->input('name'));
        $childcategory->status = $request->input('status');
        $childcategory->save();

        return redirect()->route('childcategory.index')->with('success', 'childcategory updated successfully');
    }

    public function delete($id)
    {

        $childcategory = ChildCategory::findOrfail($id);

        $childcategory->delete();
        $result = "ChildCategory deleted successfully";
        return $result;
    }
}
