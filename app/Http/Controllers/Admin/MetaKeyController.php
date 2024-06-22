<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetaType;
use App\Models\MetaKey;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class MetaKeyController extends Controller
{
     public function index()
     {
        return view ('Admin.meta_key.index');
     }

     public function indexData()
    {
        
        $meta_key = MetaKey::with('metaType')->get();


        return DataTables::of($meta_key)->make(true);
    }

    public function create()

    {
        $meta_type = MetaType::get();
        return view('Admin.meta_key.create',compact('meta_type'));
    }

     public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $meta_key = new MetaKey;
        $meta_key->name = $request->input('name');
        $meta_key->meta_types_id = $request->input('meta_types_id');
        
       
   
        $meta_key->save();

        return redirect()->route('meta_keys.index')->with('success', 'Meta Key added successfully!');


     }

       public function edit($id)
{  
  
   $meta_key = Metakey::find($id);
   $meta_type = MetaType::all();
  
    
  
    return view('Admin.meta_key.edit', compact('meta_type','meta_key'));
}

 public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $meta_key =  MetaKey::find($id);
        $meta_key->name = $request->input('name');
        $meta_key->meta_types_id = $request->input('meta_types_id');
        
       
   
        $meta_key->save();

        return redirect()->route('meta_keys.index')->with('success', 'Meta Key Updated successfully!');


     }


      public function delete ($id)

     {
          $meta_type = MetaKey::find($id);
          $meta_type->delete();
          return redirect()->route('meta_keys.index')->with('success', 'Meta key Delete successfully!');
     }



}
