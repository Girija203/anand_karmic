<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductShowCase;
use Yajra\DataTables\DataTables;
class ProductShowCaseController extends Controller
{
     public function index()
     {
        return view ('Admin.product_show_case.index');
     }
      public function indexData()
   {
       
     $ProductShowCases = ProductShowCase::get();
       
    return DataTables::of($ProductShowCases)
        ->editColumn('status', function ($ProductShowCases) {
            return $ProductShowCases->status ? 'Active' : 'Inactive';
        })
        ->editColumn('description', function ($ProductShowCases) {
            // Shorten the description to 50 characters and add ellipses if it's longer
            return strlen($ProductShowCases->description) > 50 ? substr($ProductShowCases->description, 0, 50) . '...' : $ProductShowCases->description;
        })
        ->make(true); 
   }

     public function create()
     {
        return view ('Admin.product_show_case.create');
     }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',

            
        ]);
        
         $ProductShowCases = new ProductShowCase;
         $ProductShowCases->title = $request->input('title');
         $ProductShowCases->description = $request->input('description');
         $ProductShowCases->save();

        return redirect()->route('product_show_cases.index')->with('success', 'Product Show Case added successfully!');


     }

     public function edit($id)
     {
        $ProductShowCase = ProductShowCase::find($id);
        return view ('Admin.product_show_case.edit',compact('ProductShowCase'));
     }

           public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',

            
        ]);
        
         $ProductShowCases = ProductShowCase::find($id);
         $ProductShowCases->title = $request->input('title');
         $ProductShowCases->description = $request->input('description');
         $ProductShowCases->status = $request->input('status');
         $ProductShowCases->save();

        return redirect()->route('product_show_cases.index')->with('success', 'Product Show Case Updated successfully!');


     }


                public function delete($id)
     {
        
       
        
         $ProductShowCases = ProductShowCase::find($id);

         $ProductShowCases->delete();

        return redirect()->route('product_show_cases.index')->with('success', 'Product Show Case Deleted successfully!');


     }


}
