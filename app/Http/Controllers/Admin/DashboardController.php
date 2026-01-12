<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class DashboardController extends Controller
{
    public function index()
    {
        $total = Product::count();
        $active = Product::where('is_active', 1)->count();
        $inactive = Product::where('is_active', 0)->count();

        // Total stock quantity (sum of product quantities)
        $stocks = Product::sum('quantity');

        // Count products that have zero or negative quantity (out of stock)
        $outOfStockCount = Product::where('quantity', '<=', 0)->count();

        $ordersCount = Order::count();

        return view('admin.dashboard', compact('total', 'active', 'inactive', 'stocks', 'outOfStockCount', 'ordersCount'));
    }
}
