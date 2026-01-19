<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\SiteNotification;

class OrderObserver
{
    public function created(Order $order)
    {
        $customer = $order->user ?? null;
        $custName = $customer ? $customer->name : 'Guest';

        SiteNotification::create([
            'type' => 'order_created',
            'message' => "New order #{$order->id} by {$custName}",
            'link' => route('admin.orders.show', [$order->id]) ?? null,
        ]);
    }
}
