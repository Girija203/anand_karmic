<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetaType;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class MetaTypeController extends Controller
{
   
    public function index()
    {
        $meta_type = MetaType::get();
        return view('Admin.meta_type.index');
    }
   
   
    public function indexData()
    {
        
        $meta_type = MetaType::get();
        
        return DataTables::of($meta_type)->make(true);
    }

    public function create()
    {
        return view ('Admin.meta_type.create');
    }

      public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $meta_type = new MetaType;
        $meta_type->name = $request->input('name');
     
        $meta_type->save();

        return redirect()->route('meta_types.index')->with('success', 'Meta Type added successfully!');


     }

      public function edit($id)
     {
         $meta_type = MetaType::find($id);

        return view ('Admin.meta_type.edit',compact('meta_type'));
     }

      public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $meta_type = MetaType::find($id);
        $meta_type->name = $request->input('name');
     
        
       
   
        $meta_type->save();

        return redirect()->route('meta_types.index')->with('success', 'Meta Type Update successfully!');

     }

     public function delete ($id)

     {
          $meta_type = MetaType::find($id);
          $meta_type->delete();
          return redirect()->route('meta_types.index')->with('success', 'Meta Type Delete successfully!');
     }

}
