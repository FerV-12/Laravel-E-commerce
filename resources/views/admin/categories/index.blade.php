@extends('layouts.admin')

@section('content')

        <div class="card">
           <div class="card-header ">
                <h4 class="mb-0 fw-semibold">
                    Product Categories 
                    <a href= "{{url('/admin/categories/create')}}" class="btn btn-primary float-end">Add Product Category</a>
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
                            <th>Status</th>
                            <th>Popular</th>
                            <th width="160">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td class="text-nowrap">{{$item->name}}</td>
                            <td>
                                @if($item->status == 0)
                                    <span class="badge bg-success">Show</span>
                                @else
                                    <span class="badge bg-danger">Hide</span>
                                @endif
                            </td>
                            <td>
                                @if($item->popular == 1)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ url('admin/categories/'.$item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ url('admin/categories/'.$item->id.'/edit') }}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ url('admin/categories/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
