@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">👤 Create Account</h4>
            <small class="text-muted">Add a new user or administrator account</small>
        </div>

        <a href="{{ url('/admin/accounts') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Accounts
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- CARD --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-light fw-semibold">
                    Account Information
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.accounts.store') }}">
                        @csrf

                        <div class="row">

                            {{-- NAME --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="user@email.com" required>
                            </div>

                            {{-- PASSWORD --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                            </div>

                            {{-- ROLE --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Account Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="" disabled>Select role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Administrator</option>
                                </select>
                                <small class="text-muted">Assign permissions for this account</small>
                            </div>

                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ url('/admin/accounts') }}" class="btn btn-light px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa fa-save me-1"></i> Create Account
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
