@extends('layouts.user')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Edit Product
                    <a href= "{{url('/user/products') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
            </div>
            <div class="card-body">


            @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form action="{{url('user/products/'.$product->id)}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Product Name</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control"/> 
                        </div>
                        <div class="col-md-6">
                            <label>Select Category</label>
                            <select name="category_id" class="form-select">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $cate)
                                 <option
                                  value="{{$cate->id}}"
                                  {{ $cate->id == $product->category_id ? 'selected' : '' }}
                                  >
                                  {{ $cate->name }}
                                  </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                             <label>Select Brand</label>
                            <select name="brand_id" class="form-select">
                                <option value="">--Select Brand--</option>
                                @foreach ($brands as $brand)
                                 <option
                                 value="{{$brand->id}}"
                                {{$brand->id == $product->brand_id ? 'selected' : '' }}
                                 >
                                 {{ $brand->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Small Description</label>
                            <textarea name="small_description" class="form-control" rows="3">{!!$product->small_description!!}</textarea> 
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3">{!!$product->description!!}</textarea> 
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Original Price</label>
                            <input type="number" name="original_price" value="{{$product->original_price}}" class="form-control"/>
                        </div>
                         <div class="col-md-4 mb-3">
                            <label>Selling Price</label>
                            <input type="number" name="selling_price" value="{{$product->selling_price}}" class="form-control"/>
                        </div>
                         <div class="col-md-4">
                            <label>Quantity</label>
                            <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control"/>
                        </div>
                        <div class="col-md-12">  
                            <label for="">Upload Image</label>
                            <input type="file" name="image" class="form-control"/>
                             @if($product->image)
                                <img src="{{ asset($product->image ) }}" style="width: 100px; height: 100px" alt="Img"/>
                            @else
                                No Image Uploaded    
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="">Is Trending</label>
                            </br>
                            <label>
                                <input type="checkbox" name="is_trending" {{ $product ->is_trending == true ? 'checked' : '' }} style="width: 30px; height: 30px"/>
                                Check if you want it to be Trending
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label for="">Is Active</label>
                            </br>
                            <label>
                                <input type="checkbox" name="is_active" {{ $product ->is_active == true ? 'checked' : '' }} style="width: 30px; height: 30px"/>
                                check if you want it to show
                            </label>
                        </div>
                          
                
                        <div class="col-md-12 mt-4">
                            <h4>SEO Details</h4>
                        </div>
                        <div class="col-md-12 mt-4">
                            <label for="">Meta Title</label>
                            <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label for="">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{!! $product->meta_description !!}</textarea> 
                        </div>
                        <div class="col-md-6">
                            <label for="">Meta Keyword</label>
                            <textarea name="meta_keywords" class="form-control" rows="3">{!! $product->meta_keywords !!}</textarea> 
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </div>
                </form>

            </div>
    </div>

@endsection
