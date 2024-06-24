<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSMLShare;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductSMLShareController extends Controller
{
     public function index()
     {
        return view('Admin.product_sml_share.index');
     }
     public function indexData()
    {
        
        $product_sml_share = ProductSMLShare::get();
        
        return DataTables::of($product_sml_share)->make(true);
    }

     public function create()
     {
        return view('Admin.product_sml_share.create');
     }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'link' => 'required',
            
        ]);
        
        $product_sml_share = new ProductSMLShare;
         $product_sml_share->name = $request->input('name');
         $product_sml_share->link = $request->input('link');
         $product_sml_share->icon = $request->input('icon');
       
     
        $product_sml_share->save();

        return redirect()->route('product_sml_shares.index')->with('success', 'Product SML Share added successfully!');
     }

        public function edit($id)
     {
        $product_sml_share = ProductSMLShare::find($id);
        return view('Admin.product_sml_share.edit',compact('product_sml_share'));
     }

           public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'link' => 'required',
            
        ]);
        
         $product_sml_share = ProductSMLShare::find($id);
         $product_sml_share->name = $request->input('name');
         $product_sml_share->link = $request->input('link');
         $product_sml_share->icon = $request->input('icon');
       
     
        $product_sml_share->save();

        return redirect()->route('product_sml_shares.index')->with('success', 'Product SML Share Update successfully!');
     }

       public function delete($id)
     {
        
        
         $product_sml_share = ProductSMLShare::find($id);
        
       
     
        $product_sml_share->delete();

        return redirect()->route('product_sml_shares.index')->with('success', 'Product SML Share Delete successfully!');
     }


}
