<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductColor;
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
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_in' => 'required|integer|min:1',
        ]);

        // Find the ProductColor entry
        $productColor = ProductColor::where('product_id', $request->input('product_id'))
        ->first();

      

        // Update the quantity
        $productColor->qty += $request->input('stock_in');
        $productColor->save();

        // Log the inventory update (assuming you have an Inventory model)
        Inventory::create([
            'product_id' => $productColor->product_id,
            'stock_in' => $request->input('stock_in'),
        ]);

        // Redirect with success message
        return redirect()->route('inventory.index')->with('success', 'Stock added successfully');
    }

    public function delete($id){

        $stock=Inventory::findorfail($id);
        $stock->delete();
        return redirect()->route('inventory.index');
    }
}
