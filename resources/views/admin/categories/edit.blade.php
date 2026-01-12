@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">📁 Edit Category</h4>
            <small class="text-muted">Update category details and visibility</small>
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
            <form action="{{ url('admin/categories/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- CATEGORY NAME --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $category->description }}</textarea>
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Visibility</label>
                        <select name="status" class="form-select">
                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Show</option>
                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Hide</option>
                        </select>
                    </div>

                    {{-- POPULAR --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Popular Category</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="popular" value="1"
                                {{ $category->popular ? 'checked' : '' }}>
                            <label class="form-check-label">
                                Highlight as popular category
                            </label>
                        </div>
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Category Image</label>
                        <input type="file" name="image" class="form-control mb-2">

                        @if($category->image)
                            <div class="d-flex align-items-center gap-3 mt-2">
                                <img src="{{ asset($category->image) }}"
                                     class="rounded border"
                                     style="width:120px;height:120px;object-fit:cover;">
                                <small class="text-muted">Current Image</small>
                            </div>
                        @else
                            <small class="text-muted">No image uploaded.</small>
                        @endif
                    </div>

                    {{-- SAVE --}}
                    <div class="col-md-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Update Category
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

@endsection
