@extends('layouts.user')

@section('content')

<div class="container py-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            📂 Product Categories
        </h3>
        <span class="text-muted small">
            Manage and monitor store categories
        </span>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">

        </div>

        <div class="card-body">

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80">ID</th>
                            <th>Category Name</th>
                            <th class="text-center">Visibility</th>
                            <th class="text-center">Popular</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($categories as $item)
                        <tr>
                            <td class="fw-semibold text-muted">#{{ $item->id }}</td>

                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>
                                <small class="text-muted">Product grouping</small>
                            </td>

                            <td class="text-center">
                                @if ($item->status == 0)
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        👁 Visible
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                        🚫 Hidden
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($item->popular == 1)
                                    <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                        ⭐ Featured
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                        —
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <h6 class="text-muted mb-1">No categories found</h6>
                                <p class="small text-muted mb-0">
                                    Start by adding product categories
                                </p>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
