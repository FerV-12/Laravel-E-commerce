@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Brand</h4>
            <a href="{{ url('/admin/brands') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('admin/brands/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Brand Name -->
                <div class="mb-4">
                    <label class="form-label">Brand Name</label>
                    <input type="text"
                           name="name"
                           value="{{ $brand->name }}"
                           class="form-control"
                           placeholder="Enter brand name"
                           required>
                </div>

                <div class="row mb-4">

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>

                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_active"
                                   value="1"
                                   id="active"
                                   {{ $brand->is_active == 1 ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="active">
                                Active Brand
                            </label>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-md-6">
                        <label class="form-label">Brand Logo / Image</label>
                        <input type="file" name="image" class="form-control">

                        @if($brand->image)
                            <img src="{{ asset($brand->image) }}"
                                 class="mt-2"
                                 style="width:100px; height:100px; object-fit:cover; border-radius:5px;"
                                 alt="Brand Image">
                        @else
                            <p class="mt-2 text-muted">No Image Uploaded</p>
                        @endif
                    </div>

                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa fa-save me-1"></i> Update Brand
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
