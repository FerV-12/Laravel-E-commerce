<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Str; 
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('user.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('user.categories.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();

        // ensure meta fields exist to satisfy non-null DB columns
        $data['meta_title'] = $data['meta_title'] ?? '';
        $data['meta_description'] = $data['meta_description'] ?? '';
        $data['meta_keywords'] = $data['meta_keywords'] ?? '';

        if($request->hasFile('image')){
            $file = $request->file('image');
            if ($file && $file->isValid()) {
                $imgExt = $file->getClientOriginalExtension();
                $filename = time().'.'.$imgExt;
                $relativePath = 'uploads/category/';
                $targetPath = public_path($relativePath);
                if (!File::exists($targetPath)) {
                    File::makeDirectory($targetPath, 0755, true);
                }
                $file->move($targetPath, $filename);
                $data['image'] = $relativePath.$filename;
            }
        }

        Category::create($data);

        return redirect('/user/categories')->with('status', 'Category Added Successfully');
    }

     public function show(Category $category)
    {
        return view('user.categories.show', compact('category'));
    }

      public function edit(Category $category)
    {
        return view('user.categories.edit', compact('category'));
    }

      public function update(CategoryFormRequest $request, Category $category)
    {
        $data = $request->validated();

        // ensure meta fields exist to satisfy non-null DB columns
        $data['meta_title'] = $data['meta_title'] ?? $category->meta_title ?? '';
        $data['meta_description'] = $data['meta_description'] ?? $category->meta_description ?? '';
        $data['meta_keywords'] = $data['meta_keywords'] ?? $category->meta_keywords ?? '';

        if($request->hasFile('image')){

            if(File::exists($category->image)){
                File::delete($category->image);
            }

            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();

            $filename = time().'.'.$imgExt;
            $path = 'uploads/category/';
            $file->move($path, $filename);

            $data['image'] = $path.$filename;
        }

       $category->update($data);

        return redirect('/user/categories')->with('status', 'Category Updated Successfully');
    }

    public function destroy($id)
    {
        $category = Category::findorFail($id);

         if(File::exists($category->image)){
            File::delete($category->image);
        }

        $category->delete();

        return redirect('/user/categories')->with('status', 'Category Deleted Successfully');
    }
}