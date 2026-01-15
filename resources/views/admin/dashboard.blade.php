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
    <div class="row g-4">

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
                View Products →
            </a>
        </div>
            </div>
        </div>

        <!-- Out of Stock -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-danger h-100 shadow-sm">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <i class="fas fa-archive fa-2x"></i>
                        <div class="fw-semibold">Out of Stock</div>
                    </div>

                    @if(($outOfStockCount ?? 0) == 0)
                        <small class="text-white-50">All products in stock</small>
                    @else
                        <span class="badge bg-warning text-dark">
                            {{ $outOfStockCount }} product(s)
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
                        <small class="text-white-50">Total orders</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
            <a class="small text-white stretched-link" href="{{ url('admin/orders') }}">
                View Orders →
            </a>
        </div>
            </div>
        </div>

        <!-- ✅ TOTAL SALES -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-dark h-100 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <i class="fas fa-peso-sign fa-2x"></i>
                    <div>
                        <div class="fw-semibold">Total Sales</div>
                        <div class="fs-2 fw-bold">
                            ₱{{ number_format($totalSales ?? 0, 2) }}
                        </div>
                        <small class="text-white-50">All completed orders</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts -->
    <div class="row mt-4">

        <!-- Overview Chart -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header fw-semibold">Dashboard Overview</div>
                <div class="card-body">
                    <canvas id="overviewChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <!-- Total Sales Chart -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header fw-semibold">Total Sales</div>
                <div class="card-body">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Overview Chart
    new Chart(document.getElementById('overviewChart'), {
        type: 'bar',
        data: {
            labels: ['Products', 'Active', 'Inactive', 'Stocks', 'Orders'],
            datasets: [{
                label: 'Overview',
                data: [
                    {{ $total ?? 0 }},
                    {{ $active ?? 0 }},
                    {{ $inactive ?? 0 }},
                    {{ $stocks ?? 0 }},
                    {{ $ordersCount ?? 0 }}
                ],
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#dc3545',
                    '#ffc107',
                    '#0dcaf0'
                ],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Total Sales Chart
    new Chart(document.getElementById('salesChart'), {
        type: 'doughnut',
        data: {
            labels: ['Total Sales'],
            datasets: [{
                data: [{{ $totalSales ?? 0 }}],
                backgroundColor: ['#198754']
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            }
        }
    });

});
</script>
@endsection
