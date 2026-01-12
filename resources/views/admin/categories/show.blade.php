@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="mb-0">
            Show Category
            <a href="{{ url('/admin/categories') }}" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>

    <div class="card-body">
        <h5>Category Name: <b>{{ $category->name }}</b></h5>
        <h5>Description: <b>{{ $category->description }}</b></h5>
        <h5>Status: <b>{{ $category->status == 0 ? 'Show' : 'Hide' }}</b></h5>
        <h5>Popular: <b>{{ $category->popular == 1 ? 'Yes' : 'No' }}</b></h5>
    </div>
</div>

@endsection
