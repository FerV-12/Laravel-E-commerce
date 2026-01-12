@extends('layouts.admin')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Orders</h2>
            <small class="text-muted">Manage and review customer orders</small>
        </div>
    </div>

    <!-- Orders Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;" class="text-center">#</th>
                            <th style="width:160px;" class="text-center">Order No.</th>
                            <th style="width:300px;" class="text-center">Customer</th>
                            <th style="width:140px;" class="text-center">Total</th>
                            <th style="width:200px;" class="text-center">Placed At</th>
                            <th style="width:180px;" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <!-- ID -->
                                <td class="fw-semibold text-center">
                                    {{ $order->id }}
                                </td>

                                <!-- Order Number -->
                                <td class="text-center">
                                    <span class="badge bg-secondary px-3 py-2">
                                        {{ $order->order_number }}
                                    </span>
                                </td>

                                <!-- Customer -->
                                <td class="text-center">
                                    {{ $order->user?->name ?? ($order->first_name . ' ' . $order->last_name) }}
                                </td>
                                
                                <!-- Total -->
                                <td class="fw-semibold text-end">
                                    ₱{{ number_format($order->total ?? 0, 2) }}
                                </td>

                                <!-- Date -->
                                <td class="text-muted">
                                    {{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y h:i A') }}
                                </td>

                                <!-- Action -->
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ url('admin/orders/'.$order->id) }}"
                                           class="btn btn-sm btn-outline-primary px-3">
                                            <i class="fa fa-eye me-1"></i> View
                                        </a>

                                        <form action="{{ url('admin/orders/'.$order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger px-3"
                                                    onclick="return confirm('Are you sure you want to delete this order?')">
                                                <i class="fa fa-trash me-1"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end px-3 py-3 border-top">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
