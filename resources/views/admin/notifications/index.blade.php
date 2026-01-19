@extends('layouts.admin')

@section('content')

<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="fw-bold mb-0">Notifications</h4>
            <small class="text-muted">List of all site notifications</small>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="list-group">
                @foreach($notifications as $note)
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold">{{ $note->message }}</div>
                            <div class="small text-muted">{{ $note->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="btn-group">
                            @if(!$note->is_read)
                                <form method="POST" action="{{ route('admin.notifications.read', $note->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">Mark read</button>
                                </form>
                            @endif
                            @if($note->link)
                                <a href="{{ $note->link }}" class="btn btn-sm btn-outline-secondary">Open</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{ $notifications->links() }}
                </div>
        </div>
    </div>
</div>

@endsection
