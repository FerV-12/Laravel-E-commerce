@extends('layouts.admin')

@section('content')

        <div class="card">
           <div class="card-header">
                <h4 class="mb-0 fw-semibold">
                    Product Brands
                    <a href= "{{url('/admin/brands/create')}}" class="btn btn-primary float-end">Add Brands</a>
                    </h4>
           </div>
            <div class="card-body">

                @session('status')
                    <div class="alert-success">{{session('status')}}</div>
                @endsession    

                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Status</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td class="text-nowrap">{{$item->name}}</td>
                            <td class="text-center">
                                @if($item->image)
                                    <img src="{{ asset($item->image)}}" style="width: 50px; height: 50px" alt="Img">
                                @else
                                No img
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->is_active == 1)
                                    <span class="badge bg-success">Show</span>
                                @else
                                    <span class="badge bg-danger">Hide</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ url('admin/brands/'.$item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('admin/brands/'.$item->id.'/edit') }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ url('admin/brands/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                         @endforeach 
                    </tbody>

                </table>
                </div>
            </div>
    </div>

@endsection
