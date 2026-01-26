@extends('layouts.admin')

@section('content')

<style>
    /* ================= MODERN DASHBOARD STYLES ================= */
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --danger-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    }

    .dashboard-header {
        background: var(--primary-gradient);
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .dashboard-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .dashboard-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    /* ================= STAT CARDS ================= */
    .stat-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card.primary-card {
        background: var(--primary-gradient);
    }

    .stat-card.success-card {
        background: var(--success-gradient);
    }

    .stat-card.danger-card {
        background: var(--danger-gradient);
    }

    .stat-card.info-card {
        background: var(--info-gradient);
    }

    .stat-card.dark-card {
        background: var(--dark-gradient);
    }

    .stat-card.warning-card {
        background: var(--warning-gradient);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.2);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .stat-icon i {
        font-size: 2rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin: 0.5rem 0;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .stat-label {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.3rem;
        opacity: 0.95;
    }

    .stat-description {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .stat-card .card-footer {
        background: rgba(0,0,0,0.1);
        border: none;
        backdrop-filter: blur(10px);
        padding: 1rem 1.5rem;
    }

    .stat-card .card-footer a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stat-card .card-footer a:hover {
        gap: 1rem;
        text-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .warning-badge {
        background: rgba(0,0,0,0.2);
        border-radius: 12px;
        padding: 0.5rem 1rem;
        display: inline-block;
        font-weight: 700;
        backdrop-filter: blur(10px);
    }

    /* ================= CHART CARDS ================= */
    .chart-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: all 0.4s ease;
    }

    .chart-card:hover {
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }

    .chart-card .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: none;
        padding: 1.5rem;
        font-weight: 700;
        font-size: 1.2rem;
        color: #2d3748;
    }

    .chart-card .card-body {
        padding: 2rem;
    }

    /* ================= ANIMATIONS ================= */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }
    .stat-card:nth-child(6) { animation-delay: 0.6s; }

    /* ================= RESPONSIVE ================= */
    @media (max-width: 768px) {
        .dashboard-header h2 {
            font-size: 2rem;
        }

        .stat-number {
            font-size: 2rem;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
        }

        .stat-icon i {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="dashboard-header">
        <h2>
            <i class="fas fa-chart-line me-3"></i>Admin Dashboard
        </h2>
        <p class="mb-0">
            Welcome back, {{ auth()->user()->name ?? 'Admin' }}! Here's what's happening with your store today.
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">

        <!-- Products -->
        <div class="col-xl-4 col-lg-6">
            <div class="card stat-card primary-card text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Products</div>
                            <div class="stat-number">{{ number_format($total ?? 0) }}</div>
                            <div class="stat-description">Items in your catalog</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('admin/products') }}">
                        View All Products
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Inventory -->
        <div class="col-xl-4 col-lg-6">
            <div class="card stat-card success-card text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Inventory</div>
                            <div class="stat-number">{{ number_format($stocks ?? 0) }}</div>
                            <div class="stat-description">Items in stock</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('admin/products') }}">
                        Manage Inventory
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Out of Stock -->
        <div class="col-xl-4 col-lg-6">
            <div class="card stat-card danger-card text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-label">Out of Stock</div>
                            @if(($outOfStockCount ?? 0) == 0)
                                <div class="stat-number">0</div>
                                <div class="stat-description">All products available!</div>
                            @else
                                <div class="stat-number">{{ $outOfStockCount }}</div>
                                <div class="warning-badge">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    Needs attention
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('admin/products') }}">
                        Check Stock Levels
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-xl-4 col-lg-6">
            <div class="card stat-card info-card text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Orders</div>
                            <div class="stat-number">{{ number_format($ordersCount ?? 0) }}</div>
                            <div class="stat-description">All time orders</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('admin/orders') }}">
                        View All Orders
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Sales -->
        <div class="col-xl-4 col-lg-6">
            <div class="card stat-card dark-card text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon">
                            <i class="fas fa-peso-sign"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Revenue</div>
                            <div class="stat-number">₱{{ number_format($totalSales ?? 0, 2) }}</div>
                            <div class="stat-description">From completed orders</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('admin/orders') }}">
                        View Sales Report
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Pre-Orders -->
        <div class="col-xl-4 col-lg-6">
            <div class="card stat-card warning-card text-white h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-label">Pre-Orders</div>
                            <div class="stat-number">
                                {{ number_format(\App\Models\Preorder::count() ?? 0) }}
                            </div>
                            <div class="stat-description">Pending pre-orders</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.preorders.index') }}" class="text-dark fw-bold">
                        Manage Pre-Orders
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts -->
    <div class="row g-4">

        <!-- Overview Chart -->
        <div class="col-lg-8">
            <div class="card chart-card">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-2"></i>
                    Dashboard Overview
                </div>
                <div class="card-body">
                    <canvas id="overviewChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Sales Chart -->
        <div class="col-lg-4">
            <div class="card chart-card">
                <div class="card-header">
                    <i class="fas fa-dollar-sign me-2"></i>
                    Revenue Summary
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="salesChart"></canvas>
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

    // Overview Chart with Modern Styling
    new Chart(document.getElementById('overviewChart'), {
        type: 'bar',
        data: {
            labels: ['Products', 'Active', 'Inactive', 'Stock', 'Orders'],
            datasets: [{
                label: 'Count',
                data: [
                    {{ $total ?? 0 }},
                    {{ $active ?? 0 }},
                    {{ $inactive ?? 0 }},
                    {{ $stocks ?? 0 }},
                    {{ $ordersCount ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(17, 153, 142, 0.8)',
                    'rgba(245, 87, 108, 0.8)',
                    'rgba(254, 225, 64, 0.8)',
                    'rgba(79, 172, 254, 0.8)'
                ],
                borderColor: [
                    'rgba(102, 126, 234, 1)',
                    'rgba(17, 153, 142, 1)',
                    'rgba(245, 87, 108, 1)',
                    'rgba(254, 225, 64, 1)',
                    'rgba(79, 172, 254, 1)'
                ],
                borderWidth: 2,
                borderRadius: 12,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                }
            }
        }
    });

    // Sales Doughnut Chart with Gradient
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const gradient = salesCtx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(17, 153, 142, 1)');
    gradient.addColorStop(1, 'rgba(56, 239, 125, 1)');

    new Chart(salesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Total Sales', 'Remaining Goal'],
            datasets: [{
                data: [
                    {{ $totalSales ?? 0 }},
                    Math.max(0, 100000 - {{ $totalSales ?? 0 }})
                ],
                backgroundColor: [
                    gradient,
                    'rgba(233, 236, 239, 0.5)'
                ],
                borderWidth: 0,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 13,
                            weight: '600'
                        },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ₱' + context.parsed.toLocaleString('en-PH', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    }
                }
            }
        }
    });

});
</script>
@endsection