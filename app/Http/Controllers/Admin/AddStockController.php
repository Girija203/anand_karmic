<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class AddStockController extends Controller
{
    public function show(Product $product){
       
     
        return view('Admin.Addstock.index',compact('product'));
    }

    public function indexData(Product $product){
     
        $stock = Inventory::where('product_id', $product->id)->get();
        return DataTables::of($stock)->make(true);
    }

    public function store(Request $request)
{
    
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'stock_in' => 'required|integer|min:1',
    ]);


    $product = Product::find($request->input('product_id'));

   
    $product->qty += $request->input('stock_in');
    $product->save();

    
    Inventory::create([
        'product_id' => $product->id,
        'stock_in' => $request->input('stock_in'),
    ]);

    
    return redirect()->route('inventory.index')->with('success', 'Stock added successfully');
}
    public function delete($id){

        $stock=Inventory::findorfail($id);
        $stock->delete();
        return redirect()->route('inventory.index');
    }
}
