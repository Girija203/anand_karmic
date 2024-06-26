<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contact_message = Contact::get();
        return view('Admin.contact_message.index', compact('contact_message'));
    }
    public function indexData()
    {

        $contact_message = Contact::get();

        return DataTables::of($contact_message)->make(true);
    }
    public function read_one($id)
    {
        $notify = Notification::find($id);
        $notify->read_at = Carbon::now();
        $notify->save();
        return redirect()->route('contact_messages.index');
    }

    public function read_all()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $contact_Notification = $unreadNotifications->filter(function ($notification) {
            return $notification->type == 'App\Notifications\ContactNotification';
        });
        $contact_Notification->markAsRead();
        return redirect()->back();
    }
}
