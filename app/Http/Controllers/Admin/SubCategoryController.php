<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
       $subcategory = SubCategory::with('category')->get();
       return view('Admin.subcategory.index',compact('subcategory'));
    }
     public function indexData()
   {
       
    $subcategory = SubCategory::with('category')->get();
       
       return DataTables::of($subcategory)
       ->addColumn('category_name', function($row) {
        return $row->category ? $row->category->name : 'N/A';
    })
       ->make(true);
   }

   public function create(){

    $category=Category::all();

    return view('Admin.subcategory.create',compact('category'));
   }

   public function store(Request $request){

    $request->validate([
        'category_id'=>'required',
        'name' => 'required|string|max:255',
        'status'=>'required',
 
    ]);

    $subcategory=new SubCategory();
    $subcategory->category_id=$request->input('category_id');
    $subcategory->name=$request->input('name');
    $subcategory->slug = Str::slug($request->input('name'));
    $subcategory->status=$request->input('status');
    $subcategory->save();

    return redirect()->route('subcategory.index')->with('success','category created successfully');

   }

   public function edit($id){

    $category=Category::where('status',1)->get();
    $subcategory=SubCategory::findOrfail($id);

    return view('Admin.subcategory.edit',compact('category','subcategory'));

   }

   public function update(Request $request,$id){

    $request->validate([

        'category_id'=>'required',
        'name' => 'required|string|max:255',
        'status'=>'required',
 
    ]);

    $subcategory= SubCategory::findOrfail($id);
    $subcategory->category_id=$request->input('category_id');
    $subcategory->name=$request->input('name');
    $subcategory->slug = Str::slug($request->input('name'));
    $subcategory->status=$request->input('status');
    $subcategory->save();

    return redirect()->route('subcategory.index')->with('success','subcategory updated successfully');

   }

   public function delete($id){

    $subcategory= SubCategory::findOrfail($id);

    $subcategory->delete();

    return redirect()->route('subcategory.index')->with('success','subcategory deleted successfully');
   }
}
