@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">
                Upload Images for "{{$product -> name}}"
                <a href= "{{url('/admin/products') }}" class="btn btn-danger float-end">Back</a>
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

            <form action="{{url('admin/products/'.$product->id.'/images')}}" method="POST" enctype="multipart/form-data" >
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Upload Multiple Images (Max: 20 files)</label>
                        <input type="file" name="images[]" multiple  class="form-control"/> 
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
