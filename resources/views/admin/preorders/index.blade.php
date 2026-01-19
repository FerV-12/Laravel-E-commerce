@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>Pre-orders</h3>

    <div class="list-group mt-3">
        @foreach($preorders as $p)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">{{ $p->product->name ?? 'Product' }} &times; {{ $p->quantity }}</div>
                    <div class="small text-muted">By: {{ $p->user->name ?? 'Guest' }} • {{ $p->created_at->diffForHumans() }}</div>
                    @if($p->note)
                        <div class="mt-1 small">Note: {{ $p->note }}</div>
                    @endif
                    @if($p->contact_phone)
                        <div class="mt-1 small">Contact: {{ $p->contact_phone }}</div>
                    @endif
                </div>
                <div>
                    <a href="{{ url('admin/products/'.$p->product_id.'/edit') }}" class="btn btn-sm btn-outline-primary">Open product</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">{{ $preorders->links() }}</div>
</div>
@endsection
