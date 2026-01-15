<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    public function index()
    {
        $total = Product::count();
        $active = Product::where('is_active', 1)->count();
        $inactive = Product::where('is_active', 0)->count();

        $stocks = Product::sum('quantity');
        $outOfStockCount = Product::where('quantity', '<=', 0)->count();
        $ordersCount = Order::count();

        
        // ✅ TOTAL SALES (from order_items)
         $totalSales = DB::table('order_items')
        ->select(DB::raw('SUM(quantity * price) as total'))
        ->value('total') ?? 0;
        
        return view('admin.dashboard', compact(
            'total',
            'active',
            'inactive',
            'stocks',
            'outOfStockCount',
            'ordersCount',
            'totalSales',
        ));
    }
}

