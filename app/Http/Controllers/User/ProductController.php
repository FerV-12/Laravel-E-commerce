<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Product\CreateProductFormRequest;
use App\Http\Requests\Product\UpdateProductFormRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the products with optional search and category filter
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search by product name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Get filtered products
        $products = $query->get();

        // Get all categories for the filter dropdown
        $categories = Category::all();

        // Return view (adjust path based on your dashboard view)
        return view('user.dashboard', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created product in storage
     */
    public function store(CreateProductFormRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();
            $filename = time() . '.' . $imgExt;
            $path = 'uploads/products/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        Product::create($data);

        return redirect()->route('user.products.index')->with('status', 'Product Created Successfully');
    }

    /**
     * Display the specified product
     */
    public function show(Product $product)
    {
        return view('user.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('user.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified product in storage
     */
    public function update(UpdateProductFormRequest $request, Product $product)
    {
        $data = $request->validated();

        // Handle image update
        if ($request->hasFile('image')) {
            if (File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();
            $filename = time() . '.' . $imgExt;
            $path = 'uploads/products/';
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        $product->update($data);

        return redirect()->route('user.products.index')->with('status', 'Product Updated Successfully');
    }

    /**
     * Remove the specified product from storage
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('user.products.index')->with('status', 'Product Deleted Successfully');
    }
}
