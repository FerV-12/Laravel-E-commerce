<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class UserDashboardController extends Controller
{
    public function index()
    {
        $products = Product::with(['category','brand'])
            ->latest()
            ->take(12)
            ->get();

        $shipsCount = Product::count();

        $categories = Category::all();

        return view('user.dashboard', compact('products','shipsCount','categories'));
    }
}
