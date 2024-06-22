<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CouponController extends Controller
{
     
    public function index()
    {
        return view('Admin.coupon.index');
    }

    
     public function indexData()
    {
        
        $coupon = Coupon::get();
        
        return DataTables::of($coupon)
        ->editColumn('status', function ($coupon) {
            return $coupon->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }

    public function create()
    {
        return view('Admin.coupon.create');
    }



    public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
             'code' => 'required',
            
        ]);
        
         $coupon = new Coupon;
         $coupon->name = $request->input('name');
         $coupon->code = $request->input('code');
         $coupon->discount_type = $request->input('discount_type');
         $coupon->discount_value = $request->input('discount_value');
         $coupon->start_date	 = $request->input('start_date');
           $coupon->end_date	 = $request->input('end_date');
         $coupon->minimum_purchase_price = $request->input('minimum_purchase_price');
     
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon added successfully!');


     }

     public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('Admin.coupon.edit',compact('coupon')); 
    }


        public function update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
             'code' => 'required',
            
        ]);
        
         $coupon = Coupon::find($id);
         $coupon->name = $request->input('name');
         $coupon->code = $request->input('code');
         $coupon->discount_type = $request->input('discount_type');
         $coupon->discount_value = $request->input('discount_value');
         $coupon->start_date	 = $request->input('start_date');
        $coupon->end_date	 = $request->input('end_date');
         $coupon->minimum_purchase_price = $request->input('minimum_purchase_price');
         $coupon->status	 = $request->input('status');
     
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon Update successfully!');


     }

     public function delete($id)
     {
        $coupon = Coupon::find($id);

        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon Delete successfully!');
     }

}
