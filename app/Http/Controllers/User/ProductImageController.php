<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    Public function index($productId)
    {
       $product= Product::findOrFail($productId);

       $productImages= ProductImage::where('product_id', $productId)->get();

       return view('user.products.images.index', compact('productImages', 'product'));
    }

    public function create($productId)
    {
        $product= Product::findOrFail($productId);

        return view('user.products.images.create',compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,webp',
        ]);

        $product= Product::findOrFail($productId);
        $imageData =[];
        if($files = $request->file('images'))
        {
           foreach($files as $key => $file){
                $ext = $file->getClientOriginalExtension();
                $filename = $key.'.'.time().'.'.$ext;

                $path = 'uploads/products-images/';

                $file->move($path, $filename);

                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path.$filename,
                ];
           }  
        }

        ProductImage::insert($imageData);
        
        return redirect('user/products/'.$productId.'/images')->with('status', 'Images uploaded');
    }

    public function destroy($productId, $imageId)
    {
        $product= Product::findOrFail($productId);
        $productImage = ProductImage::findOrFail($imageId);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        
        return redirect('user/products/'.$productId.'/images')->with('status', 'Images deleted');

    }
}
