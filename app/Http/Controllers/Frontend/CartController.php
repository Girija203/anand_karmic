<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductColor;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart($productColorId, Request $request)
    {
        // Decode the cart from the cookie or initialize an empty array if the cookie does not exist
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // Fetch the product color information
        $productColor = ProductColor::findOrFail($productColorId);
        $product = $productColor->product;

        // Check if the product color already exists in the cart
        $existingCartItem = Cart::where('product_id', $product->id)->first();
        $quantity = $request->input('quantity', 1);

        if ($existingCartItem) {
            // Check if the updated quantity exceeds available stock for the specific product color
            if (($existingCartItem->quantity + $quantity) > $productColor->qty) {
                return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
            }

            // If the product color is already in the cart, update the quantity
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();

            return redirect()->route('cart')->with('success', 'Product quantity updated in the cart');
        } else {
            // Check if the new quantity exceeds available stock for the specific product color
            if ($quantity > $productColor->qty) {
                return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
            }

            // Create a new cart item with the product color information
            Cart::create([
                'product_id' => $product->id,
                'product_color_id' => $productColor->id,
                'name' => $product->title,
                'price' => $productColor->offer_price,
                'image' => $productColor->single_image,
                'quantity' => $quantity,
            ]);

            Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days

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

        if (!empty($sessionCart)) {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');

            // Update the quantity in the session cart
            if (isset($sessionCart['product_id']) && $sessionCart['product_id'] == $productId) {
                $sessionCart['quantity'] = $quantity;
            }

            session()->put('cart', $sessionCart);
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }




    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        // Fetch the cart from the session
        $sessionCart = session('cart', []);

        // Remove the item with the specified product_id
        if (isset($sessionCart['product_id']) && $sessionCart['product_id'] == $productId) {
            session()->forget('cart'); // Remove entire cart from session if product_id matches
        }

        return response()->json(["Data" => "Success"]);
    }




  

}
