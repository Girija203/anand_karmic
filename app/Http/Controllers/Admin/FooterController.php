<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;
use Yajra\DataTables\DataTables;
class FooterController extends Controller
{
     public function index()
     {
        return view('Admin.footer.index');
     }

      public function indexData()
   {
       
    $footer = Footer::get();
       
       return DataTables::of($footer)->make(true);
   }

     public function create()
     {
        return view('Admin.footer.create');
     }

           public function store(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'first_column' => 'required',
         'second_column' => 'required',
         'third_column' => 'required',
         'copyright' => 'required',
         'email' => 'required',
         'phone' => 'required',
            
        ]);
        
        $footer = new Footer;
         $footer->about_us = $request->input('about_us');
         $footer->phone = $request->input('phone');
          $footer->email = $request->input('email');
           $footer->address = $request->input('address');
        $footer->first_column = $request->input('first_column');
         $footer->second_column = $request->input('second_column');
          $footer->third_column = $request->input('third_column');
           $footer->copyright = $request->input('copyright');
     
        $footer->save();

        return redirect()->route('footers.index')->with('success', 'Footer added successfully!');
     }

      public function edit($id)
     {
         $footer = Footer::find($id);

        return view ('Admin.footer.edit',compact('footer'));
     }

      public function update(Request $request, $id)
     {
        
        //   dd($request);
        $request->validate([
            'first_column' => 'required',
            
        ]);
        
        $footer = Footer::find($id);
         $footer->about_us = $request->input('about_us');
         $footer->phone = $request->input('phone');
          $footer->email = $request->input('email');
           $footer->address = $request->input('address');
        $footer->first_column = $request->input('first_column');
         $footer->second_column = $request->input('second_column');
          $footer->third_column = $request->input('third_column');
           $footer->copyright = $request->input('copyright');
     
        $footer->save();

        return redirect()->route('footers.index')->with('success', 'Footer Updated successfully!');
     }

      public function delete($id)
     {
        
        
        $footer = Footer::find($id);
        $footer->delete();
        $result = "Footer deleted successfully";
        return $result;

     
     }
}
