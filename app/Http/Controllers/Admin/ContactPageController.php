<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index(){

        $contact = ContactPage::first();
        return view('Admin.contactpage.index',compact('contact'));
    }


    public function store(Request $request)
    {
      
       $request->validate([
                     
            'title'=>'required',
            'description'=>'required',
            'email'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'map'=>'required',

            
        ]);
    
      
        $contact = ContactPage::first();
    
       
        if (!$contact) {
          
            $contact = new ContactPage();
        }
    
       
        $contact->title = $request->input('title');
        $contact->description = $request->input('description');
        $contact->address = $request->input('address');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->map = $request->input('map');
    
      
        $contact->save();
    
       
        return redirect()->back()->with('success','successfully created');
    }
   
}
