<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class SubscriberController extends Controller
{
    public function index(){

    return view('Admin.subscriber.index');

    }

    public function indexData(){

        $subscriber=Subscriber::all();
        return DataTables::of($subscriber)       
        ->make(true);
    
        }

        public function store(Request $request){

            $request->validate([

                'email'=>'required'

            ]);

            $subscriber=new Subscriber();
            $subscriber->email=$request->input('email');

            $subscriber->save();

            return redirect()->back()->with('success', 'subscribed successfully!');


        }

        public function storeNewsletter(Request $request)
        {
            $request->validate([
                'subject' => 'required|string|max:255',
                'content' => 'required|string'
            ]);
    
            $newsletter = new Newsletter();
            $newsletter->subject = $request->input('subject');
            $newsletter->content = $request->input('content');
            $newsletter->save();
    
            $this->sendEmails($newsletter);
    
            return redirect()->back()->with('success', 'Mail sent to all user successfully!');
        }

        protected function sendEmails($newsletter)
        {
            $subscribers = Subscriber::all();
            
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewsletterMail($newsletter->subject, $newsletter->content));
            }
        }
}
