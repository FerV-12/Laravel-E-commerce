@extends('layouts.admin')

@section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    Products Images of "{{$product -> name}}"
                     <a href= "{{url('/user/products') }}" class="btn btn-danger float-end ms-2">Back</a>
                     <a href= "{{url('/user/products/'.$product->id.'/images/create')}}" class="btn btn-primary float-end">Upload Image</a>
                    
                    </h4>
            </div>
            <div class="card-body">>

                @session('status')
                    <div class="alert-success">{{session('status')}}</div>
                @endsession    

                <table class="table table-bordered table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productImages as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                @if($item->image)
                                <img src="{{ asset("$item->image") }}" style="width:50px;height 50px;" alt="Img "/>
                                @else
                                No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('user/products/'.$product ->id.'/images/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure?')" class="btn btn-success">Delete</a>
                            </td>
                        </tr>
                         @endforeach 
                    </tbody>

                </table>
            </div>
    </div>

@endsection
