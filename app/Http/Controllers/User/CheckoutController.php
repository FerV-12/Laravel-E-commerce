<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        // Use DB-backed cart for authenticated users
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart.index')->with('error', 'Your cart is empty.');
        }

        $items = [];
        $grandTotal = 0;

        foreach ($cartItems as $ci) {
            $product = $ci->product;
            $quantity = (int) $ci->quantity;
            $price = $product->selling_price ?? ($ci->price ?? 0);
            $subtotal = $price * $quantity;
            $grandTotal += $subtotal;

            // Resolve product image URL (handle raw filename vs stored path)
            $img = null;
            if ($product && $product->image) {
                if (\Illuminate\Support\Str::contains($product->image, '/')) {
                    $img = asset($product->image);
                } else {
                    $img = asset('uploads/products/' . $product->image);
                }
            } else {
                $img = asset('assets/images/placeholder.png');
            }

            $items[] = (object) [
                'product_id' => $product->id ?? $ci->product_id,
                'name' => $product->name ?? 'Product',
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal,
                'image' => $img,
            ];
        }

        return view('user.checkout.index', compact('items', 'grandTotal'));
    }

    public function placeOrder(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'address' => 'required|string|max:500',
            'contact_number' => 'required|string|max:30',
            'payment_method' => 'required|string|max:100',
        ]);

        // For placing order, read DB-backed cart for authenticated user
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('user.cart.index')->with('error', 'Your cart is empty.');
        }

        // Map payment method code to readable label
        $paymentMethodMap = [
            'cash_on_delivery' => 'Cash on Delivery (COD)',
            'e_wallet' => 'E-Wallet (Gcash/Maya)',
            'card' => 'Credit / Debit Card',
        ];

        $selectedPayment = $data['payment_method'] ?? 'cash_on_delivery';
        $paymentLabel = $paymentMethodMap[$selectedPayment] ?? $selectedPayment;

        // Persist order to DB
        $orderNumber = 'ORD-' . time() . '-' . rand(1000, 9999);
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'address' => $data['address'],
            'contact_number' => $data['contact_number'],
            'payment_method' => $paymentLabel,
            'total' => 0, // temporary, update after creating items
            'placed_at' => now(),
        ]);

        $orderItems = [];
        $grandTotal = 0;

        foreach ($cartItems as $ci) {
            $qty = (int) $ci->quantity;
            $product = $ci->product;
            $price = $product->selling_price ?? 0;
            $name = $product->name ?? 'Product';

            $subtotal = $price * $qty;
            if ($product->quantity < $qty) {
                    return redirect()->route('user.cart.index')->with('error', 'The requested quantity is not available.');
            }
            $product->quantity -= $qty;
            $product->save();
            $grandTotal += $subtotal;

            // Resolve image for order items
            if ($product && $product->image) {
                if (\Illuminate\Support\Str::contains($product->image, '/')) {
                    $img = asset($product->image);
                } else {
                    $img = asset('uploads/products/' . $product->image);
                }
            } else {
                $img = asset('assets/images/placeholder.png');
            }

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $ci->product_id,
                'product_name' => $name,
                'quantity' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
                'image' => $product->image ? $product->image : null,
            ]);

            $orderItems[] = $orderItem->toArray();
        }

        // Map payment method code to readable label
        $paymentMethodMap = [
            'cash_on_delivery' => 'Cash on Delivery (COD)',
            'e_wallet' => 'E-Wallet (Gcash/Maya)',
            'card' => 'Credit / Debit Card',
        ];

        $selectedPayment = $data['payment_method'] ?? 'cash_on_delivery';
        $paymentLabel = $paymentMethodMap[$selectedPayment] ?? $selectedPayment;

        // Update order total
        $order->total = $grandTotal;
        $order->save();

        // keep a lightweight session copy for thank-you view
        session(['last_order' => [
            'order_number' => $order->order_number,
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'address' => $order->address,
            'contact_number' => $order->contact_number,
            'payment_method' => $order->payment_method,
            'items' => $orderItems,
            'total' => $order->total,
            'placed_at' => $order->placed_at->toDateTimeString(),
        ]]);

        // Clear the DB cart for this user
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('user.checkout.thankyou')->with('success', 'Order placed successfully.');
    }

    public function thankYou()
    {
        $order = session('last_order');

        if (!$order) {
            return redirect()->route('user.dashboard');
        }

        return view('user.checkout.thankyou', compact('order'));
    }
}
