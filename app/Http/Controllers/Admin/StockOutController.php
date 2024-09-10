<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function outOfStock()
    {
        return view('Admin.stockout.index');
    }

    public function outOfStockData()
    {
        // Fetch data from product_color table where qty is 0
        $product_color = ProductColor::with([
            'product.category',
            'product.subcategory',
            'product.childcategory',
            'product.brand'
        ])
            ->where('qty', 0) // Filter products with qty 0 (out of stock)
            ->get();

        return DataTables::of($product_color)
            ->addColumn('category_name', function ($row) {
                return $row->product && $row->product->category ? $row->product->category->name : 'N/A';
            })
            ->addColumn('subcategory_name', function ($row) {
                return $row->product && $row->product->subcategory ? $row->product->subcategory->name : 'N/A';
            })
            ->addColumn('childcategory_name', function ($row) {
                return $row->product && $row->product->childcategory ? $row->product->childcategory->name : 'N/A';
            })
            ->addColumn('brand', function ($row) {
                return $row->product && $row->product->brand ? $row->product->brand->name : 'N/A';
            })
            ->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->title : 'N/A';
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset('storage/' . $row->single_image) . '" width="50" height="50">';
            })
        
            ->make(true);
    }
}
