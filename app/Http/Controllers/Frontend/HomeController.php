<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ContactNotificationEvent;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Mail\ContactReplyMail;
use App\Models\ProductSMLShare;
use App\Models\Contact;
use App\Models\SocialMediaLink;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Addresses;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\ContactPage;
use App\Models\Shipping;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\ProductShowCase;
use App\Models\ShowCaseProduct;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Support\Carbon;


use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function home()
    {

        $products = Product::all();
        $cart = Cart::get();
        $showCaseProducts = ShowCaseProduct::with(['product', 'productShowCase'])->get();
        $ProductShowCases = ProductShowCase::first();
             $exchangeRate = session('exchange_rate', 1); 
         $currencySymbol = session('currency_symbol', '$');
        // dd( $showCaseProducts);
        return view('frontend.home', compact('cart', 'showCaseProducts', 'ProductShowCases','exchangeRate','currencySymbol'));
    }

    public function about()
    {
        $cart = Cart::get();
        return view('frontend.about', compact('cart'));
    }

    public function contact()
    {
        $cart = Cart::get();
        $contactpage = ContactPage::get();
        return view('frontend.contact', compact('cart', 'contactpage'));
    }

    public function shop(Request $request)
{
    // Define how many products you want per page
    $perPage = 12;

    // Fetch all products with pagination
    $products = Product::paginate($perPage);
    $totalProducts = Product::count();

    $cart = Cart::get();
    $categories = Category::all();
    $specifications = ProductSpecification::where('product_specification_key_id', 2)->get();

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

    $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
    $currencySymbol = session('currency_symbol', '$'); // Default to $ if not set

    return view('frontend.shop', compact('products', 'categories', 'specifications', 'cart', 'cartItems', 'exchangeRate', 'currencySymbol', 'totalProducts'));
}


    public function filter(Request $request)
    {
        $orderBy = $request->input('orderby');
        $perPage = 12;

        $products = Product::query();

        switch ($orderBy) {
            case 'price-asc':
                $products->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $products->orderBy('price', 'desc');
                break;
            case 'date':
                $products->latest(); // Assuming there's a 'created_at' timestamp field in your products table
                break;
            default:
                // Default sorting or any other handling you want to implement
                break;
        }

        $products = $products->paginate($perPage);
        $totalProducts = Product::count();
        $categories = Category::all();
        $specifications = ProductSpecification::where('product_specification_key_id', 2)->get();

        $cart = Cart::all();

        $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
        $currencySymbol = session('currency_symbol', '$');

        return view('frontend.shop', compact('products', 'categories', 'specifications', 'cart', 'exchangeRate', 'currencySymbol', 'totalProducts'));
    }





    public function filterByPrice(Request $request)
    {
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 10000);
        $perPage = 12;

        $products = Product::whereBetween('offer_price', [$minPrice, $maxPrice])->paginate($perPage);
        $totalProducts = Product::count();
        $categories = Category::all();
        $specifications = ProductSpecification::where('product_specification_key_id', 2)->get();

        $cart = Cart::all();

        $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
        $currencySymbol = session('currency_symbol', '$');

        return view('frontend.shop', compact('products', 'categories', 'specifications', 'cart', 'exchangeRate', 'currencySymbol', 'totalProducts'));
    }

    public function filterByCategory($id)
    {
        $perPage = 12;

        $categories = Category::all();
        $products = Product::where('category_id', $id)->paginate($perPage);
        $totalProducts = Product::count();
        $specifications = ProductSpecification::where('product_specification_key_id', 2)->get();

        $cart = Cart::all();

        
        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');

        return view('frontend.shop', compact('categories', 'products', 'specifications', 'cart', 'totalProducts','exchangeRate','currencySymbol'));
    }

    public function filterBySpecifications(Request $request)
    {
        $selectedSpecs = $request->input('specifications', []);
        $perPage = 12;

        if (!empty($selectedSpecs)) {
            $products = Product::whereHas('specifications', function ($query) use ($selectedSpecs) {
                $query->whereIn('specification', $selectedSpecs);
            })->paginate($perPage);
        } else {
            $products = Product::paginate($perPage);
        }

        $specifications = ProductSpecification::where('product_specification_key_id', 2)->get();
        $categories = Category::all();
        $totalProducts = Product::count();
        $cart = Cart::all();
           $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');

        return view('frontend.shop', compact('products', 'specifications', 'categories', 'cart', 'totalProducts','exchangeRate','currencySymbol'));
    }

    public function singleProduct($id)
    {
        // Fetch the current product along with its images and specifications
        $products = Product::with('images', 'category')->findOrFail($id);



        //  dd($products);
        $specifications = ProductSpecification::where('product_id', $id)->with('key')->get();

        // Fetch related products from the same category
        $relatedProducts = Product::where('category_id', $products->category_id)
            ->where('id', '!=', $products->id)
            ->with('images')
            ->take(4)
            ->get();

        $reviews = $products->reviews()->where('status', 1)->get();

        

        $cart = Cart::get();

        $product_sml_share = [];

    // Check if the product is shareable
    if ($products->is_shareable) {
        $product_sml_share = ProductSMLShare::all();
    }

        
    $wishlistProductIds = Wishlist::pluck('product_id')->toArray();
        //   dd($relatedProducts);
        $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
        $currencySymbol = session('currency_symbol', '$');


        return view('frontend.single_product', compact('products', 'specifications', 'relatedProducts', 'reviews', 'cart','product_sml_share','exchangeRate','currencySymbol','wishlistProductIds'));
    }

    public function wishlist()
    {
        $cart = Cart::get();
        $wishlist = Wishlist::with('product')->get();
        return view('frontend.wishlist', compact('cart', 'wishlist'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product) {
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->name = $product->title;
            $cart->price = $product->offer_price;
            $cart->quantity = 1; // Default quantity or get from request
            $cart->image = $product->image;
            $cart->save();

            return response()->json(['status' => 'success', 'message' => 'Item added to cart']);
        }
        return response()->json(['status' => 'error', 'message' => 'Product not found']);
    }


    public function addToWishlist(Request $request)
    {
        $productId = $request->input('product_id');


        // Check if the product is already in the wishlist
        $wishlistItem = Wishlist::where('product_id', $productId)
            ->first();

        if (!$wishlistItem) {
            Wishlist::create([
                'product_id' => $productId,
            ]);

            return response()->json(['message' => 'Product added to wishlist'], 200);
        } else {
            return response()->json(['message' => 'Product is already in your wishlist'], 400);
        }
    }

    public function wishlistDelete($id)
    {
        $wishlist = Wishlist::find($id);

        if ($wishlist) {
            $wishlist->delete();
        }

        return redirect()->route('wishlist')->with('success', 'Wishlist item deleted successfully');
    }

    public function wishlistRemove($productId)
{
    $wishlist = Wishlist::where('product_id', $productId)->first();

    if ($wishlist) {
        $wishlist->delete();
    }

   return redirect()->back()->with('success', 'Wishlist item Remove successfully');
}



    public function cart(Request $request)
    {

        $cartcount = Cart::count();
        $cart = Cart::with('product')->get();

        // Calculate the total amount
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item->quantity * $item->product->offer_price;

            $singleAmount = $item->product->offer_price;
        }
        // dd($totalAmount );
     

        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');

        // Convert totalAmount to country-based currency
        $totalAmountInCountryCurrency = $totalAmount * $exchangeRate;


        // dd($totalAmountInCountryCurrency);

        // Fetch shipping rules
        $shippingRules = Shipping::all();

        // Determine the applicable shipping fee
        $shippingFee = 0;
        foreach ($shippingRules as $rule) {

            $conditionFromInCountryCurrency = $rule->condition_from * $exchangeRate;
            $conditionToInCountryCurrency = $rule->condition_to * $exchangeRate;
            // dd( $conditionFromInCountryCurrency);
            // dd( $conditionToInCountryCurrency);

            if ($totalAmountInCountryCurrency >= $conditionFromInCountryCurrency && $totalAmountInCountryCurrency <= $conditionToInCountryCurrency) {
                $shippingFee = $rule->shipping_fee * $exchangeRate;
                break;
            }
        }

        //  dd($shippingFee);


        // Initialize coupon discount
        $couponDiscount = 0;
        $couponCode = $request->input('coupon');
        $appliedCoupon = null;
        $res_coupon = "";

        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');


        $totalAmountConverted = $totalAmount * $exchangeRate;

        // dd($totalAmountConverted);

        // Check for coupon code in the request
        
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            // dd($coupon);

            if ($coupon) {
                // Convert coupon's minimum_purchase_price and discount_value to the target currency
                $mini_price_converted = $coupon->minimum_purchase_price * $exchangeRate;
                $discount_value_converted = $coupon->discount_value * $exchangeRate;

                // dd($mini_price_converted);
                // dd($discount_value_converted);

                if ($totalAmountConverted <= $mini_price_converted) {
                    $res_coupon = "Not Applied";
                } else {
                    if ($coupon->discount_type == 'percentage') {
                        $discount = ($totalAmountConverted * $coupon->discount_value) / 100;
                        $totalAmountConverted -= $discount;
                        $res_coupon = $discount;
                    } elseif ($coupon->discount_type == 'fixed') {
                        $totalAmountConverted -= $discount_value_converted;
                        $res_coupon = $discount_value_converted;
                    }
                    //    dd($discount_value_converted);

                }
            }
        }

        // dd($res_coupon);
        // Convert the final totalAmount back to the original currency for further use
        $totalAmount = $totalAmountConverted / $exchangeRate;


        session(['res_coupon' => $res_coupon]);


        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');

        $finalTotalAmount = $totalAmount  + $shippingFee;


        // Convert individual item prices to selected currency
        foreach ($cart as $item) {
            $item->price *= $exchangeRate;
        }



        return view('frontend.cart', compact('cart', 'totalAmount', 'shippingFee', 'couponDiscount', 'appliedCoupon', 'res_coupon', 'finalTotalAmount', 'cartcount', 'exchangeRate', 'currencySymbol'));
    }




    public function checkout(Request $request)
    {

        $cart = Cart::with('product')->get();

        // Calculate the total amount
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item->quantity * $item->product->offer_price;
        }
        // dd($totalAmount );

        $user = auth()->user();

        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '$');

        // Convert totalAmount to country-based currency
        $totalAmountInCountryCurrency = $totalAmount * $exchangeRate;


        // dd($totalAmountInCountryCurrency);

        // Fetch shipping rules
        $shippingRules = Shipping::all();

        // Determine the applicable shipping fee
        $shippingFee = 0;
        foreach ($shippingRules as $rule) {

            $conditionFromInCountryCurrency = $rule->condition_from * $exchangeRate;
            $conditionToInCountryCurrency = $rule->condition_to * $exchangeRate;
            // dd( $conditionFromInCountryCurrency);
            // dd( $conditionToInCountryCurrency);

            if ($totalAmountInCountryCurrency >= $conditionFromInCountryCurrency && $totalAmountInCountryCurrency <= $conditionToInCountryCurrency) {
                $shippingFee = $rule->shipping_fee * $exchangeRate;
                break;
            }
        }
        $Address = null;
        if ($user != null) {
            $shippingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 1) // Shipping address
                ->get();

            $Address = Addresses::where('user_id', $user->id)
                ->where('type', 1)
                ->first();

            $userHasShippingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 1) // Shipping address
                ->exists();
        }

        // If billing address exists, pre-fill the request with billing address data
        // if ($billingAddress) {
        //     $request->merge([
        //         'name' => $request->input('name', $billingAddress->name),
        //         'email' => $request->input('email', $billingAddress->email),
        //         'mobile' => $request->input('mobile', $billingAddress->mobile),
        //         'country' => $request->input('country', $billingAddress->country),
        //         'state' => $request->input('state', $billingAddress->state),
        //         'city' => $request->input('city', $billingAddress->city),
        //         'address' => $request->input('address', $billingAddress->address),
        //         'pincode' => $request->input('pincode', $billingAddress->pincode),
        //     ]);
        // }

        $res_coupon = session('res_coupon', 0);

        //    dd($res_coupon);

        $finalTotalAmount = $totalAmount  + $shippingFee;


        $user = auth()->user();

        $billingAddress = null;
        $shippingAddress = null;
        $userHasShippingAddress = null;

        if ($user) {
            // Fetch existing addresses
            $billingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 0) // Billing address
                ->first();

            $shippingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 1) // Shipping address
                ->first();

            $userHasShippingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 1) // Shipping address
                ->exists();
            // If billing address exists, pre-fill the request with billing address data
            if ($billingAddress) {
                $request->merge([
                    'name' => $request->input('name', $billingAddress->name),
                    'email' => $request->input('email', $billingAddress->email),
                    'mobile' => $request->input('mobile', $billingAddress->mobile),
                    'country' => $request->input('country', $billingAddress->country),
                    'state' => $request->input('state', $billingAddress->state),
                    'city' => $request->input('city', $billingAddress->city),
                    'address' => $request->input('address', $billingAddress->address),
                    'pincode' => $request->input('pincode', $billingAddress->pincode),
                ]);
            }

            // If shipping address exists and the ship_different flag is set, pre-fill the request with shipping address data
            if ($request->has('ship_different') && $shippingAddress) {
                $request->merge([
                    'shipping_name' => $request->input('shipping_name', $shippingAddress->name),
                    'shipping_email' => $request->input('shipping_email', $shippingAddress->email),
                    'shipping_mobile' => $request->input('shipping_mobile', $shippingAddress->mobile),
                    'shipping_country' => $request->input('shipping_country', $shippingAddress->country),
                    'shipping_state' => $request->input('shipping_state', $shippingAddress->state),
                    'shipping_city' => $request->input('shipping_city', $shippingAddress->city),
                    'shipping_address' => $request->input('shipping_address', $shippingAddress->address),
                    'shipping_pincode' => $request->input('shipping_pincode', $shippingAddress->pincode),
                ]);
            }

            $shippingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 1) // Shipping address
                ->get();

            $Address = Addresses::where('user_id', $user->id)
                ->where('type', 1)
                ->first();



            $userHasShippingAddress = Addresses::where('user_id', $user->id)
                ->where('type', 1) // Shipping address
                ->exists();


            // If billing address exists, pre-fill the request with billing address data
            if ($billingAddress) {
                $request->merge([
                    'name' => $request->input('name', $billingAddress->name),
                    'email' => $request->input('email', $billingAddress->email),
                    'mobile' => $request->input('mobile', $billingAddress->mobile),
                    'country' => $request->input('country', $billingAddress->country),
                    'state' => $request->input('state', $billingAddress->state),
                    'city' => $request->input('city', $billingAddress->city),
                    'address' => $request->input('address', $billingAddress->address),
                    'pincode' => $request->input('pincode', $billingAddress->pincode),
                ]);
            }


            // dd($finalTotalAmount);

            $exchangeRate = session('exchange_rate', 1);
            $currencySymbol = session('currency_symbol', '$');


            // dd($totalAmountInCountryCurrency);
            // Convert individual item prices to selected currency
            foreach ($cart as $item) {
                $item->price *= $exchangeRate;
            }
        }
        return view('frontend.checkout', compact('cart', 'totalAmount', 'shippingFee', 'finalTotalAmount', 'res_coupon', 'billingAddress', 'shippingAddress', 'userHasShippingAddress', 'Address', 'exchangeRate', 'currencySymbol'));
    }

    public function myaccount()
    {
        $user = Auth::user();
        $cart = Cart::all();
        $order = Order::all();
        if ($user) {
            $address = Addresses::where('user_id', $user->id)
                ->where('type', 0)
                ->get();
        } else {
            // Set $address to null if there's no authenticated user
            $address = null;
        }

        //   dd($address);
        return view('frontend.myaccount', compact('cart', 'order', 'address', 'user'));
    }

    //personal information

  
    public function userupdate(Request $request)
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
          $imagePath = $request->file('image')->store('profileimages', 'public');
          $user->image = $imagePath;
      }
     
        $user->save();
 
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
  



    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:addresses,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $address = Addresses::find($request->id);
        $address->name = $request->name;
        $address->address = $request->address;
        $address->save();

        return redirect()->back()->with('success', 'Address updated successfully!');
    }



    public function contactstore(Request $request)
    {

        $notifyData =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,

            'email' => $request->email,
            'message' => $request->message,
        ];
        //   dd($data);
        $mailData = Contact::create($data);
        Mail::to('developer@itsk.in')->send(new ContactFormMail($mailData));
        Mail::to($request['email'])->send(new ContactReplyMail($mailData));

        event(new ContactNotificationEvent($request->input('name')));

        $admins = User::all();

        foreach ($admins as $admin) {
            $admin->notify(new ContactNotification($notifyData));
        }


        return redirect()->back()->with('success', 'We recieved your message, Our team contact shortly Thank You!');
    }


 public function setCountry(Request $request)
    {
        $request->validate([
            'country' => 'required|string'
        ]);

        $country = $request->country;
        session(['country' => $country]);

        $client = new Client();
        $apiKey = '93426a64e4020f5d28396f59';
        $apiUrl = 'https://v6.exchangerate-api.com/v6/' . $apiKey . '/latest/USD';

        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);
            // Set exchange rate and currency symbol based on the country
            switch ($country) {
                case 'US':
                    session(['exchange_rate' => 1, 'currency_symbol' => '$']);
                    break;
                case 'IN':
                    $exchangeRate = $data['conversion_rates']['INR'] ?? 0.013;
                    session(['exchange_rate' => $exchangeRate, 'currency_symbol' => '₹']);
                    break;
                case 'UK':
                    $exchangeRate = $data['conversion_rates']['GBP'] ?? 1.39;
                    session(['exchange_rate' => $exchangeRate, 'currency_symbol' => '£']);
                    break;
                default:
                    session(['exchange_rate' => 1, 'currency_symbol' => '$']);
                    break;
            }
        } catch (\Exception $e) {
            // Handle exception if the API request fails
            switch ($country) {
                case 'US':
                    session(['exchange_rate' => 1, 'currency_symbol' => '$']);
                    break;
                case 'IN':
                    session(['exchange_rate' => 83.49, 'currency_symbol' => '₹']);
                    break;
                case 'UK':
                    session(['exchange_rate' => 0.79, 'currency_symbol' => '£']);
                    break;
                default:
                    session(['exchange_rate' => 1, 'currency_symbol' => '$']);
                    break;
            }
        }

        return redirect()->back();
    }

public function buyNow($productId, Request $request)
{
    // Add product to cart
    $product = Product::findOrFail($productId);

    $existingCartItem = Cart::where('product_id', $product->id)->first();

    if ($existingCartItem) {
        // If the product is already in the cart, update the quantity
        $existingCartItem->quantity += 1;
        $existingCartItem->save();
    } else {
        Cart::create([
            'product_id' => $product->id,
            'name' => $product->title,
            'price' => $product->offer_price,
            'image' => $product->image,
            'quantity' => 1,
        ]);
    }

    // Store the cart in a cookie
    $cart = Cart::all();
    Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days

    // Redirect to the checkout page
    return redirect()->route('checkout')->with('success', 'Product added to cart successfully');
}


public function changePassword(Request $request)
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

public function vieworder($id){

   
    $cart=Cart::all();
    $order = Order::with('orderItems.product')->findOrFail($id);

  

    return view( 'frontend.vieworder',compact('cart','order'));
}


}
