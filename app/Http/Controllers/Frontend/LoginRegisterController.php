<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;



class LoginRegisterController extends Controller
{
    public function register()
    {



        $cartItems = Cart::with('product')->get();
        $cart = $cartItems->map(function ($item) {
            $product = $item->product;
            $discount = 0;

            if ($product->offer_price && $product->price > $product->offer_price) {
                $discount = $product->price - $product->offer_price;
            }

            $item->discount = $discount;
            return $item;
        });

        // Calculate the total amount and discount amount
        $totalAmount = 0;
        $discountAmount = 0;

        foreach ($cart as $item) {
            $itemAmount = $item->quantity * $item->price;
            $totalAmount += $itemAmount;
            $discountAmount += $item->discount;
        }

        return view('frontend.register', compact('cartItems', 'cart'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|',
        ]);

        if (!app()->environment('local')) {
            $validationRules['g-recaptcha-response'] = 'required|captcha';
        }
        // dd($validated);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect()->route('myaccount')->with('success', 'registered successfully,you can login now');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check if the remember_me checkbox is selected
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            // If remember_me is checked, set cookies for email and encrypted password
            if ($remember_me) {
                // Set cookies for 7 days (you can modify the duration as needed)
                $cookie_time = 60 * 24 * 7; // 7 days in minutes
                Cookie::queue('email', $request->email, $cookie_time);
                Cookie::queue('password', Crypt::encryptString($request->password), $cookie_time);
            } else {
                // Forget the cookies if remember_me is not checked
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }

            return redirect()->route('myaccount')->with('success', 'You have successfully logged in');
        } else {
            return redirect()->back()->with('error', 'Wrong credentials');
        }
    }




    public function forgotpassword()
    {
        $cart = Cart::all();

        return view('frontend.forgotpassword', compact('cart'));
    }

    public function submitForgetPasswordForm(Request $request)
    {

        // dd($request);
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        $alreadysend = DB::table('password_reset_tokens')->where(['email' => $request->email])->first();

        if (!empty($alreadysend)) {
            DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        }
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('frontend.forgotemaillink', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token)
    {

        return view('frontend.forgotresetpage', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {

        //   dd('hai');
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed', // 'confirmed' rule checks if 'password' matches 'password_confirmation'
            'password_confirmation' => 'required|min:6',
        ]);
        // dd($request->all());

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        // dd($updatePassword);
        if (!$updatePassword) {
            return back()->with('error', 'Invalid Email!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->to(route('normaluser.register'))->with('success', 'Your password has been changed,now login!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        // Cookie::queue(Cookie::forget('remember_web'));
        

        return redirect()->to(route('normaluser.register'));
    }
}
