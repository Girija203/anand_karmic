<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends Controller
{
         public function index()

     {
        return view('Admin.city.index');
     }

      public function indexData()
    {
        
        $city = City::with('country','state')->get();
        
        return DataTables::of($city)
        ->editColumn('status', function ($city) {
            return $city->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }

     public function create()
     {
        $country = Country::all();
        $state = State::all();
        return view('Admin.city.create',compact('country','state'));
     }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
         $city = new City;
         $city->country_id = $request->input('country_id');
         $city->state_id = $request->input('state_id');
         $city->name = $request->input('name');
     
        $city->save();

        return redirect()->route('cities.index')->with('success', 'city added successfully!');


     }

   public function edit($id)
   {
    $city = city::find($id);
    $country = Country::all();
     $state = State::all();
    return view ('Admin.city.edit',compact('state','country','city'));
   }

         public function update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $city =  City::find($id);
         $city->country_id = $request->input('country_id');
        $city->state_id = $request->input('state_id');
        $city->name = $request->input('name');
        $city->status = $request->input('status');
     
        $city->save();

        return redirect()->route('cities.index')->with('success', 'City update successfully!');


     }

       public function delete(Request $request,$id)
     {
        
       
        
        $city =  City::find($id);
         
     
        $city->delete();  
        
        $result = "City deleted successfully";
        return $result;


       


     }
}
