@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">👤 User Accounts</h4>
            <small class="text-muted">Manage registered users and roles</small>
        </div>
         <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary">
            Add Account
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light fw-semibold">
            Accounts List
        </div>

        <div class="card-body">

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#ID</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Registered</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($users as $user)
                        <tr>
                            {{-- ID --}}
                            <td class="fw-semibold text-center">{{ $user->id }}</td>

                            {{-- NAME --}}
                            <td>
                                <div class="fw-semibold text-center">{{ $user->name }}</div>
                            </td>

                            {{-- EMAIL --}}
                            <td class="text-muted text-center">{{ $user->email }}</td>

                            {{-- ROLE BADGE --}}
                            <td class="text-center">
                                @if($user->role === 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>

                            {{-- DATE --}}
                            <td class="text-center">
                                {{ $user->created_at?->format('M d, Y') }}
                            </td>

                            {{-- ACTION --}}
                            <td class="text-center">
    <div class="d-flex justify-content-center">
        <form action="{{ url('admin/accounts/'.$user->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="btn btn-sm btn-outline-danger px-3 d-flex align-items-center gap-1"
                onclick="return confirm('Are you sure you want to delete this account?')">
                <i class="fa fa-trash"></i>
                <span>Remove</span>
            </button>
        </form>
    </div>
</td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                No accounts found.
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
