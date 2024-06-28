<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\ShippingAddresses;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Notifications\OrderNotification;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{

    public function placeOrder(Request $request)
    {
        $orderData =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'mobile' => 'required|string|max:15',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'pincode' => 'required|string|max:10',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('phone', $request->mobile)
            ->first();

        if (!$user) {
            // If user doesn't exist, create a new user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->mobile;
            $user->password = bcrypt($request->mobile); // Use mobile number as password
            $user->save();

            // Send email to the user with login details
            Mail::send('frontend.usercreated', ['email' => $request->email, 'password' => $request->mobile], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Your Login Details');
            });
        } else {
            // If user already exists, update user details
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->mobile;
            $user->save();
        }

        // Get the user ID
        $user_id = $user->id;

        // Save billing address
        if (!$user->addresses()->where('type', 0)->exists()) {
            $billingAddress = new Addresses();
            $billingAddress->user_id = $user_id;
            $billingAddress->name = $request->name;
            $billingAddress->email = $request->email;
            $billingAddress->mobile = $request->mobile;
            $billingAddress->country = $request->country;
            $billingAddress->state = $request->state;
            $billingAddress->city = $request->city;
            $billingAddress->address = $request->address;
            $billingAddress->pincode = $request->pincode;
            $billingAddress->type = 0;
            $billingAddress->save();
        }

        $selectedShippingAddressId = $request->input('selected_shipping_address_id');

        // dd($selectedShippingAddressId);

        // Retrieve the current default shipping address
        $defaultShippingAddress = $user->addresses()->where('type', 1)->where('default_shipping', 1)->first();

        if ($defaultShippingAddress) {
            // If a default shipping address exists, update it to not be the default
            $defaultShippingAddress->default_shipping = 0;
            $defaultShippingAddress->save();
        }

        // Retrieve the new selected shipping address
        $newSelectedShippingAddress = $user->addresses()->where('id', $selectedShippingAddressId)->first();
        // dd($newSelectedShippingAddress);
        if ($newSelectedShippingAddress) {
            // If the selected shipping address exists, set it as the new default
            $newSelectedShippingAddress->default_shipping = 1;
            $newSelectedShippingAddress->save();
        } else {
            // Handle the case where the selected shipping address ID doesn't exist for the user
        }


        if ($request->has('ship_different') && !$user->addresses()->where('type', 1)->exists()) {
            $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_email' => 'nullable|string|email|max:255',
                'shipping_mobile' => 'nullable|string|max:15',
                'shipping_country' => 'nullable|string|max:255',
                'shipping_state' => 'nullable|string|max:255',
                'shipping_city' => 'nullable|string|max:255',
                'shipping_address' => 'nullable|string',
                'shipping_pincode' => 'nullable|string|max:10',
            ]);

            // Find and update the existing default shipping address, if any
            $defaultShippingAddress = $user->addresses()->where('type', 1)->where('default_shipping', 1)->first();

            // Save the new shipping address as the default
            $shippingAddress = new Addresses();
            $shippingAddress->user_id = $user_id;
            $shippingAddress->name = $request->shipping_name;
            $shippingAddress->email = $request->shipping_email;
            $shippingAddress->mobile = $request->shipping_mobile;
            $shippingAddress->country = $request->shipping_country;
            $shippingAddress->state = $request->shipping_state;
            $shippingAddress->city = $request->shipping_city;
            $shippingAddress->address = $request->shipping_address;
            $shippingAddress->pincode = $request->shipping_pincode;
            $shippingAddress->type = 1;
            $shippingAddress->default_shipping = 1;
            $shippingAddress->save();
        }



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
        $discountAmounts = 0;

        foreach ($cart as $item) {
            $itemAmount = $item->quantity * $item->product->price;
            $totalAmount += $itemAmount;
            $discountAmount += $item->discount * $item->quantity;
        }

        // dd( $discountAmounts);
        // Calculate the final total amount including shipping and coupon discount
        $shippingFee = $request->shipping_fee;
        $couponDiscount = $request->coupon_discount;

        $itemAmount = $item->quantity * $item->product->offer_price;
        $itemAmount = floatval($itemAmount);         // Ensure $itemAmount is a float// Ensure $discountAmounts is a float
        $shippingFee = floatval($shippingFee);         // Ensure $shippingFee is a float
        $couponDiscount = floatval($couponDiscount);   // Ensure $couponDiscount is a float

        $grandTotal = $itemAmount + $shippingFee - $couponDiscount;
        // $grandTotal = ($itemAmount - $discountAmounts) + $shippingFee - $couponDiscount;

        // dd($grandTotal );

        // Create order
        $order = new Order();
        $order->user_id = $user_id;
        $order->order_no = 'ORDER-' . strtoupper(uniqid());
        $order->total_amount = $grandTotal;
        $order->product_qty = $item->quantity;
        $order->payment_method = $request->payment_method;
        $order->payment_status = 0;
        $order->order_status = 0;
        $order->shipping_cost = $shippingFee;
        $order->coupon_cost = $couponDiscount;
        $order->save();

        // Save order items
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->unit_price = $item['price'];
            $orderItem->total_price = $item['quantity'] * $item['price'];
            $orderItem->save();
        }

        if (in_array($request->payment_method, ['stripe', 'razorpay'])) {
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_method = $request->payment_method;
            $payment->transaction_id = Str::random(16); // Generates a random 16 character string
            $payment->amount = $grandTotal;
            $payment->status = 0;
            $payment->save();
        } elseif ($request->payment_method == 'cod') {
            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_method = 'cod';
            $payment->transaction_id = null;
            $payment->amount = $grandTotal;
            $payment->status = 0;
            $payment->save();
        }

        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');


        $orderItems = $order->orderItems()->with('product')->get();
        Mail::send('Admin.mail.order_confirmation', ['user' => $user, 'order' => $order, 'orderItems' => $orderItems, 'exchangeRate' => $exchangeRate, 'currencySymbol' => $currencySymbol], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Order Confirmation');
        });

        // Delete all cart items
        foreach ($cartItems as $item) {
            $item->delete();
        }

        $username = $user->name;
        $order_no = $order->order_no;
        event(new OrderNotificationEvent($username, $order_no));

        $admins = User::all();
        foreach ($admins as $admin) {
            $admin->notify(new OrderNotification($orderData, $order_no));
        }

        if (auth()->check()) {
            // User is logged in, redirect to account page
            return redirect()->route('myaccount')->with('success', 'Your order has been placed successfully. You are now logged in.');
        } else {
            // User is not logged in, redirect to registration page
            return redirect()->route('normaluser.register')->with('success', 'Your order has been placed successfully. Please login to continue.');
        }
    }

    public function add()
    {
        $cart = Cart::all();
        return view('frontend.add_shipping_address', compact('cart'));
    }
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'country' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
        ]);

        // Store the shipping address
        Addresses::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'pincode' => $request->input('pincode'),
            'type' => 1,
            'default_shipping' => 0
        ]);

        return redirect()->route('checkout')->with('success', 'Shipping address stored successfully.');
    }

    public function edit($id)
    {
        $cart = Cart::all();
        $shippingAddress = Addresses::where('user_id', auth()->id())->where('id', $id)->first();
        return view('frontend.edit_shipping_address', compact('shippingAddress', 'cart'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
        ]);

        $shippingAddress = Addresses::where('user_id', auth()->id())->where('id', $id)->first();

        if ($shippingAddress) {
            $shippingAddress->name = $request->input('name');
            $shippingAddress->email = $request->input('email');
            $shippingAddress->mobile = $request->input('mobile');
            $shippingAddress->country = $request->input('country');
            $shippingAddress->state = $request->input('state');
            $shippingAddress->city = $request->input('city');
            $shippingAddress->address = $request->input('address');
            $shippingAddress->pincode = $request->input('pincode');
            $shippingAddress->save();
        }

        return redirect()->route('checkout')->with('success', 'Shipping address updated successfully.');
    }
    public function delete($id)
    {
        $shippingAddress = Addresses::where('user_id', auth()->id())->where('id', $id)->first();

        if ($shippingAddress) {
            $shippingAddress->delete();
        }

        return redirect()->route('checkout')->with('success', 'Shipping address removed successfully.');
    }
}
