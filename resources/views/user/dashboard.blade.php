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

        /* Image handling */
        /* background-image: url('{{ asset('assets/images/ecombanner.jpg') }}'); */
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }

    /* Dark overlay for readability */
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

    /* Content */
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
        animation: fadeUp 1.2s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Soft light movement (premium feel) */
    .hero-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.12), transparent 40%);
        animation: glowMove 20s linear infinite;
        z-index: 1;
    }

    @keyframes glowMove {
        from {
            transform: translateX(-10%);
        }
        to {
            transform: translateX(10%);
        }
    }
</style>


<div class="container py-4">

    <!-- ================= HERO SECTION ================= -->
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

    <!-- ================= SEARCH & FILTER ================= -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
           <form method="GET">
    <div class="row g-2">
        <div class="col-md-7">
            <input type="text" name="search"
                   class="form-control"
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
            <div class="card h-100 border-0 product-card position-relative shadow-sm">

                @php
                    $img = $product->image
                        ? (Illuminate\Support\Str::contains($product->image, '/')
                            ? asset($product->image)
                            : asset('uploads/products/' . $product->image))
                        : asset('assets/images/placeholder.png');
                @endphp

                @if($product->original_price && $product->original_price > $product->selling_price)
                    <!-- <div class="discount-badge">SALE</div> -->
                @endif

                <!-- Wishlist -->
                <div class="position-absolute top-0 end-0 p-2 wishlist-btn">
                    <button class="btn btn-sm btn-light shadow-sm wishlist-toggle" data-product-id="{{ $product->id }}">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>

                <img src="{{ $img }}" class="card-img-top"
                     style="height:180px;object-fit:cover;">

                <div class="card-body d-flex flex-column">

                    @if($product->quantity <= 0)
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            Sorry, this item is currently out of stock. We will notify you once it has been restocked.
                        </div>
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
                        <strong class="fs-6" @if($product->quantity <= 0) style="color:gray;" @else class="text-success" @endif>
                            &#8369;{{ number_format($product->selling_price, 2) }}
                        </strong>
                        @if($product->original_price)
                            <span class="text-muted small text-decoration-line-through ms-1">
                        
                                &#8369;{{ number_format($product->original_price, 2) }}
                            </span>
                        @endif
                    </p>

                    <form action="{{ url('user/cart/add') }}" method="POST" class="mt-auto">
                        @csrf
 

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if($product->quantity <= 0)
                            <button class="btn btn-outline-secondary w-100 fw-semibold" disabled>Out of Stock</button>
                        @else
                            <button class="btn btn-success w-100 fw-semibold">Add to Cart</button>
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
        const wishlistButtons = document.querySelectorAll('.wishlist-toggle');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        wishlistButtons.forEach(button => {
            const productId = button.dataset.productId;
            const icon = button.querySelector('i');

            // Attach click handler to toggle wishlist via AJAX
            button.addEventListener('click', function (e) {
                e.preventDefault();

                fetch("{{ url('user/wishlist/toggle') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const wishlisted = data.action === 'added';
                        if (wishlisted) {
                            icon.classList.remove('fa-regular');
                            icon.classList.add('fa-solid');

                        } else {
                            icon.classList.remove('fa-solid');
                            icon.classList.add('fa-regular');
                        }

                        // Update wishlist badge in navbar if present
                        const badge = document.querySelector('a[href="{{ route('user.wishlist.index') }}"] .badge') || document.querySelector('.navbar .badge.bg-danger');
                        if (badge) {
                            badge.textContent = data.count;
                            if (parseInt(data.count) > 0) {
                                badge.style.display = 'inline-block';
                            } else {
                                badge.style.display = 'none';
                            }
                        }
                    // Redirect to wishlist page after successful toggle
                    window.location.href = "{{ route('user.wishlist.index') }}";
                    }
                }).catch(err => {
                    console.error('Wishlist toggle error', err);
                });
            });
        });
    });
</script>
