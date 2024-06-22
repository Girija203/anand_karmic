<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
     public function index()
     {
        $emailconfiguration=EmailConfiguration::first();
       $setting = Setting::first();
        return view ('Admin.setting.index',compact('setting','emailconfiguration'));
     }

     public function general(Request $request)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'site_title' => 'required|string|max:255',
        'time_zone' => 'required|string|max:255',
    ]);

    // Get the settings record from the database
    $setting = Setting::first();

    // Check if setting record exists
    if (!$setting) {
        // If no setting record exists, create a new one
        $setting = new Setting();
    }

    // Update the fields with the new values
    $setting->site_title = $request->input('site_title');
    $setting->timezone = $request->input('time_zone');


     if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoPath = $logo->store('public/logos'); // Adjust storage path as needed
        $setting->logo = $logoPath;
    }

    // Handle favicon upload
    if ($request->hasFile('favicon')) {
        $favicon = $request->file('favicon');
        $faviconPath = $favicon->store('public/favicons'); // Adjust storage path as needed
        $setting->favicon = $faviconPath;
    }

    // Save the setting
    $setting->save();

    // Return a response indicating success
    return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
}

 public function contact(Request $request)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'contact_email' => 'required|string|max:255',
        'topbar_email' => 'required|string|max:255',
          'topbar_phone' => 'required|string|max:255',

        
    ]);

    // Get the settings record from the database
    $setting = Setting::first();

    // Check if setting record exists
    if (!$setting) {
        // If no setting record exists, create a new one
        $setting = new Setting();
    }

    // Update the fields with the new values
    $setting->contact_email = $request->input('contact_email');
    $setting->topbar_email = $request->input('topbar_email');
    $setting->topbar_phone = $request->input('topbar_phone');

    // Save the setting
    $setting->save();

    // Return a response indicating success
    return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
}

 public function other(Request $request)
{

    // dd($request);
    // Validate incoming request
    $validatedData = $request->validate([
        'current_version' => 'required|string|max:255',
        'frontend_url' => 'required|string|max:255',
    ]);

    // Get the settings record from the database
    $setting = Setting::first();

    // Check if setting record exists
    if (!$setting) {
        // If no setting record exists, create a new one
        $setting = new Setting();
    }

    // Update the fields with the new values
    $setting->current_version = $request->input('current_version');
    $setting->maintenance_mode = $request->input('maintenance_mode');
    $setting->frontend_url = $request->input('frontend_url');
    $setting->sidebar_lg_header = $request->input('sidebar_lg_header');
    $setting->sidebar_sm_header = $request->input('sidebar_sm_header');

    if ($request->hasFile('error')) {
        $error = $request->file('error');
        $errorPath = $error->store('public/errors'); // Adjust storage path as needed
        $setting->error = $errorPath;
    }

    

// dd($setting);
    
    // Save the setting
    $setting->save();

    // Return a response indicating success
    return redirect()->route('settings.index')->with('success', 'Settings updated successfully');
}

public function theme(Request $request)
{
    // Validate incoming request
    $validatedData = $request->validate([
        'primary_color' => 'required|string|max:255',
        'secondary_color' => 'required|string|max:255',
    ]);

    // Get the settings record from the database
    $setting = Setting::first();

    // Check if setting record exists
    if (!$setting) {
        // If no setting record exists, create a new one
        $setting = new Setting();
    }

    // Update the fields with the new values
    $setting->primary_color = $request->input('primary_color');
    $setting->secondary_color = $request->input('secondary_color');

    // Save the setting
    $setting->save();

    // Return a response indicating success
    return redirect()->route('settings.index')->with('success', 'Theme settings updated successfully');
}

public function emailconfigure(Request $request)
{
//   dd('hai');  // dd($request);
    // Validate incoming request
    $validatedData = $request->validate([
        'mail'=>'required',
        'smtp_username' => 'required|string|max:255',
        

        
    ]);

    
    $stripe = EmailConfiguration::first();

    if (!$stripe) {
       
        $stripe = new EmailConfiguration();
    }

    
    $stripe->mail = $request->input('mail');
    $stripe->mail_host = $request->input('mail_host');
    $stripe->smtp_username = $request->input('smtp_username');
    $stripe->smtp_password = $request->input('smtp_password');
    $stripe->mail_port = $request->input('mail_port');
    $stripe->mail_encryption = $request->input('mail_encryption');
    $stripe->status = $request->input('status');

    $value1 = $request->input('mail');
     $value2 = $request->input('mail_host');
     $value3 = $request->input('smtp_username');
     $value4 = $request->input('smtp_password');
     $value5 = $request->input('mail_port');
     $value6 = $request->input('mail_encryption');

    // Update .env file
     file_put_contents(base_path('.env'), "\nMAIL_FROM_ADDRESS={$value1}", FILE_APPEND);
     file_put_contents(base_path('.env'), "\nMAIL_HOST={$value2}", FILE_APPEND);
     file_put_contents(base_path('.env'), "\nMAIL_USERNAME={$value3}", FILE_APPEND);
     file_put_contents(base_path('.env'), "\nMAIL_PASSWORD={$value4}", FILE_APPEND);
   
     file_put_contents(base_path('.env'), "\nMAIL_PORT={$value5}", FILE_APPEND);
     file_put_contents(base_path('.env'), "\nMAIL_ENCRYPTION={$value6}", FILE_APPEND);


    $stripe->save();

    
    return redirect()->route('settings.index')->with('success', 'mail updated successfully');
}

   
}
