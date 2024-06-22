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

    public function indexData(){

     $product = Product::all();
       
       return DataTables::of($product)
       ->make(true);
}




}
