@extends('layouts.user')

@section('content')

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Profile Settings</h4>
        <a href="{{ url('user/dashboard') }}" class="btn btn-secondary btn-sm">Back to Dashboard</a>
    </div>

    <div class="card-body">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.settings.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">

                {{-- Profile Picture --}}
                <div class="col-md-12 mb-4">
                    <label class="form-label">Profile Picture</label>
                    <div class="d-flex align-items-center gap-3 mb-2">
                        @if(Auth::user()->profile)
                            <img src="{{ asset('profiles/'.Auth::user()->profile) }}" 
                                 class="rounded-circle" width="80" height="80" alt="Profile Picture">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                 style="width:80px; height:80px;">No Image</div>
                        @endif
                        <input type="file" name="profile" class="form-control-file">
                    </div>
                </div>

                {{-- Full Name --}}
                <div class="col-md-12 mb-4">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Enter your full name">
                </div>

                {{-- New Password --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank if unchanged">
                        <button type="button" class="input-group-text toggle-password" style="cursor:pointer" data-target="password" aria-label="Show password">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <small class="text-muted d-block mt-1">
                        Password must be at least 6 characters, include 1 uppercase letter and 1 number.
                    </small>
                </div>

                {{-- Confirm Password --}}
                <div class="col-md-6 mb-4">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <button type="button" class="input-group-text toggle-password" style="cursor:pointer" data-target="password_confirmation" aria-label="Show confirm password">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
