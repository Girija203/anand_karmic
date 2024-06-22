<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
        $product = Product::with('category', 'subcategory', 'childcategory', 'brand')
                    ->where('qty', '=', 0) // Filter for out-of-stock products
                    ->get();
    
        return DataTables::of($product)
            ->addColumn('category_name', function($row) {
                return $row->category ? $row->category->name : 'N/A';
            })
            ->addColumn('subcategory_name', function($row) {
                return $row->subcategory ? $row->subcategory->name : 'N/A';
            })
            ->addColumn('childcategory_name', function($row) {
                return $row->childcategory ? $row->childcategory->name : 'N/A';
            })
            ->addColumn('brand', function($row) {
                return $row->brand ? $row->brand->name : 'N/A';
            })
            ->addColumn('labels', function($row) {
                $labels = '';
                if ($row->new_product) {
                    $labels .= '<span class="badge badge-primary p-1">New</span> ';
                }
                if ($row->is_featured) {
                    $labels .= '<span class="badge badge-success p-1">Featured</span> ';
                }
                if ($row->is_top) {
                    $labels .= '<span class="badge badge-warning p-1">Top</span> ';
                }
                if ($row->is_best) {
                    $labels .= '<span class="badge badge-danger p-1">Best</span> ';
                }
                return $labels;
            })
            ->rawColumns(['labels']) // Ensure the HTML is rendered correctly
            ->make(true);
    }
}
