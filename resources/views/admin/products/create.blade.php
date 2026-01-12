@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">➕ Add New Product</h4>
            <small class="text-muted">Fill in product information carefully</small>
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
            Product Details
        </div>

        <div class="card-body">
            <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    {{-- PRODUCT NAME --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BRAND --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Brand</label>
                        <select name="brand_id" class="form-select">
                            <option value="">-- Select Brand --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SMALL DESCRIPTION --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Short Description</label>
                        <textarea name="small_description" class="form-control" rows="2" placeholder="Short summary"></textarea>
                    </div>

                    {{-- FULL DESCRIPTION --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Full Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Complete product description"></textarea>
                    </div>

                    {{-- PRICING --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Original Price (₱)</label>
                        <input type="number" name="original_price" class="form-control" min="0">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Selling Price (₱)</label>
                        <input type="number" name="selling_price" class="form-control" min="0" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Stock Quantity</label>
                        <input type="number" name="quantity" value="0" min="0" class="form-control">
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Product Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Recommended size: 800x800px</small>
                    </div>

                    {{-- STATUS OPTIONS --}}
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_trending" id="trending">
                            <label class="form-check-label fw-semibold" for="trending">
                                Mark as Featured Product
                            </label>
                        </div>
                        <small class="text-muted">Highlighted on homepage</small>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="active" checked>
                            <label class="form-check-label fw-semibold" for="active">
                                Active Product
                            </label>
                        </div>
                        <small class="text-muted">Visible to customers</small>
                    </div>

                    {{-- SAVE BUTTON --}}
                    <div class="col-md-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Save Product
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

@endsection
