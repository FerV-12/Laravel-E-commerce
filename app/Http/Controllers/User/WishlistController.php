<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $items = Wishlist::with('product')->where('user_id', $user->id)->get();

        return view('user.wishlist.index', ['items' => $items]);
    }

    public function toggle(Request $request)
    {
        $user = Auth::user();
        $productId = (int) $request->input('product_id');

        if (!$productId || !Product::find($productId)) {
            return response()->json(['success' => false, 'message' => 'Invalid product'], 422);
        }

        $existing = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($existing) {
            $existing->delete();
            $action = 'removed';
        } else {
            Wishlist::create(['user_id' => $user->id, 'product_id' => $productId]);
            $action = 'added';
        }

        $count = Wishlist::where('user_id', $user->id)->count();

        return response()->json(['success' => true, 'action' => $action, 'count' => $count]);
    }

    public function remove(Request $request)
    {
        $user = Auth::user();
        $productId = (int) $request->input('product_id');

        Wishlist::where('user_id', $user->id)->where('product_id', $productId)->delete();

        return redirect()->route('user.wishlist.index')->with('success', 'Removed from wishlist');
    }
}
