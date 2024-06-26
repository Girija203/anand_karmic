<?php

namespace App\Http\Controllers\Admin;

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
       return view('Admin.Brand.index',compact('brand'));
    }
     public function indexData()
   {
       
    $brand = Brand::get();
       
       return DataTables::of($brand)->make(true);
   }

   public function create(){

    return view('Admin.Brand.create');
   }

   public function store(Request $request){

    $request->validate([
        'name' => 'required|string|max:255',
        'status'=>'required',
      
 
    ]);

    $brand=new Brand();
    $brand->name=$request->input('name');
    $brand->slug = Str::slug($request->input('name'));
    $brand->status=$request->input('status');

    if ($request->hasFile('logo')) {
        $imagePath = $request->file('logo')->store('images/logo', 'public');
        $brand->logo = $imagePath;
    }
    $brand->save();

    return redirect()->route('brand.index')->with('success','category created successfully');

   }

   public function edit($id){

    $brand=Brand::findOrfail($id);

    return view('Admin.Brand.edit',compact('brand'));

   }

   public function update(Request $request,$id){

    $request->validate([
        'name' => 'required|string|max:255',
        'status'=>'required',
        'logo'=>'nullable',
 
    ]);

    $brand= Brand::findOrfail($id);
    $brand->name=$request->input('name');
    $brand->slug = Str::slug($request->input('name'));
    $brand->status=$request->input('status');

    if ($request->hasFile('logo')) {

        $imagePath = $request->file('logo')->store('images/logo', 'public');
        $brand->logo = $imagePath;
    }
    $brand->save();

    return redirect()->route('brand.index')->with('success','category updated successfully');

   }

   public function delete($id){

    $brand= Brand::findOrfail($id);

    $brand->delete();

    return redirect()->route('category.index')->with('success','category deleted successfully');
   }
}
