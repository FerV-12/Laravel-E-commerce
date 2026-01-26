@extends('layouts.admin')

@section('content')

<style>
    /* ================= PRODUCTS LIST STYLES ================= */
    .products-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .products-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .products-header h4 {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .add-product-btn {
        background: white;
        color: #667eea;
        border: none;
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .add-product-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        color: #667eea;
    }

    /* Success Alert */
    .status-alert {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        border-radius: 16px;
        color: white;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 8px 25px rgba(17, 153, 142, 0.3);
        margin-bottom: 1.5rem;
        animation: slideInDown 0.5s ease;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .status-alert i {
        margin-right: 0.5rem;
    }

    /* Table Container */
    .products-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
    }

    /* Table Styles */
    .products-table {
        margin: 0;
    }

    .products-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .products-table thead th {
        border: none;
        color: #2d3748;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.25rem 1rem;
        border-bottom: 3px solid #667eea;
    }

    .products-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e9ecef;
    }

    .products-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%);
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(102,126,234,0.1);
    }

    .products-table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border: none;
    }

    /* Product Info */
    .product-name {
        font-size: 1.05rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.3rem;
    }

    .product-meta {
        font-size: 0.85rem;
        color: #718096;
    }

    .product-meta b {
        color: #4a5568;
    }

    /* Product Image */
    .product-image {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #e9ecef;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .product-image:hover {
        transform: scale(1.15);
        border-color: #667eea;
        box-shadow: 0 8px 20px rgba(102,126,234,0.3);
    }

    .no-image-text {
        color: #a0aec0;
        font-size: 0.85rem;
        font-style: italic;
    }

    /* Quantity Badge */
    .quantity-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 800;
        font-size: 1.1rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        min-width: 60px;
        box-shadow: 0 4px 12px rgba(102,126,234,0.3);
        transition: all 0.3s ease;
    }

    .quantity-badge:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 18px rgba(102,126,234,0.4);
        text-decoration: none;
        color: white;
    }

    .quantity-badge.low-stock {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .quantity-badge.out-of-stock {
        background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
    }

    /* Status Badges */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: inline-block;
    }

    .status-badge.active {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .status-badge.inactive {
        background: linear-gradient(135deg, #a0aec0 0%, #cbd5e0 100%);
        color: #2d3748;
    }

    /* Action Buttons */
    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .action-btn:hover {
        transform: translateY(-3px);
    }

    .action-btn.view {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .action-btn.view:hover {
        box-shadow: 0 6px 18px rgba(102,126,234,0.4);
    }

    .action-btn.edit {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .action-btn.edit:hover {
        box-shadow: 0 6px 18px rgba(17,153,142,0.4);
    }

    .action-btn.images {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .action-btn.images:hover {
        box-shadow: 0 6px 18px rgba(79,172,254,0.4);
    }

    .action-btn.delete {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .action-btn.delete:hover {
        box-shadow: 0 6px 18px rgba(245,87,108,0.4);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #718096;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1.5rem;
    }

    .empty-state h5 {
        color: #4a5568;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #a0aec0;
    }

    /* ID Badge */
    .id-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #4a5568;
        font-weight: 800;
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 10px;
        min-width: 50px;
        border: 2px solid #dee2e6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .products-header h4 {
            font-size: 1.5rem;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            font-size: 0.85rem;
        }
    }
</style>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="products-header d-flex justify-content-between align-items-center">
        <h4>
            <i class="fas fa-box-open me-3"></i>Products Management
        </h4>
        <a href="{{ url('/admin/products/create') }}" class="add-product-btn">
            <i class="fas fa-plus me-2"></i>Add Product
        </a>
    </div>

    <!-- Status Message -->
    @if(session('status'))
        <div class="status-alert">
            <i class="fas fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    <!-- Products Card -->
    <div class="products-card">
        <div class="table-responsive">
            <table class="table products-table">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Product Info</th>
                        <th class="text-center" width="120">Image</th>
                        <th class="text-center" width="120">Stock</th>
                        <th class="text-center" width="120">Status</th>
                        <th class="text-center" width="200">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            <!-- ID -->
                            <td>
                                <div class="id-badge">
                                    #{{ $item->id }}
                                </div>
                            </td>

                            <!-- Product Details -->
                            <td>
                                <div class="product-name">
                                    {{ $item->name }}
                                </div>
                                <div class="product-meta">
                                    @if($item->category_id)
                                        <b>Category:</b> {{ $item->category?->name }}
                                    @endif

                                    @if($item->brand_id)
                                        | <b>Brand:</b> {{ $item->brand?->name }}
                                    @endif
                                </div>
                            </td>

                            <!-- Image -->
                            <td class="text-center">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}"
                                         class="product-image"
                                         alt="{{ $item->name }}">
                                @else
                                    <div class="no-image-text">
                                        <i class="fas fa-image"></i><br>
                                        No Image
                                    </div>
                                @endif
                            </td>

                            <!-- Quantity -->
                            <td class="text-center">
                                <a href="{{ url('admin/products/'.$item->id.'/edit') }}"
                                   class="quantity-badge {{ $item->quantity == 0 ? 'out-of-stock' : ($item->quantity <= 10 ? 'low-stock' : '') }}">
                                    {{ $item->quantity ?? 0 }}
                                </a>
                            </td>

                            <!-- Status -->
                            <td class="text-center">
                                @if($item->is_active)
                                    <span class="status-badge active">
                                        <i class="fas fa-check-circle me-1"></i>Active
                                    </span>
                                @else
                                    <span class="status-badge inactive">
                                        <i class="fas fa-eye-slash me-1"></i>Hidden
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ url('admin/products/'.$item->id) }}"
                                       class="action-btn view"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ url('admin/products/'.$item->id.'/edit') }}"
                                       class="action-btn edit"
                                       title="Edit Product">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ url('admin/products/'.$item->id.'/images') }}"
                                       class="action-btn images"
                                       title="Manage Images">
                                        <i class="fas fa-images"></i>
                                    </a>

                                    <a href="{{ url('admin/products/'.$item->id.'/delete') }}"
                                       onclick="return confirm('Are you sure you want to delete this product?')"
                                       class="action-btn delete"
                                       title="Delete Product">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-box-open"></i>
                                    <h5>No Products Found</h5>
                                    <p class="mb-3">Start by adding your first product</p>
                                    <a href="{{ url('/admin/products/create') }}" 
                                       class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add Your First Product
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection