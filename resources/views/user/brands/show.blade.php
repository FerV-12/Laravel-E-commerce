@extends('layouts.user')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Show Brand
                    <a href= "{{url('/user/brands') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
            </div>
            <div class="card-body">

            <h4>Brand Name:{{$brand->name}}</h4>
            <h4>brand Popular:{{$brand->is_active == 1? 'Yes' : 'No'}}</h4>

        </div>
    </div>

@endsection
