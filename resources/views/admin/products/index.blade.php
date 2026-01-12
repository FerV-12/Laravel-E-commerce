@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="mb-0 fw-semibold">
            Products
            <a href="{{ url('/admin/products/create') }}" class="btn btn-primary float-end">
                Add Product
            </a>
        </h4>
    </div>

    <div class="card-body">

        {{-- STATUS MESSAGE --}}
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th width="60">ID</th>
                        <th>Product Info</th>
                        <th class="text-center" width="120">Image</th>
                        <th class="text-center" width="120">Quantity</th>
                        <th class="text-center" width="120">Status</th>
                        <th width="160">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            {{-- ID --}}
                            <td>{{ $item->id }}</td>

                            {{-- PRODUCT DETAILS --}}
                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>

                                <div class="small text-muted">
                                    @if($item->category_id)
                                        <b>Category:</b> {{ $item->category?->name }}
                                    @endif

                                    @if($item->brand_id)
                                        | <b>Brand:</b> {{ $item->brand?->name }}
                                    @endif
                                </div>
                            </td>

                            {{-- IMAGE --}}
                            <td class="text-center">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}"
                                         style="width:50px;height:50px;object-fit:cover;"
                                         class="rounded"
                                         alt="Product">
                                @else
                                    <span class="text-muted small">No Image</span>
                                @endif
                            </td>

                            {{-- QUANTITY --}}
                            <td class="text-center">
                                <a href="{{ url('admin/products/'.$item->id.'/edit') }}" class="text-decoration-none">
                                    {{ $item->quantity ?? 0 }}
                                </a>
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if($item->is_active)
                                    <span class="badge bg-success">Show</span>
                                @else
                                    <span class="badge bg-danger">Hide</span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ url('admin/products/'.$item->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ url('admin/products/'.$item->id.'/edit') }}"
                                       class="btn btn-sm btn-success">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="{{ url('admin/products/'.$item->id.'/images') }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fa fa-image"></i>
                                    </a>

                                    <a href="{{ url('admin/products/'.$item->id.'/delete') }}"
                                       onclick="return confirm('Are you sure?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
