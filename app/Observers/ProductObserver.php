<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\SiteNotification;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
   public function updated(Product $product)
{
    $actor = Auth::user();
    $actorName = $actor ? $actor->name : 'System';

    if ($product->wasChanged('quantity')) {
        if ($product->quantity <= 5) {
            SiteNotification::create([
                'type' => 'low_stock',
                'message' => "Low stock: {$product->name} (qty: {$product->quantity})",
                'link' => route('admin.products.edit', [$product->id]),
                'actor_id' => $actor ? $actor->id : null,
            ]);
        }
    }
}
}
