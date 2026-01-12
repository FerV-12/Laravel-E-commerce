@extends('layouts.user')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Add Category
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

                <form action="{{url('user/categories')}}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control"/> 
                        </div>
                        <div class="col-md-12">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea> 
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <select name="status" class="form-select">
                                <option value="">--Select Status--</option>
                                <option value="0">Show</option>
                                <option value="1">Hide</option>
                            </select>
                        </div>
                          <div class="col-md-6">
                            <label for="">Popular</label>
                            <input type="checkbox" name="popular" value="1"/>check if you want to show as Popular
                        </div>
                        <div class="col-md-12">  
                            <label for="">Upload Image</label>
                            <input type="file" name="image" class="form-control"/>
                        </div>
                        <!-- SEO fields removed per user request -->
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>

            </div>
    </div>

@endsection
