<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PreorderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:1000',
            'contact_phone' => 'nullable|string|max:50'
        ]);

        $data['user_id'] = Auth::id();

        $pre = Preorder::create($data);

        // Optionally create a site notification for admin
        try {
            \App\Models\SiteNotification::create([
                'type' => 'preorder_created',
                'message' => "Pre-order: {$pre->product->name} x{$pre->quantity} by " . Auth::user()->name,
                'link' => route('admin.preorders.index'),
            ]);
        } catch (\Exception $e) {
            // ignore notification failures
        }

        return redirect()->back()->with('success', 'Pre-order submitted. We will notify you when available.');
    }
}
