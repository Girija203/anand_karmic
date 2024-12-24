<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class StateController extends Controller
{
     public function index()

     {
        return view('Admin.state.index');
     }

      public function indexData()
    {
        
        $state = State::with('country')->get();
        
        return DataTables::of($state)
        ->editColumn('status', function ($state) {
            return $state->status ? 'Active' : 'Inactive';
        })
        ->make(true);   
    }

     public function create()
     {
        $country = Country::all();
        return view('Admin.state.create',compact('country'));
     }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
          'name' => 'required',
         'country_id' => 'required',
         'code' => 'required',
            
        ]);
        
        $state = new State;
         $state->country_id = $request->input('country_id');
        $state->name = $request->input('name');
       $state->code = $request->input('code');
     
        $state->save();

        return redirect()->route('states.index')->with('success', 'State added successfully!');


     }

   public function edit($id)
   {
    $state = State::find($id);
    $country = Country::all();
    return view ('Admin.state.edit',compact('state','country'));
   }

         public function update(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $state =  State::find($id);
         $state->country_id = $request->input('country_id');
        $state->name = $request->input('name');
        $state->code = $request->input('code');
        $state->status = $request->input('status');
     
        $state->save();

        return redirect()->route('states.index')->with('success', 'State update successfully!');


     }

       public function delete(Request $request,$id)
     {
        
       
        
        $state =  State::find($id);
         
     
        $state->delete();

        $result = "State deleted successfully";
        return $result;


      

     }


}
