<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
       $product = Product::all();
       return view('Admin.inventory.index',compact('product'));
    }

   public function indexData()
   {
      // Join products with product_colors to get the necessary fields
      $products = Product::join('product_colors', 'products.id', '=', 'product_colors.product_id')
      ->select('products.id', 'products.title', 'product_colors.sku', 'product_colors.qty', 'products.is_sold')
      ->get();

      // Return data in the DataTables format
      return DataTables::of($products)->make(true);
   }




}
