<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductColor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart($productColorId, Request $request)
    {
        $productColor = ProductColor::findOrFail($productColorId);
        $product = $productColor->product;
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            // For authenticated users
            $existingCartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)->first();

            if ($existingCartItem) {
                // Check stock availability
                if (($existingCartItem->quantity + $quantity) > $productColor->qty) {
                    return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
                }

                // Update existing cart item
                $existingCartItem->quantity += $quantity;
                $existingCartItem->save();
            } else {
                if ($quantity > $productColor->qty) {
                    return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
                }

                // Create a new cart item
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'product_color_id' => $productColorId,
                    'name' => $product->title,
                    'price' => $productColor->offer_price,
                    'image' => $productColor->single_image,
                    'quantity' => $quantity,
                ]);
            }

            return redirect()->route('cart')->with('success', 'Product added to cart successfully');
        } else {
            // For unauthenticated users
            $cart = session('cart', []);

            $existingCartItemIndex = array_search($product->id, array_column($cart, 'product_id'));

            if ($existingCartItemIndex !== false) {
                // Check stock availability
                if (($cart[$existingCartItemIndex]['quantity'] + $quantity) > $productColor->qty) {
                    return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
                }

                // Update existing cart item
                $cart[$existingCartItemIndex]['quantity'] += $quantity;
            } else {
                if ($quantity > $productColor->qty) {
                    return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
                }

                // Add new cart item
                $cart[] = [
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'product_color_id' => $productColorId,
                    'price' => $productColor->offer_price,
                    'image' => $productColor->single_image,
                    'quantity' => $quantity,
                ];
            }

            session(['cart' => $cart]);

            return redirect()->route('cart')->with('success', 'Product added to cart successfully');
        }
    }



    public function updateCart(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // Loop through each submitted item quantity
        foreach ($request->quantity as $key => $quantity) {
            // Find the cart item by its ID
            $cartItem = Cart::findOrFail($request->item_id[$key]);
            $productColor = ProductColor::findOrFail($cartItem->product_id);


            // Check if the updated quantity exceeds available stock
            if ($quantity > $productColor->qty) {
                return redirect()->back()->with('info', 'The requested quantity for ' . $productColor->title . ' exceeds available stock.');
            }

            // Update the quantity
            $cartItem->quantity = $quantity;

            // Save the changes
            $cartItem->save();
        }

        // dd($cartItem);

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
        // Redirect back to the cart page or wherever you want
        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function removeCart($id)
    {
        $cartitem = json_decode(Cookie::get('cart', '[]'), true);
        $cart = Cart::find($id);

        $cart->delete();

        Cookie::queue('cart', json_encode($cartitem), 60 * 24 * 30);

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
    public function updateCartForUnauthenticated(Request $request)
    {
        $sessionCart = session()->get('cart', []);

        if (is_array($sessionCart)) {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');

            // Iterate through the session cart to update the quantity for the specified product
            foreach ($sessionCart as &$item) {
                if (is_array($item) && isset($item['product_id']) && $item['product_id'] == $productId) {
                    $item['quantity'] = $quantity;
                    break;
                }
            }

            // Store the updated cart back in the session
            session()->put('cart', $sessionCart);
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }




    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        // Fetch the cart from the session
        $sessionCart = session('cart', []);

        // Check if the cart is an array
        if (is_array($sessionCart)) {
            // Filter out the item with the specified product_id
            $sessionCart = array_filter($sessionCart, function ($item) use ($productId) {
                return isset($item['product_id']) && $item['product_id'] != $productId;
            });

            // Reindex the array to prevent gaps in the indexes
            $sessionCart = array_values($sessionCart);

            // Store the updated cart back in the session
            session()->put('cart', $sessionCart);
        }

        return response()->json(["status" => "Success"]);
    }





  

}
