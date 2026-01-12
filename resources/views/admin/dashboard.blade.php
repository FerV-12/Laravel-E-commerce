@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
        <p class="text-muted mb-0">
            Welcome, {{ auth()->user()->name ?? 'Admin' }}!
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4"> {{-- g-4 = equal spacing between cards --}}

        <!-- Products -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-primary h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-box-open fa-2x"></i>

                    <div>
                        <div class="fw-semibold">Products</div>
                        <div class="fs-2 fw-bold">{{ number_format($total ?? 0) }}</div>
                        <small class="text-white-50">Total products</small>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 text-end">
                    <a class="small text-white stretched-link" href="{{ url('admin/products') }}">
                        View Products →
                    </a>
                </div>
            </div>
        </div>

        <!-- Inventory -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-success h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-check-circle fa-2x"></i>

                    <div>
                        <div class="fw-semibold">Total Inventory</div>
                        <div class="fs-2 fw-bold">{{ number_format($stocks ?? 0) }}</div>
                        <small class="text-white-50">Total items</small>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 text-end">
                    <a class="small text-white stretched-link" href="{{ url('admin/products') }}">
                        View Inventory →
                    </a>
                </div>
            </div>
        </div>

        <!-- Stocks -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-danger h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center">

                    <div class="d-flex align-items-center gap-3 mb-2">
                        <i class="fas fa-archive fa-2x"></i>
                        <div class="fw-semibold">Stocks</div>
                    </div>

                    @if(empty($outOfStockCount) || $outOfStockCount == 0)
                        <small class="text-white-50">
                            All products have sufficient stock
                        </small>
                    @else
                        <span class="badge bg-warning text-dark mt-1 align-self-start">
                            {{ $outOfStockCount }} product{{ $outOfStockCount > 1 ? 's' : '' }} out of stock
                        </span>
                    @endif
                </div>

                <div class="card-footer bg-transparent border-0 text-end">
                    <a class="small text-white stretched-link" href="{{ url('admin/products') }}">
                        Check Stocks →
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-info h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-shopping-cart fa-2x"></i>

                    <div>
                        <div class="fw-semibold">Orders</div>
                        <div class="fs-2 fw-bold">{{ number_format($ordersCount ?? 0) }}</div>
                        <small class="text-white-50">Recent orders</small>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 text-end">
                    <a class="small text-white stretched-link" href="{{ url('admin/orders') }}">
                        View Orders →
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
