<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addToCart($productId, Request $request)
{
    $cart = json_decode(Cookie::get('cart', '[]'), true);
    $product = Product::findOrFail($productId);

    $existingCartItem = Cart::where('product_id', $product->id)->first();
    $quantity = $request->input('quantity', 1); 

    if ($existingCartItem) {
        // Check if the updated quantity exceeds available stock
        if (($existingCartItem->quantity + $quantity) > $product->qty) {
            return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
        }

        // If the product is already in the cart, update the quantity
        $existingCartItem->quantity += $quantity;
        $existingCartItem->save();

        return redirect()->route('cart')->with('info', 'Product quantity updated in the cart');
    } else {
        // Check if the new quantity exceeds available stock
        if ($quantity > $product->qty) {
            return redirect()->back()->with('info', 'The requested quantity exceeds available stock.');
        }

        Cart::create([
            'product_id' => $product->id,
            'name' => $product->title,
            'price' => $product->offer_price,
            'image' => $product->image,
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
        $product = Product::findOrFail($cartItem->product_id);

        // Check if the updated quantity exceeds available stock
        if ($quantity > $product->qty) {
            return redirect()->back()->with('info', 'The requested quantity for '.$product->title.' exceeds available stock.');
        }

        // Update the quantity
        $cartItem->quantity = $quantity;

        // Save the changes
        $cartItem->save();
    }

    Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); 
    // Redirect back to the cart page or wherever you want
    return redirect()->back()->with('success', 'Cart updated successfully');
}

    public function removeCart($id)
    {
        $cartitem=json_decode(Cookie::get('cart', '[]'), true);
        $cart = Cart::find($id);

        $cart->delete();

        Cookie::queue('cart', json_encode($cartitem), 60 * 24 * 30);

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

}
