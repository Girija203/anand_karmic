<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Stripe;
use App\Models\Razorpay;

class PaymentMethodController extends Controller
{
    public function index()
     { 
        $country = Country::all();
        $currency = Currency::all();
         $stripe = Stripe::first();
          $razorpay = Razorpay::first();
       
        return view ('Admin.payment_method.index',compact('country','currency','stripe','razorpay'));
     }

     public function stripe(Request $request)
{
    // dd($request);
    // Validate incoming request
    $validatedData = $request->validate([
        'country_code' => 'required|string|max:255',
        

        
    ]);

    
    $stripe = Stripe::first();

    if (!$stripe) {
       
        $stripe = new Stripe();
    }

    
    $stripe->country_code = $request->input('country_code');
    $stripe->currency_code = $request->input('currency_code');
    $stripe->currency_rate = $request->input('currency_rate');
    $stripe->stripe_key = $request->input('stripe_key');
    $stripe->stripe_secret = $request->input('stripe_secret');
    $stripe->status = $request->input('status');

    $value2 = $request->input('stripe_key');
     $value3 = $request->input('stripe_secret');

    // Update .env file
     file_put_contents(base_path('.env'), "\nSTRIPE_KEY={$value2}", FILE_APPEND);
     file_put_contents(base_path('.env'), "\nSTRIPE_SECRET={$value3}", FILE_APPEND);

    $stripe->save();

    
    return redirect()->route('payment_methods.index')->with('success', 'Stripe updated successfully');
}

public function razorpay(Request $request)
{
    // dd($request);
    // Validate incoming request
    $validatedData = $request->validate([
        'country_code' => 'required|string|max:255',
        

        
    ]);

    
    $razorpay = Razorpay::first();

    if (!$razorpay) {
       
        $razorpay = new Razorpay();
    }

    
   
 
    $razorpay->name = $request->input('name');
    $razorpay->description = $request->input('description');
    $razorpay->razorpay_key = $request->input('razorpay_key');
    $razorpay->razorpay_secret = $request->input('razorpay_secret');
    $razorpay->country_code = $request->input('country_code');
    $razorpay->currency_code = $request->input('currency_code');
    $razorpay->currency_rate = $request->input('currency_rate');
    $razorpay->status = $request->input('status');

   if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('public/razorpay'); // Adjust storage path as needed
        $razorpay->image = $imagePath;
    }

     $value = $request->input('razorpay_key');
     $value1 = $request->input('razorpay_secret');

    // Update .env file
     file_put_contents(base_path('.env'), "\nRAZORPAY_KEY={$value}", FILE_APPEND);
     file_put_contents(base_path('.env'), "\nRAZORPAY_SECRET={$value1}", FILE_APPEND);

    $razorpay->save();

    
    return redirect()->route('payment_methods.index')->with('success', 'Razorpay updated successfully');
}

}
