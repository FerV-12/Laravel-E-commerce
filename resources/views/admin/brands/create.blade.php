@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">🏷️ Add Brand</h4>
            <small class="text-muted">Create a new brand for product organization</small>
        </div>

        <a href="{{ url('/admin/brands') }}" class="btn btn-outline-danger">
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
            Brand Information
        </div>

        <div class="card-body">
            <form action="{{ url('admin/brands') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    {{-- BRAND NAME --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Brand Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter brand name" required>
                    </div>

                    {{-- BRAND IMAGE --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Brand Logo / Image</label>
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Optional — PNG/JPG recommended</small>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>

                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="active" checked>
                            <label class="form-check-label fw-semibold" for="active">
                                Active Brand
                            </label>
                        </div>

                        <small class="text-muted">
                            Active brands will appear in product selection
                        </small>
                    </div>

                    {{-- SAVE BUTTON --}}
                    <div class="col-md-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Save Brand
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

@endsection
