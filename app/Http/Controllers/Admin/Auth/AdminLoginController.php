<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminLoginController extends Controller
{
     public function login()
     {
        if (Auth::check()) {
            return redirect()->route('dashboard'); 
        }
        return view('Admin.auth.login');
     }

      public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->to(route('login'));
    }

      public function adminLogin(Request $request)
{
    $credentials = [
        "email" => $request['email'],
        "password" => $request['password'],
    ];

    if (Auth::attempt($credentials)) {
        $user = auth()->user();

       
            
                return redirect()->route('dashboard')->with('success', 'You have successfully logged in');
            } 
            
            else {
                return redirect()->back()->with('error', 'Your Credential does not match our records');
            
        }
    }


}
