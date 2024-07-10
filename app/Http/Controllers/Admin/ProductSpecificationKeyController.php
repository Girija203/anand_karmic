<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSpecificationKey;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ProductSpecificationKeyController extends Controller
{
    public function index()
    {
        $specificationkey = ProductSpecificationKey::all();
        return view('Admin.productspecificationkey.index', compact('specificationkey'));
    }
    public function indexData()
    {

        $specificationkey = ProductSpecificationKey::get();

        return DataTables::of($specificationkey)->make(true);
    }

    public function create()
    {

        return view('Admin.productspecificationkey.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:product_specification_keys|max:255',
        ]);

        $specificationkey = new ProductSpecificationKey();
        $specificationkey->name = $request->input('name');
        $specificationkey->status = $request->input('status');
        $specificationkey->save();

        if ($request->action === 'save') {
            return redirect()->route('productspecificationkey.index')->with('success', 'Product Specification Key created successfully');
        } elseif ($request->action === 'save_and_new') {
            return redirect()->route('productspecificationkey.create')->with('success', 'Product Specification Key created successfully');
        }
    }

    public function edit($id)
    {

        $specificationkey = ProductSpecificationKey::findOrfail($id);

        return view('Admin.productspecificationkey.edit', compact('specificationkey'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|unique:product_specification_keys,name,' . $id . '|max:255',
        ]);

        $specificationkey = ProductSpecificationKey::findOrfail($id);
        $specificationkey->name = $request->input('name');

        $specificationkey->status = $request->input('status');
        $specificationkey->save();

        return redirect()->route('productspecificationkey.index')->with('success', 'Product Specification Key updated successfully');
    }

    public function delete($id)
    {

        $specificationkey = ProductSpecificationKey::findOrfail($id);

        $specificationkey->delete();

        $result = "Product Specification deleted successfully";
        return $result;
    }
}
