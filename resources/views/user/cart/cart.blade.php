@extends('layouts.user')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 mx-auto">

            <h3 class="fw-bold mb-4">🛒 Shopping Cart</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($cart && $cart->count() > 0)

                @php $grandTotal = 0; @endphp 

                {{-- CART LIST --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-0">

                        @foreach($cart as $item)
                            @php
                                $product = $item->product;
                                $subtotal = $product->selling_price * $item->quantity;
                                $grandTotal += $subtotal;
                                $img = $product->image
                                    ? (\Illuminate\Support\Str::contains($product->image, '/')
                                        ? asset($product->image)
                                        : asset('uploads/products/' . $product->image))
                                    : asset('assets/images/placeholder.png');
                            @endphp

                            <div class="cart-row d-flex align-items-center p-3 border-bottom">

                                {{-- IMAGE --}}
                                <div class="me-3 flex-shrink-0">
                                    <img src="{{ $img }}"
                                         class="rounded border"
                                         style="width:90px;height:90px;object-fit:cover;">
                                </div>

                                {{-- PRODUCT INFO --}}
                                <div class="flex-grow-1 pe-3">
                                    <div class="fw-semibold">{{ $product->name }}</div>

                                    <div class="small text-muted mb-1">
                                        Category: {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>

                                    <div class="fw-bold text-success">
                                        ₱{{ number_format($product->selling_price, 2) }}
                                        @if($product->original_price && $product->original_price > $product->selling_price)
                                            <span class="text-muted small text-decoration-line-through ms-1">
                                                ₱{{ number_format($product->original_price, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <small class="text-muted">
                                        Stock: <b class="text-dark">{{ $product->quantity }}</b>
                                    </small>
                                </div>

                                {{-- RIGHT SIDE ACTIONS --}}
                                <div class="d-flex align-items-center gap-3 flex-shrink-0">

                                    {{-- QUANTITY + UPDATE --}}
                                    <form action="{{ route('user.cart.update') }}"
                                          method="POST"
                                          class="d-flex align-items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">

                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item->quantity }}"
                                               min="1"
                                               max="{{ $product->quantity }}"
                                               class="form-control form-control-sm text-center quantity-input"
                                               style="width:70px;"
                                               data-product-id="{{ $item->product_id }}">

                                        <button type="submit"
                                                class="btn btn-outline-primary btn-sm">
                                            Update
                                        </button>
                                    </form>

                                    {{-- SUBTOTAL --}}
                                    <div class="text-end" style="min-width:120px;">
                                        <div class="small text-muted">Subtotal</div>
                                        <div class="fw-semibold">
                                            ₱{{ number_format($subtotal, 2) }}
                                        </div>
                                    </div>

                                    {{-- REMOVE --}}
                                    <form action="{{ route('user.cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                        <button class="btn btn-outline-danger btn-sm">
                                            Remove
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- TOTAL BAR --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <div class="small text-muted">Grand Total</div>
                            <div class="fs-4 fw-bold text-success">
                                ₱{{ number_format($grandTotal, 2) }}
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                Continue Shopping
                            </a>
                            <a href="{{ route('user.checkout.index') }}" class="btn btn-success px-4">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>

            @else

                {{-- EMPTY CART --}}
                <div class="text-center py-5">
                    <div class="fs-1 mb-2">🛒</div>
                    <h5>Your cart is empty</h5>
                    <p class="text-muted">Browse products and start shopping.</p>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-success">
                        Start Shopping
                    </a>
                </div>

            @endif

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            const max = parseInt(this.max);
            const min = 1;
            let value = parseInt(this.value);

            if (value > max) this.value = max;
            if (value < min) this.value = min;
        });
    });
});
</script>
@endsection
