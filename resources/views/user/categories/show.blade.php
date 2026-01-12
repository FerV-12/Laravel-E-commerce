@extends('layouts.user')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Show Category
                    <a href= "{{url('/user/categories') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
            </div>
            <div class="card-body">

            <h4>Category Name:{{$category->name}}</h4>
            <h4>Category Description:{{$category->description}}</h4>
            <h4>Category Status:{{$category->status == 0 ? 'Show' : 'Hide'}}</h4>
            <h4>Category Popular:{{$category->popular == 1? 'Yes' : 'No'}}</h4>

        </div>
    </div>

@endsection
