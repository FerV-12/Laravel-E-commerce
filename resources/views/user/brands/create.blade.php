@extends('layouts.user')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Add Brand
                    <a href= "{{url('/user/brands') }}" class="btn btn-danger float-end">Back</a>
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

                <form action="{{url('user/brands')}}" method="POST" enctype="multipart/form-data" >
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="">Brand Name</label>
                            <input type="text" name="name" class="form-control"/> 
                        </div>
                        
                          <div class="col-md-6 mb-4">
                            <label for="">Is Active</label>
                            </br>
                            <input type="checkbox" name="is_active" style="width: 30px; height:30px" checked/>check if you want to show as Popular
                        </div>
                        <div class="col-md-6 mb-4">  
                            <label for="">Upload Image</label>
                            <input type="file" name="image" class="form-control"/>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                </form>

            </div>
    </div>

@endsection
