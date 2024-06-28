<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{
   public function index(){

    $user = Auth::user();
    return view('Admin.accountsetting.index',compact('user'));
   }


   public function edit()
   {
       $user = Auth::user();
       return view('Admin.accountsetting.edit', compact('user'));
   }

   public function adminupdate(Request $request)
   {
     
   
    $request->validate([
        'name' => 'required',         
        'email' => 'required',
        'phone' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

   $user = Auth::user();
   $user->name = $request->name;
  
   $user->email = $request->email;

   $user->phone = $request->phone;
     if ($request->hasFile('image')) {        
      $imagePath = $request->file('image')->store('adminprofileimages', 'public');
      $user->image = $imagePath;
  }
 
    $user->save();

       return redirect()->route('accountsetting.profile')->with('success', 'Profile updated successfully.');
   }


   public function AdminchangePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
    ]);

    $user = Auth::user();

    // Check if old password matches
    if (!Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'The provided password does not match your current password.']);
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('success', 'Password changed successfully!');
}
}
