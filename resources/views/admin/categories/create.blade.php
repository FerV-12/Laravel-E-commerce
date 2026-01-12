@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">📂 Add Product Category</h4>
            <small class="text-muted">Create and organize product categories</small>
        </div>

        <a href="{{ url('/admin/categories') }}" class="btn btn-outline-danger">
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
            Category Information
        </div>

        <div class="card-body">
            <form action="{{ url('admin/categories') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    {{-- CATEGORY NAME --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Short description about this category"></textarea>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Visibility Status</label>
                        <select name="status" class="form-select">
                            <option value="0">Visible</option>
                            <option value="1">Hidden</option>
                        </select>
                        <small class="text-muted">Hidden categories will not appear in the shop.</small>
                    </div>

                    {{-- POPULAR --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Popular Category</label>

                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="popular" value="1" id="popular">
                            <label class="form-check-label fw-semibold" for="popular">
                                Mark as Popular
                            </label>
                        </div>

                        <small class="text-muted">
                            Popular categories may appear on homepage highlights.
                        </small>
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Category Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Recommended size: 600×400 pixels</small>
                    </div>

                    {{-- SAVE BUTTON --}}
                    <div class="col-md-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Save Category
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

@endsection
