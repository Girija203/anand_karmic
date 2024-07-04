<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponType;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;


class CouponTypeController extends Controller
{
     
    public function index()
    {
        return view('Admin.coupon_type.index');
    }

    
     public function indexData()
    {
        
        $coupon_type = CouponType::get();
        
        return DataTables::of($coupon_type)
        ->editColumn('status', function ($coupon_type) {
            return $coupon_type->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }

    public function create()
    {
        return view('Admin.coupon_type.create');
    }



    public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
             'code' => 'required',
            
        ]);
        
         $coupon_type = new CouponType;
         $coupon_type->name = $request->input('name');
         $coupon_type->code = $request->input('code');
     
     
        $coupon_type->save();

        return redirect()->route('coupon_types.index')->with('success', 'Coupon Type added successfully!');


     }

     public function edit($id)
    {
        $coupon_type = CouponType::find($id);
        return view('Admin.coupon_type.edit',compact('coupon_type')); 
    }


        public function update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
             'code' => 'required',
            
        ]);
        
         $coupon_type = CouponType::find($id);
         $coupon_type->name = $request->input('name');
         $coupon_type->code = $request->input('code');
         $coupon_type->status	 = $request->input('status');
     
        $coupon_type->save();

        return redirect()->route('coupon_types.index')->with('success', 'Coupon Type Update successfully!');


     }

     public function delete($id)
     {
        $coupon_type = CouponType::find($id);

        $coupon_type->delete();
        $result = "Coupon Type Deleted successfully";
        return $result;

       
     }

}
