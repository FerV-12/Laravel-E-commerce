@extends('layouts.user')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Edit Category
                    <a href= "{{url('/user/categories') }}" class="btn btn-danger float-end">Back</a>
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

                <form action="{{url('user/categories/'.$category->id)}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Category Name</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control"/> 
                        </div>
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3">{!!$category->description !!}</textarea> 
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <select name="status" class="form-select">
                                <option value="">--Select Status--</option>
                                <option value="0" {{$category->status == 0 ? 'selected' : ''}}>Show</option>
                                <option value="1" {{$category->status == 1 ? 'selected' : ''}}>Hide</option>
                            </select>
                        </div>
                          <div class="col-md-6">
                            <label for="">Popular</label>
                            <input type="checkbox" name="popular" {{ $category->popular == 1 ? 'checked' : ''}}/>check if you want to show as Popular
                        </div>
                        <div class="col-md-12">  
                            <label for="">Upload Image</label>
                            <input type="file" name="image" class="form-control"/>
                            @if($category->image)
                                <img src="{{ asset(" $category->image ") }}" style="width: 100px; height: 100px" alt="Img"/>
                            @else
                                No Image Uploaded    
                            @endif
                        </div>
                        <div class="col-md-12 mt-4">
                            <h4>SEO Details</h4>
                        </div>
                        <div class="col-md-12">
                            <label for="">Meta Title</label>
                            <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label for="">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{!! $category->meta_description !!}</textarea> 
                        </div>
                        <div class="col-md-6">
                            <label for="">Meta Keyword</label>
                            <textarea name="meta_keywords" class="form-control" rows="3">{!! $category->meta_keywords !!}</textarea> 
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </div>
                </form>

            </div>
    </div>

@endsection
