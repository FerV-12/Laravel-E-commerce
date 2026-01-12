@extends('layouts.user')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">    
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to Dashboard
        </a>
        <h3 class="fw-bold mb-0">❤️ Your Wishlist</h3>
        <span class="text-muted small">Saved items you liked</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->count())
        <div class="row g-4">
            @foreach($items as $it)
                @php
                    $p = $it->product;
                    $img = $p && $p->image
                        ? (\Illuminate\Support\Str::contains($p->image, '/') ? asset($p->image) : asset('uploads/products/' . $p->image))
                        : asset('assets/images/placeholder.png');
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <img src="{{ $img }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="">
                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-semibold">{{ $p->name ?? 'Product' }}</h6>
                            <p class="text-muted small mb-2">{{ $p->category?->name ?? 'Uncategorized' }}</p>
                            <div class="mt-auto d-flex gap-2">
                                <form action="{{ route('user.cart.add') }}" method="POST" class="w-100">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                    <button class="btn btn-success w-100">Add to Cart</button>
                                </form>


                                <form action="{{ route('user.wishlist.remove') }}" method="POST"  class="w-150">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                    <button class="btn btn-outline-danger">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">No items in your wishlist yet.</div>
    @endif

</div>
@endsection
