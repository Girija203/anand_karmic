<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class ContactMessageController extends Controller
{
     public function index()
     {
        $contact_message = Contact::get();
        return view ('Admin.contact_message.index',compact('contact_message'));
     }
      public function indexData()
    {
        
        $contact_message = Contact::get();
        
        return DataTables::of($contact_message)->make(true);
    }
}
