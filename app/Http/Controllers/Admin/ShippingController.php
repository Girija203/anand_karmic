<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Shipping;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class ShippingController extends Controller
{
    public function index()
    {
        return view('Admin.shipping.index');
    }

    public function indexData()
    {
        
       $shipping = Shipping::with(['city.state.country'])->get();
    
    return DataTables::of($shipping)
        ->addColumn('city_state_country', function($shipping) {
            return $shipping->city->name . ', ' . $shipping->city->state->name . ', ' . $shipping->city->state->country->name;
        })
        ->make(true);
    }

    public function create()
    {
        $city = City::with(['state', 'country'])->get();
        
        return view('Admin.shipping.create',compact('city'));
    }

    public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'shipping_rule' => 'required',
             'city_id' => 'required',
            
        ]);
        
         $shipping = new Shipping;
         $shipping->city_id = $request->input('city_id');
         $shipping->shipping_rule = $request->input('shipping_rule');
         $shipping->type = $request->input('type');
         $shipping->condition_from = $request->input('condition_from');
         $shipping->condition_to = $request->input('condition_to');
         $shipping->shipping_fee = $request->input('shipping_fee');
     
        $shipping->save();

        return redirect()->route('shippings.index')->with('success', 'Shipping added successfully!');


     }

     public function edit($id)
    {
        $shipping = Shipping::find($id);
        $city = City::with(['state', 'country'])->get();
        
        return view('Admin.shipping.edit',compact('city','shipping'));
    }


        public function update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'shipping_rule' => 'required',
             'city_id' => 'required',
            
        ]);
        
         $shipping =  Shipping::find($id);
         $shipping->city_id = $request->input('city_id');
         $shipping->shipping_rule = $request->input('shipping_rule');
         $shipping->type = $request->input('type');
         $shipping->condition_from = $request->input('condition_from');
         $shipping->condition_to = $request->input('condition_to');
         $shipping->shipping_fee = $request->input('shipping_fee');
     
        $shipping->save();

        return redirect()->route('shippings.index')->with('success', 'Shipping Update successfully!');


     }


      public function delete($id)
     {
        
         $shipping =  Shipping::find($id);
    
     
        $shipping->delete();

        $result = "Shipping Deleted successfully";
        return $result;

        return redirect()->route('shippings.index')->with('success', 'Shipping Deleet successfully!');


     }

}
