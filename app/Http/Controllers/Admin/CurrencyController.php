<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CurrencyController extends Controller
{
    public function index()
     {
        return view ('Admin.currency.index');
     }

      public function indexData()
    {
        
        $currency = Currency::get();
        
        return DataTables::of($currency)
        ->editColumn('status', function ($currency) {
            return $currency->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }


      public function Create()
     {
        return view ('Admin.currency.create');
     }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $currency = new Currency;
        $currency->name = $request->input('name');
        $currency->code = $request->input('code');
     
        $currency->save();

        return redirect()->route('currencies.index')->with('success', 'Currency added successfully!');


     }

       public function edit($id)
     {
        $currency = Currency::find($id);
        return view ('Admin.currency.edit',compact('currency'));
     }

          public function Update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $currency =  Currency::find($id);
        $currency->name = $request->input('name');
         $currency->code = $request->input('code');
        $currency->status = $request->input('status');
     
        $currency->save();

        return redirect()->route('currencies.index')->with('success', 'currency Updated successfully!');


     }


        public function delete($id)
     {
        

        
        $currency =  Currency::find($id);
       
     
        $currency->delete();

        return redirect()->route('currencies.index')->with('success', 'Currency Delete successfully!');

     }

}
