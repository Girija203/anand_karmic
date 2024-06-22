<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CountryController extends Controller
{
     public function index()
     {
        return view ('Admin.country.index');
     }

      public function indexData()
    {
        
        $country = Country::get();
        
        return DataTables::of($country)
        ->editColumn('status', function ($country) {
            return $country->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }


      public function Create()
     {
        return view ('Admin.country.create');
     }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $Country = new Country;
        $Country->name = $request->input('name');
        $Country->code = $request->input('code');
     
        $Country->save();

        return redirect()->route('countries.index')->with('success', 'Country added successfully!');


     }

       public function edit($id)
     {
        $country = Country::find($id);
        return view ('Admin.country.edit',compact('country'));
     }

          public function Update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $Country =  Country::find($id);
        $Country->name = $request->input('name');
         $Country->code = $request->input('code');
        $Country->status = $request->input('status');
     
        $Country->save();

        return redirect()->route('countries.index')->with('success', 'Country Updated successfully!');


     }


        public function delete($id)
     {
        

        
        $Country =  Country::find($id);
       
     
        $Country->delete();

        return redirect()->route('countries.index')->with('success', 'Country Delete successfully!');

     }

     

}
