<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandFormRequest;
use Illuminate\Support\Facades\File;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandFormRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('image')){

            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();

            $filename = time().'.'.$imgExt;
            $path = 'uploads/brands/';
            $file->move($path, $filename);

            $data['image'] = $path.$filename;
        }

        Brand::create($data);

        return redirect('/admin/brands')->with('status', 'Brand Created Successfully');
    }

     public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

      public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

      public function update(BrandFormRequest $request, Brand $brand)
    {
        $data = $request->validated();

        if($request->hasFile('image')){

            if(File::exists($brand->image)){
                File::delete($brand->image);
            }

            $file = $request->file('image');
            $imgExt = $file->getClientOriginalExtension();

            $filename = time().'.'.$imgExt;
            $path = 'uploads/brands/';
            $file->move($path, $filename);

            $data['image'] = $path.$filename;
        }

       $brand->update($data);

        return redirect('/admin/brands')->with('status', 'Brand Updated Successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::findorFail($id);

         
         if(File::exists($brand->image)){
                File::delete($brand->image);
            }
        $brand->delete();

        return redirect('/admin/brands')->with('status', 'Brand Deleted Successfully');
    }
}
