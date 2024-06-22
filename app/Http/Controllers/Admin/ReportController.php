<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReport;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){

        $report=ProductReport::all();
    
        return view('Admin.productreport.index',compact('report'));
        
       }
    
       public function indexData()
       {
           
        $report=ProductReport::all();
           
           return DataTables::of($report)
        //    ->addColumn('category_name', function($row) {
        //     return $row->category ? $row->category->name : 'N/A';
        // })
           ->make(true);
       }
}
