@extends('layouts.user')

@section('content')
<div class="container py-5">

    {{-- SUCCESS HEADER --}}
    <div class="text-center mb-5">
        <div class="mb-3">
            <span class="display-4 text-success">✔</span>
        </div>
        <h2 class="fw-bold">Order Placed Successfully</h2>
        <p class="text-muted">
            Thank you for shopping with us! Your order is being processed.
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">

            {{-- ORDER INFO --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-semibold">
                    📦 Order Information
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="small text-muted">Order Number</div>
                            <div class="fw-semibold">#{{ $order['order_number'] ?? ($order['id'] ?? '') }}</div>
                        </div>

                        <div class="col-md-6 text-md-end">
                            <div class="small text-muted">Total Payment</div>
                            <div class="fs-5 fw-bold text-success">
                                ₱{{ number_format($order['total'], 2) }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Customer Name</strong><br>
                            {{ $order['first_name'] }} {{ $order['last_name'] }}
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Contact Number</strong><br>
                            {{ $order['contact_number'] }}
                        </div>

                        <div class="col-md-6 mb-2">
                            <strong>Mode of Payment</strong><br>
                            {{ $order['payment_method'] ?? 'N/A' }}
                        </div>

                        <div class="col-12 mt-2">
                            <strong>Delivery Address</strong><br>
                            {{ $order['address'] }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- ITEMS --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-semibold">
                    🛍 Ordered Items
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($order['items'] as $it)
                            @php
                                $rawImg = $it['image'] ?? null;
                                if ($rawImg) {
                                    $isFull = \Illuminate\Support\Str::startsWith($rawImg, ['http://', 'https://', '/']);
                                    $imgUrl = $isFull ? $rawImg : asset($rawImg);
                                } else {
                                    $imgUrl = asset('assets/images/placeholder.png');
                                }
                            @endphp

                            <li class="list-group-item px-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $imgUrl }}"
                                             alt=""
                                             class="rounded"
                                             style="width:64px;height:64px;object-fit:cover;">
                                        <div>
                                            <div class="fw-semibold">{{ $it['product_name'] ?? $it['name'] ?? 'Product' }}</div>
                                            <small class="text-muted">Qty: {{ $it['quantity'] }}</small>
                                        </div>
                                    </div>

                                    <div class="fw-semibold">
                                        ₱{{ number_format($it['subtotal'], 2) }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Order Total</span>
                        <span class="fs-5 fw-bold text-success">
                            ₱{{ number_format($order['total'], 2) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary px-4">
                    Continue Shopping
                </a>

                <button onclick="window.print()" class="btn btn-primary px-4">
                    Print Receipt
                </button>
            </div>

        </div>
    </div>

</div>
@endsection
