<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductShowCase;
use App\Models\ShowCaseProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class ShowCaseProductController extends Controller
{
     public function index()
     {
        return view('Admin.show_case_product.index');
     }

   public function indexData()
{
    $ShowCaseproducts = ShowCaseProduct::with(['product', 'productShowCase','updatedBy'])->get();

    return DataTables::of($ShowCaseproducts)
        ->editColumn('status', function ($ShowCaseproducts) {
            return $ShowCaseproducts->status ? 'Active' : 'Inactive';
        })
        ->addColumn('product_name', function ($ShowCaseproducts) {
            return $ShowCaseproducts->product ? $ShowCaseproducts->product->title : 'N/A';
        })
        ->addColumn('show_case_title', function ($ShowCaseproducts) {
            return $ShowCaseproducts->productShowCase ? $ShowCaseproducts->productShowCase->title : 'N/A';
        })
         ->addColumn('updated_by_name', function ($ShowCaseproducts) {
            return $ShowCaseproducts->updatedBy ? $ShowCaseproducts->updatedBy->name : 'N/A';
        })
        ->make(true);
}

     public function create()
     {
        $product = Product::all();
        $productshowcase = ProductShowCase::all();
        return view('Admin.show_case_product.create',compact('product','productshowcase'));
     }

     public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'product_id' => 'required',  
        ]);
        
         $ShowCaseproducts = new ShowCaseProduct;
         $ShowCaseproducts->product_id  = $request->input('product_id');
         $ShowCaseproducts->product_show_cases_id  = $request->input('product_show_cases_id');
          $ShowCaseproducts->updated_by = Auth::id();
         $ShowCaseproducts->save();

        return redirect()->route('show_case_products.index')->with('success', 'Show Case Product added successfully!');


     }


      public function edit($id)
     {
         $ShowCaseproducts = ShowCaseProduct::find($id);
        $product = Product::all();
        $productshowcase = ProductShowCase::all();
        return view('Admin.show_case_product.edit',compact('product','productshowcase','ShowCaseproducts'));
     }

      public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'product_id' => 'required',  
        ]);
        
         $ShowCaseproducts = ShowCaseProduct::find($id);
         $ShowCaseproducts->product_id  = $request->input('product_id');
         $ShowCaseproducts->product_show_cases_id  = $request->input('product_show_cases_id');
     
         $ShowCaseproducts->save();

        return redirect()->route('show_case_products.index')->with('success', 'Show Case Product Updated successfully!');
     }

     public function delete($id)
     {
      
           $ShowCaseproducts = ShowCaseProduct::find($id);
           $ShowCaseproducts->delete();
           $result = "Showcase product deleted successfully";
           return $result;

        return redirect()->route('show_case_products.index')->with('success', 'Show Case Product Delete successfully!');

     }

}
