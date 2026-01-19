@extends('layouts.user')

@section('content')

<style>
    /* ================= HERO BANNER ================= */
    .hero-banner {
        position: relative;
        min-height: 360px;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            rgba(0,0,0,0.75),
            rgba(25,135,84,0.65),
            rgba(0,0,0,0.3)
        );
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
        animation: fadeUp 1.2s ease;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.12), transparent 40%);
        animation: glowMove 20s linear infinite;
        z-index: 1;
    }

    @keyframes glowMove {
        from { transform: translateX(-10%); }
        to { transform: translateX(10%); }
    }
</style>

<div class="container py-4">

    <!-- ================= HERO ================= -->
    <div class="hero-banner rounded mb-5 shadow">
        <div class="hero-overlay"></div>
        <div class="hero-content p-5 text-white">
            <h1 class="fw-bold mb-3">
                Welcome back, {{ auth()->user()->name ?? 'User' }} 👋
            </h1>
            <p class="mb-4 fs-5">
                Discover premium products crafted for quality and style.
            </p>
            <a href="#products" class="btn btn-light btn-lg fw-semibold px-4">
                Start Shopping
            </a>
        </div>
    </div>

    <!-- ================= FEATURES ================= -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <i class="fas fa-truck fa-2x text-success mb-3"></i>
                <h6 class="fw-bold">Fast Delivery</h6>
                <p class="text-muted small mb-0">Quick & reliable shipping nationwide</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <i class="fas fa-shield-alt fa-2x text-success mb-3"></i>
                <h6 class="fw-bold">Secure Payment</h6>
                <p class="text-muted small mb-0">100% safe transactions</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <i class="fas fa-star fa-2x text-success mb-3"></i>
                <h6 class="fw-bold">Premium Quality</h6>
                <p class="text-muted small mb-0">Trusted & verified products</p>
            </div>
        </div>
    </div>

    <!-- ================= SEARCH ================= -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <form method="GET" action="{{ route('user.products.index') }}">
                <div class="row g-2">
                    <div class="col-md-7">
                        <input type="text" name="search" class="form-control"
                               placeholder="Search premium products..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= PRODUCTS ================= -->
    <h3 id="products" class="mb-4 fw-bold">🛍️ Featured Products</h3>

    @if($products->count())
    <div class="row">

        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm position-relative">

                @php
                    $img = $product->image
                        ? (Illuminate\Support\Str::contains($product->image, '/')
                            ? asset($product->image)
                            : asset('uploads/products/' . $product->image))
                        : asset('assets/images/placeholder.png');
                @endphp

                <!-- Wishlist -->
                <div class="position-absolute top-0 end-0 p-2">
                    <button class="btn btn-sm btn-light shadow-sm wishlist-toggle"
                            data-product-id="{{ $product->id }}">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>

                <img src="{{ $img }}" class="card-img-top"
                     style="height:180px;object-fit:cover;">

                <div class="card-body d-flex flex-column">

                        @if($product->quantity <= 0)
                            <span class="badge bg-warning text-dark mb-2">
                            Out of Stock
                        </span>
                        @endif

                    <h6 class="fw-semibold mb-1">
                        {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                    </h6>

                    <div class="text-warning small mb-1">
                        ★★★★☆ <span class="text-muted">(4.0)</span>
                    </div>

                    <p class="text-muted small mb-1">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </p>

                    <p class="mb-3">
                        <strong class="fs-6 {{ $product->quantity <= 0 ? 'text-secondary' : 'text-success' }}">
                            &#8369;{{ number_format($product->selling_price, 2) }}
                        </strong>
                        @if($product->original_price)
                            <span class="text-muted small text-decoration-line-through ms-1">
                                &#8369;{{ number_format($product->original_price, 2) }}
                            </span>
                        @endif
                    </p>

                    <form class="mt-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @if($product->quantity <= 0)
                            <!-- PRE-ORDER -->
                            <button type="button"
                                    class="btn btn-outline-warning w-100 fw-semibold preorder-btn"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}">
                                <i class="fas fa-clock me-1"></i> Pre-order
                            </button>
                        @else
                            <!-- ADD TO CART -->
                            <button type="submit"
                                    formaction="{{ url('user/cart/add') }}"
                                    class="btn btn-success w-100 fw-semibold">
                                Add to Cart
                            </button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
        @endforeach

    </div>
    @else
        <div class="alert alert-info text-center">
            No products available right now.
        </div>
    @endif

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

        // Open preorder modal with selected product
        const preorderModalEl = document.createElement('div');

        document.querySelectorAll('.preorder-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                        const pid = this.getAttribute('data-product-id');
                        const pname = this.getAttribute('data-product-name') || '';

                        // Fill modal fields
                        document.getElementById('preorder_product_id').value = pid;
                        document.getElementById('preorder_product_name').textContent = pname;

                        // Show bootstrap modal
                        const modalEl = document.getElementById('preorderModal');
                        const bsModal = new bootstrap.Modal(modalEl);
                        bsModal.show();
                });
        });

});
</script>

<!-- Preorder Modal -->
<div class="modal fade" id="preorderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('user.preorders.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="preorderModalLabel">Pre-order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="preorder_product_id">

                    <div class="mb-3">
                        <label class="form-label">Product</label>
                        <div id="preorder_product_name" class="fw-semibold"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact phone (optional)</label>
                        <input type="text" name="contact_phone" class="form-control" placeholder="09xxxxxxxxx">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note (optional)</label>
                        <textarea name="note" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Pre-order</button>
                </div>
            </form>
        </div>
    </div>
</div>
