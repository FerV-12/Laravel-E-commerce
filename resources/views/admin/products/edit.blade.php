@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">✏️ Edit Product</h4>
            <small class="text-muted">Update product information and settings</small>
        </div>

        <a href="{{ url('/admin/products') }}" class="btn btn-outline-danger">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light fw-semibold">
            Product Information
        </div>

        <div class="card-body">
            <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- PRODUCT NAME --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}" 
                                    {{ $cate->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $cate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BRAND --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Brand</label>
                        <select name="brand_id" class="form-select" required>
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" 
                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SMALL DESCRIPTION --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Short Description</label>
                        <textarea name="small_description" class="form-control" rows="3">{{ $product->small_description }}</textarea>
                    </div>

                    {{-- FULL DESCRIPTION --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Full Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                    </div>

                    {{-- PRICING --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Original Price (₱)</label>
                        <input type="number" name="original_price" value="{{ $product->original_price }}" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Selling Price (₱)</label>
                        <input type="number" name="selling_price" value="{{ $product->selling_price }}" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Stock Quantity</label>
                        <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" min="0">
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Product Image</label>
                        <input type="file" name="image" class="form-control mb-2">

                        @if($product->image)
                            <div class="d-flex align-items-center gap-3 mt-2">
                                <img src="{{ asset($product->image) }}"
                                     class="rounded border"
                                     style="width:120px;height:120px;object-fit:cover;">
                                <small class="text-muted">Current Image</small>
                            </div>
                        @else
                            <small class="text-muted">No image uploaded.</small>
                        @endif
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Trending</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_trending" 
                                {{ $product->is_trending ? 'checked' : '' }}>
                            <label class="form-check-label">Mark as Trending</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Active</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" 
                                {{ $product->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Visible in Store</label>
                        </div>
                    </div>

                    {{-- SAVE --}}
                    <div class="col-md-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Update Product
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

@endsection
