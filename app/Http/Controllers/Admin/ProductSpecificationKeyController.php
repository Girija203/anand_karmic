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
       return view('Admin.productspecificationkey.index',compact('specificationkey'));
    }
     public function indexData()
   {
       
    $specificationkey = ProductSpecificationKey::get();
       
       return DataTables::of($specificationkey)->make(true);
   }

   public function create(){

    return view('Admin.productspecificationkey.create');
   }

   public function store(Request $request){

    $request->validate([
        'name' => 'required|string|max:255',
        'status'=>'required',
 
    ]);

    $specificationkey=new ProductSpecificationKey();
    $specificationkey->name=$request->input('name');
   
    $specificationkey->status=$request->input('status');
    $specificationkey->save();

    return redirect()->route('productspecificationkey.index')->with('success','category created successfully');

   }

   public function edit($id){

    $specificationkey=ProductSpecificationKey::findOrfail($id);

    return view('Admin.productspecificationkey.edit',compact('specificationkey'));

   }

   public function update(Request $request,$id){

    $request->validate([
        'name' => 'required|string|max:255',
        'status'=>'required',
 
    ]);

    $specificationkey= ProductSpecificationKey::findOrfail($id);
    $specificationkey->name=$request->input('name');
  
    $specificationkey->status=$request->input('status');
    $specificationkey->save();

    return redirect()->route('productspecificationkey.index')->with('success','category updated successfully');

   }

   public function delete($id){

    $specificationkey= ProductSpecificationKey::findOrfail($id);

    $specificationkey->delete();

    $result = "ProductSpecification deleted successfully";
    return $result;

    return redirect()->route('productspecificationkey.index')->with('success','category deleted successfully');
   }
}
