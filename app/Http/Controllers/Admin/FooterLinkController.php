<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FooterLink;
use Yajra\DataTables\DataTables;

class FooterLinkController extends Controller
{
    // First Column
     public function firstColumnIndex()
     {
        return view ('Admin.footer_link.index');
     }
      public function firstColumnIndexData()
   {
       
    $firstColumn = FooterLink::where('column', 1)->get();
       
       return DataTables::of($firstColumn)->make(true);
   }

     public function firstColumnCreate()
     {   
        return view ('Admin.footer_link.create');
     }
      public function firstColumnStore(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',
            
        ]);
        
        $firstColumn = new FooterLink;
         $firstColumn->title = $request->input('title');
         $firstColumn->link = $request->input('link');
          $firstColumn->column = 'first_column';
     
        $firstColumn->save();

        return redirect()->route('footer_links.index')->with('success', 'First Column added successfully!');
     }

       public function firstColumnEdit($id)
     {
         $firstColumn= FooterLink::find($id);

        return view ('Admin.footer_link.edit',compact('firstColumn'));
     }

      public function firstColumnUpdate(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',
            
        ]);
        
        $firstColumn = FooterLink::find($id);
         $firstColumn->title = $request->input('title');
         $firstColumn->link = $request->input('link');
          $firstColumn->column = 'first_column';
     
        $firstColumn->save();

        return redirect()->route('footer_links.index')->with('success', 'First Column Update successfully!');
     }


       public function firstColumnDelete($id)
     {
        
        $firstColumn = FooterLink::find($id);
        
        
        $firstColumn->delete();
        $result = "Footer first column link deleted successfully";
        return $result;
     

       
     }

     //Second Column


     public function secondColumnIndex()
     {
        return view ('Admin.second_column.index');
     }
      public function secondColumnIndexData()
   {
       
    $secondColumn = FooterLink::where('column', 2)->get();
       
       return DataTables::of($secondColumn)->make(true);
   }

     public function secondColumnCreate()
     {
        return view ('Admin.second_column.create');
     }
      public function secondColumnStore(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',
            
        ]);
        
        $secondColumn = new FooterLink;
         $secondColumn->title = $request->input('title');
         $secondColumn->link = $request->input('link');
          $secondColumn->column = 'second_column';
     
        $secondColumn->save();

        return redirect()->route('second_columns.index')->with('success', 'Second Column added successfully!');
     }

       public function secondColumnEdit($id)
     {
         $secondColumn= FooterLink::find($id);

        return view ('Admin.second_column.edit',compact('secondColumn'));
     }

      public function secondColumnUpdate(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',
            
        ]);
        
        $secondColumn = FooterLink::find($id);
         $secondColumn->title = $request->input('title');
         $secondColumn->link = $request->input('link');
          $secondColumn->column = 'second_column';
     
        $secondColumn->save();

        return redirect()->route('second_columns.index')->with('success', 'Second Column Update successfully!');
     }


       public function secondColumnDelete($id)
     {
        
        $secondColumn = FooterLink::find($id);
        
     
        $secondColumn->delete();
        $result = "Second column link deleted successfully";
        return $result;

        return redirect()->route('second_columns.index')->with('success', 'Second Column Delete successfully!');
     }



     //Third Column


     public function thirdColumnIndex()
     {
        return view ('Admin.third_column.index');
     }
      public function thirdColumnIndexData()
   {
       
    $thirdColumn = FooterLink::where('column', 3)->get();
       
       return DataTables::of($thirdColumn)->make(true);
   }

     public function thirdColumnCreate()
     {
        return view ('Admin.third_column.create');
     }
      public function thirdColumnStore(Request $request)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',
            
        ]);
        
        $thirdColumn = new FooterLink;
         $thirdColumn->title = $request->input('title');
         $thirdColumn->link = $request->input('link');
          $thirdColumn->column = 'third_column';
     
        $thirdColumn->save();

        return redirect()->route('third_columns.index')->with('success', 'Third Column added successfully!');
     }

       public function thirdColumnEdit($id)
     {
         $thirdColumn= FooterLink::find($id);

        return view ('Admin.third_column.edit',compact('thirdColumn'));
     }

      public function thirdColumnUpdate(Request $request,$id)
     {
        
        //   dd($request);
        $request->validate([
            'title' => 'required',
            
        ]);
        
        $thirdColumn = FooterLink::find($id);
         $thirdColumn->title = $request->input('title');
         $thirdColumn->link = $request->input('link');
          $thirdColumn->column = 'third_column';
     
        $thirdColumn->save();

        return redirect()->route('third_columns.index')->with('success', 'Third Column Update successfully!');
     }


       public function thirdColumnDelete($id)
     {
        
        $thirdColumn = FooterLink::find($id);
     
        $thirdColumn->delete();

        $result = "Footer third column link deleted successfully";
        return $result;


      //   return redirect()->route('third_columns.index')->with('success', 'Third Column Delete successfully!');
     }




}
