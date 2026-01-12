<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Start query for products
        $query = Product::query();

        // Apply search filter if user typed something
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply category filter if user selected one
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Get filtered products
        $products = $query->get();

        // Get all categories for dropdown
        $categories = Category::all();

        return view('user.dashboard', compact('products', 'categories'));
    }
}
