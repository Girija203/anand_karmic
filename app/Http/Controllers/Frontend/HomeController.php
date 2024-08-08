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
use App\Models\AboutSection;
use App\Models\PrivacyPolicy;
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
use App\Models\Notification;
use App\Models\OrderItem;
use App\Models\ProductColor;
use App\Models\ProductShowCase;
use App\Models\ProductVariantColor;
use App\Models\ShowCaseProduct;
use App\Models\TermsAndCondition;
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
        return view('frontend.home', compact('cart', 'showCaseProducts', 'ProductShowCases', 'exchangeRate', 'currencySymbol'));
    }

    public function about()
    {
        $cart = Cart::get();
        $about_sections = AboutSection::with('images')->get();

        // Separate and sort the sections
        $first_is_left = $about_sections->where('is_left', 1)->first();
        $is_left_zero = $about_sections->where('is_left', 0);
        $remaining_is_left = $about_sections->where('is_left', 1)->skip(1);

        // Combine the sorted sections
        $sorted_about_sections = collect([$first_is_left])->merge($is_left_zero)->merge($remaining_is_left);

        return view('frontend.about', compact('cart', 'sorted_about_sections'));
    }

    public function termsCondition()
    {
        $cart = Cart::get();
        $termConditions = TermsAndCondition::get();
        return view('frontend.terms_condition', compact('cart', 'termConditions'));
    }
    public function privacyPolicy()
    {
        $cart = Cart::get();
        $privacyPolicies = PrivacyPolicy::get();
        return view('frontend.privacy_policy', compact('cart', 'privacyPolicies'));
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
        $perPage = 10;

        // Fetch all products with pagination
        $products = Product::where('status', 1)->paginate($perPage);
        $totalProducts = Product::count();

        $cart = Cart::get();
        $categories = Category::all();
        $specifications = ProductSpecification::where('product_specification_key_id', 2)->get();

        $cartItems = Cart::with(['product.colors'])->get();
        $cart = $cartItems->map(function ($item) {
            $product = $item->product;
            $productColor = $product->colors->first(); // Assuming you want the first color, adjust as necessary

            $discount = 0;

            if ($productColor && $productColor->offer_price && $productColor->price > $productColor->offer_price) {
                $discount = $productColor->price - $productColor->offer_price;
            }

            $item->discount = $discount;
            $item->price = $productColor ? $productColor->price : 0;
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
        $currencySymbol = session('currency_symbol', '₹'); // Default to $ if not set
        // dd($products[1]->colors[0]->single_image);
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

        return view('frontend.shop', compact('categories', 'products', 'specifications', 'cart', 'totalProducts', 'exchangeRate', 'currencySymbol'));
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

        return view('frontend.shop', compact('products', 'specifications', 'categories', 'cart', 'totalProducts', 'exchangeRate', 'currencySymbol'));
    }

    public function singleProduct($id)
    {
        // Fetch the current product along with its images and specifications
        $products = Product::with('images', 'category')->findOrFail($id);

        // Fetch product colors and related color data
        $productColors = ProductColor::where('product_id', $id)->with('color')->get();

        $quantities = $productColors->pluck('qty');

        // dd($quantities); 

        // Fetch product variant colors and their associated color data
        $productVariantColors = ProductVariantColor::where('main_product_id', $products->id)
            ->with('color')
            ->get();

        $specifications = ProductSpecification::where('product_id', $id)->with('key')->get();

        // Fetch related products from the same category
        $relatedProducts = Product::where('category_id', $products->category_id)
            ->where('id', '!=', $products->id)
            ->with('images')
            ->take(4)
            ->get();

        $reviews = $products->reviews()->where('status', 1)->get();

        $cart = Cart::where('product_id', $id)->get();

        $product_sml_share = [];

        // Check if the product is shareable
        if ($products->is_shareable) {
            $product_sml_share = ProductSMLShare::all();
        }

        $wishlistProductIds = Wishlist::pluck('product_id')->toArray();
        $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
        $currencySymbol = session('currency_symbol', '₹');

        return view('frontend.single_product', compact('products', 'specifications', 'relatedProducts', 'reviews', 'cart', 'product_sml_share', 'exchangeRate', 'currencySymbol', 'wishlistProductIds', 'productColors', 'productVariantColors', 'quantities'));
    }



    public function productsByColor($colorId)
    {
        $products = Product::whereHas('productVariantColors', function ($query) use ($colorId) {
            $query->where('color_id', $colorId);
        })->with('images', 'category')->get();

        $exchangeRate = session('exchange_rate', 1); // Default to 1 if not set
        $currencySymbol = session('currency_symbol', '₹');

        return view('frontend.products_by_color', compact('products', 'exchangeRate', 'currencySymbol'));
    }

    public function wishlist()
    {
        $cart = Cart::get();
        $wishlist = Wishlist::with(['product', 'productColor'])->get();
        return view('frontend.wishlist', compact('cart', 'wishlist'));
    }
   
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $productColorId = $request->input('product_color_id');
        $quantity = $request->input('quantity', 1);

        if ($product) {
            $productColor = $productColorId ? ProductColor::find($productColorId) : null;

            // For authenticated users
            if (Auth::check()) {
                $existingCartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->where('product_color_id', $productColorId)
                    ->first();

                if ($existingCartItem) {
                    // Check stock availability
                    if ($productColor && ($existingCartItem->quantity + $quantity) > $productColor->qty) {
                        return response()->json(['status' => 'error', 'message' => 'The requested quantity exceeds available stock']);
                    }

                    // Update existing cart item
                    $existingCartItem->quantity += $quantity;
                    $existingCartItem->save();
                } else {
                    if ($productColor && $quantity > $productColor->qty) {
                        return response()->json(['status' => 'error', 'message' => 'The requested quantity exceeds available stock']);
                    }

                    // Create a new cart item
                    Cart::create([
                        'user_id' => Auth::id(),
                        'product_id' => $product->id,
                        'product_color_id' => $productColorId,
                        'name' => $product->title,
                        'price' => $productColor ? $productColor->offer_price : $product->offer_price,
                        'image' => $productColor ? $productColor->single_image : $product->image,
                        'quantity' => $quantity,
                    ]);
                }

                return response()->json(['status' => 'success', 'message' => 'Item added to cart']);
            } else {
                // For unauthenticated users
                $cart = session('cart', []);

                $existingCartItemIndex = array_search($product->id, array_column($cart, 'product_id'));
                $existingCartItemColorIndex = array_search($productColorId, array_column($cart, 'product_color_id'));

                if ($existingCartItemIndex !== false && $existingCartItemColorIndex !== false) {
                    // Check stock availability
                    if ($productColor && ($cart[$existingCartItemColorIndex]['quantity'] + $quantity) > $productColor->qty) {
                        return response()->json(['status' => 'error', 'message' => 'The requested quantity exceeds available stock']);
                    }

                    // Update existing cart item
                    $cart[$existingCartItemColorIndex]['quantity'] += $quantity;
                } else {
                    if ($productColor && $quantity > $productColor->qty) {
                        return response()->json(['status' => 'error', 'message' => 'The requested quantity exceeds available stock']);
                    }

                    // Add new cart item
                    $cart[] = [
                        'product_id' => $product->id,
                        'product_title' => $product->title,
                        'product_color_id' => $productColorId,
                        'price' => $productColor ? $productColor->offer_price : $product->offer_price,
                        'image' => $productColor ? $productColor->single_image : $product->image,
                        'quantity' => $quantity,
                    ];
                }

                session(['cart' => $cart]);

                return response()->json(['status' => 'success', 'message' => 'Item added to cart']);
            }
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
        $cartcount = 0;
        $cart = collect(); // Initialize an empty collection
        $totalAmount = 0;
        $shippingFee = 0;
        $res_coupon = 0;
        $sessionCart = [];

        if (Auth::check()) {
            // Fetch cart items from the database for authenticated users
            $cart = Cart::with('product')->where('user_id', Auth::id())->get();
            $cartcount = $cart->count();

            foreach ($cart as $item) {
                $offerPrice = ProductColor::where('product_id', $item->product_id)->min('offer_price');
                if (!$offerPrice) {
                    $offerPrice = $item->product->offer_price;
                }
                $totalAmount += $item->quantity * $offerPrice;
            }
        } else {
            // Fetch cart items from the session for unauthenticated users
            $sessionCart = session('cart', []);

            if (is_array($sessionCart)) {
                $cartcount = count($sessionCart); // Count all items in the session cart

                foreach ($sessionCart as $sessionItem) {
                    if (is_array($sessionItem)) {
                        $product = Product::find($sessionItem['product_id']);
                        if ($product) {
                            $offerPrice = ProductColor::where('product_id', $sessionItem['product_id'])->min('offer_price');
                            if (!$offerPrice) {
                                $offerPrice = $product->offer_price;
                            }
                            $totalAmount += $sessionItem['quantity'] * $offerPrice;
                            $cart->push((object)[
                                'id' => 0, // No database ID
                                'product_id' => $sessionItem['product_id'],
                                'name' => $sessionItem['product_title'],
                                'price' => $offerPrice,
                                'image' => $sessionItem['image'],
                                'quantity' => $sessionItem['quantity'],
                                'product' => $product
                            ]);
                        }
                    }
                }
            }
        }
        // Apply exchange rate conversion and other calculations
        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '₹');
        $totalAmountConverted = $totalAmount * $exchangeRate;

        // Determine applicable shipping fee based on total amount
        $shippingRules = Shipping::all();
        foreach ($shippingRules as $rule) {
            $conditionFromInCountryCurrency = $rule->condition_from * $exchangeRate;
            $conditionToInCountryCurrency = $rule->condition_to * $exchangeRate;
            if ($totalAmountConverted >= $conditionFromInCountryCurrency && $totalAmountConverted <= $conditionToInCountryCurrency) {
                $shippingFee = $rule->shipping_fee * $exchangeRate;
                break;
            }
        }

        // Apply coupon if provided in the request
        $couponCode = $request->input('coupon');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($coupon) {
                $totalAmountAfterDiscount = $totalAmountConverted;
                if ($totalAmountConverted >= $coupon->minimum_purchase_price * $exchangeRate) {
                    if ($coupon->discount_type == 'percentage') {
                        $discount = ($totalAmountConverted * $coupon->discount_value) / 100;
                        $totalAmountAfterDiscount -= $discount;
                        $res_coupon = $discount / $exchangeRate; // Convert discount back to original currency
                    } elseif ($coupon->discount_type == 'fixed') {
                        $totalAmountAfterDiscount -= $coupon->discount_value * $exchangeRate;
                        $res_coupon = $coupon->discount_value; // Already in original currency
                    }
                }
                $totalAmountConverted = $totalAmountAfterDiscount;
            }
        }
        session(['res_coupon' => $res_coupon]);

        session()->put('cart', $sessionCart);

        $finalTotalAmount = ($totalAmountConverted + $shippingFee - $res_coupon) / $exchangeRate;

        return view('frontend.cart', compact('cart', 'totalAmount', 'shippingFee', 'res_coupon', 'finalTotalAmount', 'cartcount', 'exchangeRate', 'currencySymbol'));
    }




    public function checkout(Request $request)
    {
        $totalAmount = 0;
        $shippingFee = session('shippingFee', 0);
        $res_coupon = session('res_coupon', 0);
        $cart = collect(); // Initialize an empty collection for cart items

        // Check if the user is authenticated
        if (Auth::check()) {
            // Fetch cart items from the database for authenticated users
            $cart = Cart::with('product')->where('user_id', Auth::id())->get();

            foreach ($cart as $item) {
                $offerPrice = ProductColor::where('product_id', $item->product_id)->min('offer_price');
                if (!$offerPrice) {
                    $offerPrice = $item->product->offer_price;
                }
                $totalAmount += $item->quantity * $offerPrice;
            }
        } else {
            // Fetch cart items from the session for unauthenticated users
            $sessionCart = session('cart', []);

            if (is_array($sessionCart)) {
                foreach ($sessionCart as $sessionItem) {
                    if (is_array($sessionItem)) {
                        $product = Product::find($sessionItem['product_id']);
                        if ($product) {
                            $offerPrice = ProductColor::where('product_id', $sessionItem['product_id'])->min('offer_price');
                            if (!$offerPrice) {
                                $offerPrice = $product->offer_price;
                            }
                            $totalAmount += $sessionItem['quantity'] * $offerPrice;
                            $cart->push((object)[
                                'id' => 0, // No database ID
                                'product_id' => $sessionItem['product_id'],
                                'name' => $sessionItem['product_title'],
                                'price' => $offerPrice,
                                'image' => $sessionItem['image'],
                                'quantity' => $sessionItem['quantity'],
                                'product' => $product
                            ]);
                        }
                    }
                }
            }
        }
        // Calculate the total amount
        foreach ($cart as $item) {
            $offerPrice = ProductColor::where('product_id', $item->product_id)->min('offer_price');
            if (!$offerPrice) {
                $offerPrice = $item->product->offer_price;
            }
            $totalAmount += $item->quantity * $offerPrice;
        }

        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '₹');

        // Convert totalAmount to country-based currency
        $totalAmountInCountryCurrency = $totalAmount * $exchangeRate;

        // Fetch shipping rules
        $shippingRules = Shipping::all();

        // Determine the applicable shipping fee
        foreach ($shippingRules as $rule) {
            $conditionFromInCountryCurrency = $rule->condition_from * $exchangeRate;
            $conditionToInCountryCurrency = $rule->condition_to * $exchangeRate;
            if ($totalAmountInCountryCurrency >= $conditionFromInCountryCurrency && $totalAmountInCountryCurrency <= $conditionToInCountryCurrency) {
                $shippingFee = $rule->shipping_fee * $exchangeRate;
                break;
            }
        }

        // Apply coupon if provided in the request
        $couponCode = $request->input('coupon');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($coupon) {
                $totalAmountAfterDiscount = $totalAmountInCountryCurrency;
                if ($totalAmountInCountryCurrency >= $coupon->minimum_purchase_price * $exchangeRate) {
                    if ($coupon->discount_type == 'percentage') {
                        $discount = ($totalAmountInCountryCurrency * $coupon->discount_value) / 100;
                        $totalAmountAfterDiscount -= $discount;
                        $res_coupon = $discount / $exchangeRate; // Convert discount back to original currency
                    } elseif ($coupon->discount_type == 'fixed') {
                        $totalAmountAfterDiscount -= $coupon->discount_value * $exchangeRate;
                        $res_coupon = $coupon->discount_value; // Already in original currency
                    }
                }
                $totalAmountInCountryCurrency = $totalAmountAfterDiscount;
            }
        }

        $finalTotalAmount = ($totalAmountInCountryCurrency + $shippingFee - $res_coupon) / $exchangeRate;

        $user = auth()->user();
        $billingAddress = null;
        $shippingAddress = null;
        $userHasShippingAddress = null;

        if ($user) {
            $billingAddress = Addresses::where('user_id', $user->id)->where('type', 0)->first();
            $shippingAddress = Addresses::where('user_id', $user->id)->where('type', 1)->first();
            $userHasShippingAddress = Addresses::where('user_id', $user->id)->where('type', 1)->exists();

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
                    'billing_same_as_shipping' => $userHasShippingAddress ? $request->input('billing_same_as_shipping', 1) : 1,
                ]);
            }
        }

        return view('frontend.checkout', compact('cart', 'totalAmount', 'shippingFee', 'res_coupon', 'finalTotalAmount', 'exchangeRate', 'currencySymbol', 'billingAddress', 'shippingAddress', 'userHasShippingAddress'));
    }

    public function myaccount()
    {
        $user = Auth::user();
        $cart = Cart::all();
        $order = Order::where('user_id', $user->id)->get();
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
        // Mail::to('developer@itsk.in')->send(new ContactFormMail($mailData));
        Mail::to($request['email'])->send(new ContactReplyMail($mailData));

        event(new ContactNotificationEvent($request->input('name')));

        $admins = User::all();

        foreach ($admins as $admin) {
            $unread_Count = $admin->unreadNotifications;
            $contact_Notification = $unread_Count->filter(function ($notification) {
                return $notification->type == 'App\Notifications\ContactNotification';
            });
            if (count($contact_Notification) < 5) {
                $admin->notify(new ContactNotification($notifyData));
            } else {
                $admin->notify(new ContactNotification($notifyData));
                $last_notification = $contact_Notification->sortByDesc('created_at')->last();
                $notificat = Notification::where('id', $last_notification->id)->first();
                $notificat->delete();
            }
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
        $apiUrl = 'https://v6.exchangerate-api.com/v6/' . $apiKey . '/latest/INR';

        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);
            // Set exchange rate and currency symbol based on the country
            switch ($country) {
                case 'IN':
                    session(['exchange_rate' => 1, 'currency_symbol' => '₹']);
                    break;
                case 'US':
                    $exchangeRate = $data['conversion_rates']['USD'] ?? 0.01198;
                    session(['exchange_rate' => $exchangeRate, 'currency_symbol' => '$']);
                    break;
                case 'UK':
                    $exchangeRate = $data['conversion_rates']['GBP'] ?? 0.009467;
                    session(['exchange_rate' => $exchangeRate, 'currency_symbol' => '£']);
                    break;
                default:
                    session(['exchange_rate' => 1, 'currency_symbol' => '₹']);
                    break;
            }
        } catch (\Exception $e) {
            // Handle exception if the API request fails
            switch ($country) {
                case 'IN':
                    session(['exchange_rate' => 1, 'currency_symbol' => '$']);
                    break;
                case 'US':
                    session(['exchange_rate' => 0.01198, 'currency_symbol' => '₹']);
                    break;
                case 'UK':
                    session(['exchange_rate' => 0.009467, 'currency_symbol' => '£']);
                    break;
                default:
                    session(['exchange_rate' => 1, 'currency_symbol' => '₹']);
                    break;
            }
        }

        return redirect()->back();
    }

    public function buyNow($productId, Request $request)
    {
        $product = Product::findOrFail($productId);
        $productColorId = $request->input('product_color_id');

        // Fetch product details based on the selected color
        $productColor = $product->colors->firstWhere('id', $productColorId);

        // Check if the user is authenticated
        if (!Auth::check()) {
            // Store the product details in session
            $productDetails = [
                'product_id' => $productId,
                'product_color_id' => $productColorId,
                'product_title' => $product->title,
                'price' => $productColor->offer_price,
                'image' => $productColor->single_image,
                'quantity' => 1,
            ];

            // Retrieve the current cart or create a new one if it doesn't exist
            $cart = session()->get('cart', []);

            if (!is_array($cart)) {
                $cart = [];
            }

            // Check if the product is already in the cart
            $productExists = false;
            foreach ($cart as &$item) {
                if (is_array($item) && $item['product_id'] == $productDetails['product_id'] && $item['product_color_id'] == $productDetails['product_color_id']) {
                    $item['quantity'] += $productDetails['quantity'];
                    $productExists = true;
                    break;
                }
            }

            // If the product is not in the cart, add it
            if (!$productExists) {
                $cart[] = $productDetails;
            }

            // Store the updated cart back in the session
            session()->put('cart', $cart);

            return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
        }
           
        // Add product to cart for authenticated users
        $existingCartItem = Cart::where('product_id', $product->id)->first();

        if ($existingCartItem) {
            // If the product is already in the cart, update the quantity
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'product_color_id' => $productColorId,
                'name' => $product->title,
                'price' => $productColor->offer_price,
                'image' => $productColor->single_image,
                'quantity' => 1,
            ]);
        }

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

    public function vieworder($id)
    {
        $cart = Cart::all();
        $order = Order::with(['orderItems.product', 'payment'])->findOrFail($id);
        // dd($order->user->addresses);
        $user = $order->user;
        $billingAddress = Addresses::getBillingAddress($user->id);
        $shippingAddress = Addresses::getShippingAddress($user->id);

        // If no shipping address exists, use the billing address
        if (!$shippingAddress) {
            $shippingAddress = $billingAddress;
        }
        return view('frontend.vieworder', compact('order', 'billingAddress', 'shippingAddress', 'cart'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');


        // Search products by title
        $category = Category::where('name', 'LIKE', "%{$query}%")->get();
        $products = Product::where('title', 'LIKE', "%{$query}%")->get();

        // dd($category);
        $result = [];
        foreach ($category as $item) {
            $products = Product::where('category_id', $item->id)->get();
            foreach ($products as $product) {
                $result[] = $product;
            }
        }

        // dd($result);

        $cart = Cart::all();

        $exchangeRate = session('exchange_rate', 1);
        $currencySymbol = session('currency_symbol', '₹');

        return view('frontend.search_results', compact('products', 'query', 'cart', 'exchangeRate', 'currencySymbol'));
    }
}
