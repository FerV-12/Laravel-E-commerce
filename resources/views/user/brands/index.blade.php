@extends('layouts.user')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            🏷️ Brands
        </h3>
        <span class="text-muted small">
            Manage product brands
        </span>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold">Brands Overview</h5>
        </div>

        <div class="card-body">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th>Brand Name</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($brands as $item)
                        <tr>
                            <td class="fw-semibold text-muted">#{{ $item->id }}</td>

                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>
                                <small class="text-muted">Product brand</small>
                            </td>

                            <td class="text-center">
                                @if($item->image)
                                    <img 
                                        src="{{ asset($item->image) }}" 
                                        alt="Brand Image"
                                        class="rounded shadow-sm"
                                        style="width:50px;height:50px;object-fit:cover;"
                                    >
                                @else
                                    <span class="text-muted small">No image</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($item->is_active == 1)
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        👁 Active
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                        🚫 Hidden
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <h6 class="text-muted mb-1">No brands available</h6>
                                <p class="small text-muted mb-0">
                                    Add brands to organize your products
                                </p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
