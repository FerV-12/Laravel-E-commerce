@extends('layouts.admin')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold mb-0">Order Details</h2>
            <small class="text-muted">Review customer order information</small>
        </div>

        <a href="{{ url('admin/orders') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left me-1"></i> Back to Orders
        </a>
    </div>

    <div class="row">

        <!-- Order Info -->
        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">

                    <h5 class="fw-semibold mb-3">
                        Order #{{ $order->order_number }}
                    </h5>

                    <div class="mb-2">
                        <small class="text-muted">Customer</small>
                        <div class="fw-semibold">
                            {{ $order->user?->name ?? ($order->first_name . ' ' . $order->last_name) }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Contact</small>
                        <div>{{ $order->contact_number }}</div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Delivery Address</small>
                        <div>{{ $order->address }}</div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Payment Method</small>
                        <div class="fw-semibold">{{ strtoupper($order->payment_method) }}</div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Placed At</small>
                        <div>
                            {{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y h:i A') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h5 class="fw-semibold mb-3">Ordered Items</h5>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                    
                            @php
                                function displayImage($imagePath) {
                                    return asset($imagePath);
                                }
                            @endphp


                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td class="fw-semibold">
                                            {{ $item->product_name }}
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-secondary">
                                                {{ $item->quantity }}
                                            </span>
                                        </td>

                                        <td class="text-end">
                                            ₱{{ number_format($item->price ?? 0, 2) }}
                                        </td>

                                         <td class="text-center">
                                            @if($item->image)
                                                <img src="{{ displayImage($item->image) }}" alt="Product Image" style="width: 50px; height: 50px;">
                                            @endif
                                        </td>

                                        <td class="text-end fw-semibold">
                                            ₱{{ number_format($item->subtotal ?? 0, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>

                    <!-- Total -->
                    <div class="d-flex justify-content-end mt-3">
                        <div class="border rounded p-3 bg-light">
                            <div class="text-muted small">Total Amount</div>
                            <div class="fs-4 fw-bold text-success">
                                    ₱{{ number_format($order->total ?? 0, 2) }}
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
