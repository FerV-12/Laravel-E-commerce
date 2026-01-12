<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $user = Auth::user();

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        
        return view('user.cart.cart', [
            'cart' => $cartItems
        ]);
    }

    // Add to cart
    public function add(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

        $product = Product::find($productId);
        if ($product->quantity <= 0) {
            return redirect()->route('user.dashboard')->with('error', 'This product is out of stock.');
        }
        if ($cartItem) {
            // If exists, increase quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Else create new
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }
        
        // Ensure we compare against a defined requested quantity
        $requestedQty = $cartItem->quantity ?? 1;
        if ($product->quantity < $requestedQty) {
            // Rollback the change if we accidentally exceeded stock
            if ($cartItem) {
                // If the item was newly created and stock is insufficient, remove it
                if ($cartItem->quantity <= 1) {
                    $cartItem->delete();
                } else {
                    // Otherwise, decrement to previous safe value
                    $cartItem->quantity = max(0, $cartItem->quantity - 1);
                    $cartItem->save();
                }
            }

            return redirect()->route('user.cart.index')->with('error', 'The requested quantity is not available.');
        }

        Wishlist::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->delete();


        // Check if request is AJAX
        if ($request->ajax()) {
            $cartCount = Cart::where('user_id', $user->id)->sum('quantity');
            return response()->json([
                'success' => true,
                'cartCount' => $cartCount
            ]);
        }
        
        return redirect()->route('user.cart.index')->with('success', 'Product added to cart!');
    }

    // Remove item
    public function remove(Request $request)
    {
        $user = Auth::user();

        Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->delete();

        // Check if request is AJAX
        if ($request->ajax()) {
            $cartCount = Cart::where('user_id', $user->id)->sum('quantity');
            return response()->json([
                'success' => true,
                'cartCount' => $cartCount
            ]);
        }

        return redirect()->route('user.cart.index')->with('success', 'Item removed from cart.');
    }

    // Update quantity
    public function update(Request $request)
    {
        $user = Auth::user();

        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $quantity = max(1, intval($request->quantity)); // Ensure minimum quantity is 1
            if ($quantity > $cartItem->product->quantity) {
                return redirect()->route('user.cart.index')->with('error', 'The requested quantity is not available.');
            }


            $cartItem->quantity = $quantity;
            $cartItem->save();

            // For AJAX, return updated cart count
            if ($request->ajax()) {
                $cartCount = Cart::where('user_id', $user->id)->sum('quantity');
                return response()->json([
                    'success' => true,
                    'cartCount' => $cartCount,
                    'newSubtotal' => $cartItem->product->selling_price * $cartItem->quantity
                ]);
            }

            return redirect()->route('user.cart.index')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('user.cart.index')->with('error', 'Product not found in cart.');
    }
}
