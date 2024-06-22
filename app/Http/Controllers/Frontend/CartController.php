<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
     public function addToCart($productId,Request $request)
    {


        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $product = Product::findOrFail($productId);

    $existingCartItem = Cart::where('product_id', $product->id)->first();


    $quantity = $request->input('quantity', 1); 

    if ($existingCartItem) {
        // If the product is already in the cart, update the quantity
        $existingCartItem->quantity += $quantity;
        $existingCartItem->save();

        return redirect()->route('cart')->with('info', 'Product quantity updated in the cart');
 
        }
       
        Cart::create([
            'product_id' => $product->id,
            'name' => $product->title,
            'price' => $product->offer_price,
            'image' => $product->image,
            'quantity' => 1,
        ]);

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days

        return redirect()->route('cart')->with('success', 'Product added to cart successfully');

    }


    
       public function updateCart(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        // Loop through each submitted item quantity
        foreach ($request->quantity as $key => $quantity) {
            // Find the cart item by its ID
            $cartItem = Cart::findOrFail($request->item_id[$key]);

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
