<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlugHelper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index()
    {
        $brand = Brand::all();
        return view('Admin.Brand.index', compact('brand'));
    }
    public function indexData()
    {

        $brand = Brand::get()->slice(1);

        return DataTables::of($brand)->make(true);
    }

    public function create()
    {

        return view('Admin.Brand.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:brands|max:255',
        ]);

        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->status = $request->input('status');
        $brand->slug = SlugHelper::generateUniqueSlug(Brand::class, $request->input('name'));

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('images/logo', 'public');
            $brand->logo = $imagePath;
        }
        $brand->save();

        if ($request->action === 'save') {
            return redirect()->route('brand.index')->with('success', 'Brand created successfully');
        } elseif ($request->action === 'save_and_new') {
            return redirect()->route('brand.create')->with('success', 'Brand created successfully');
        }
    }

    public function edit($id)
    {

        $brand = Brand::findOrfail($id);

        return view('Admin.Brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|unique:brands,name,' . $id . '|max:255',
            'slug' => 'required|string|unique:brands,slug,' . $id . '|max:255',

        ]);

        $brand = Brand::findOrfail($id);
        $brand->name = $request->input('name');
        $brand->slug = Str::slug($request->input('slug'));
        $brand->status = $request->input('status');

        if ($request->hasFile('logo')) {

            $imagePath = $request->file('logo')->store('images/logo', 'public');
            $brand->logo = $imagePath;
        }
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand updated successfully');
    }

    public function delete($id)
    {
        $brand = Brand::findOrfail($id);

        $brand->delete();

        $result = "Brand deleted successfully";

        return $result;
    }
}
