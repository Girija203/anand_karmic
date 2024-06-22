<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    public function index()

    {
        $faq = Faq::all();
       return view('Admin.faq.index',compact('faq'));
    }


     public function indexData()
   {
       
       $faq = Faq::all();
       
       return DataTables::of($faq)
       ->editColumn('status', function ($faq) {
        return  $faq->status ? 'Active' : 'Inactive';
    })    
       ->make(true);   
   }

    public function create()
    {
      
       return view('Admin.faq.create');
    }

     public function store(Request $request)
    {
       $request->validate([
           'questions' => 'required',
           'answers' => 'required',
           'status' => 'required',
           
       ]);
       
        $faq = new Faq();
        $faq->questions = $request->input('questions');
        $faq->answers = $request->input('answers');
        $faq->status = $request->input('status');
    
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'Faq added successfully!');

    }

        public function edit($id)
        {
            $faq = Faq::find($id);
        
             return view ('Admin.faq.edit',compact('faq'));
        }


        public function update(Request $request,$id)
        {
    
        $request->validate([
            'questions' => 'required',
            'answers' => 'required',
            
        ]);
        
            $faq = Faq::find($id);
            $faq->questions = $request->input('questions');
            $faq->answers = $request->input('answers');
            $faq->status = $request->input('status');
        
            $faq->save();

        return redirect()->route('faq.index')->with('success', 'Faq updated successfully!');

        }


        public function delete($id)
        {
        
            $faq = Faq::find($id);
           $faq->delete();    

            return redirect()->route('faq.index')->with('success', 'Faq Deleted successfully!');


        }
}
