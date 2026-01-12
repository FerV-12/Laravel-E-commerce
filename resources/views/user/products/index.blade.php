@extends('layouts.user')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            📦 Products
        </h3>
        <span class="text-muted small">
            Manage store products
        </span>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-semibold">Products List</h5>
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
                            <th>Product</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $item)
                        <tr>
                            <td class="fw-semibold text-muted">
                                #{{ $item->id }}
                            </td>

                            <td>
                                <div class="fw-semibold mb-1">
                                    {{ $item->name }}
                                </div>

                                @if($item->category_id)
                                    <div class="small text-muted">
                                        <strong>Category:</strong> {{ $item->category?->name }}
                                    </div>
                                @endif

                                @if($item->brand_id)
                                    <div class="small text-muted">
                                        <strong>Brand:</strong> {{ $item->brand?->name }}
                                    </div>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($item->image)
                                    <img
                                        src="{{ asset($item->image) }}"
                                        alt="Product Image"
                                        class="rounded shadow-sm"
                                        style="width:60px;height:60px;object-fit:cover;"
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
                                <h6 class="text-muted mb-1">No products found</h6>
                                <p class="small text-muted mb-0">
                                    Start adding products to your store
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
