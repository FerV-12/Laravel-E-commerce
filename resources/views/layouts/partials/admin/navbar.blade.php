<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="{{ url('admin/dashboard') }}">Fast Shopping Store</a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." />
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

        <!-- Notifications -->
        <li class="nav-item dropdown">
            @php
                $unreadCount = \App\Models\SiteNotification::where('is_read', false)->count();
                $notifications = \App\Models\SiteNotification::latest()->take(6)->get();
            @endphp

            <a class="nav-link dropdown-toggle" href="#" role="button"
               data-bs-toggle="dropdown">
                <i class="fas fa-bell fa-fw"></i>
                @if($unreadCount > 0)
                    <span class="badge bg-danger">{{ $unreadCount }}</span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end"
                style="width:350px; max-height:450px; overflow-y:auto;">

                <li class="dropdown-header d-flex justify-content-between align-items-center">
                    <span>Notifications</span>

                    @if($unreadCount > 0)
                    
                        <button class="btn btn-sm btn-link text-decoration-none"
                                onclick="markAllAsRead(event)" title="Mark All as Read">
                            Mark all as read
                        </button>
                    @else
                        <button class="btn btn-sm btn-link text-decoration-none"
                                onclick="markAllAsUnread(event)"
                                title="Mark All as Unread">
                            Mark all as read
                        </button>
                    @endif
                </li>

                @forelse($notifications as $note)
                    <li>
                        <a class="dropdown-item notification-item {{ $note->is_read ? '' : 'fw-bold' }}"
                           href="{{ $note->link ?? '#' }}"
                           onclick="event.preventDefault(); markAsRead({{ $note->id }}, '{{ $note->link ?? '' }}')">

                            <div class="d-flex w-100">
                             @php
                                $icon = match($note->type){
                                    'order_created' => 'fa-box',
                                    'user_updated'  => 'fa-user',
                                    default => 'fa-bell'
                                };
                            @endphp
                                <div class="flex-grow-1 notification-text">
                                    <div class="small"><i class="fa {{$icon}} me-1"></i> 
                                        {{ \Illuminate\Support\Str::limit($note->message, 70) }}
                                    </div>
                                    <div class="text-muted small">
                                        {{ $note->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                @if(!$note->is_read)
                                    <span class="badge bg-primary ms-2">New</span>
                                @endif
                            </div>
                        </a>
                    </li>
                @empty
                    <li>
                        <span class="dropdown-item text-center">No notifications</span>
                    </li>
                @endforelse

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-center"
                       href="{{ route('admin.notifications.index') }}">
                        View all notifications
                    </a>
                </li>
            </ul>
        </li>

        <!-- User -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                @if(Auth::user()->profile)
                    <img src="{{ asset('profiles/'.Auth::user()->profile) }}"
                         class="rounded-circle" width="30" height="30"
                         style="object-fit:cover;">
                @else
                    <i class="fas fa-user-circle fa-fw"></i>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.settings') }}">
                        Profile Settings
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<style>
.notification-item {
    white-space: normal;
}

.notification-text {

    max-width: 250px;
    word-break: break-word;
    line-height: 1.3;
}
</style>

<script>


.notification-badge {
    width: 25px; /* Adjust as needed */
    height: 20px; /* Adjust as needed */
}
function markAsRead(id, redirectUrl) {
    const token = document.querySelector('meta[name="csrf-token"]').content;

    fetch(`/admin/notifications/${id}/read`, {
        method: 'POST',
         headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(() => {
        redirectUrl ? window.location = redirectUrl : window.location.reload();
    });
}

function markAllAsRead(event) {
    event.preventDefault();

    const token = document.querySelector('meta[name="csrf-token"]').content;

    fetch(`/admin/notifications/read-all`, {
        method: 'POST',
         headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(() => {
        window.location.reload();
    });
}

function markAllAsUnread(event) {
    event.preventDefault();

    const token = document.querySelector('meta[name="csrf-token"]').content;

    fetch(`/admin/notifications/read-all?unread=1`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(() => {
        window.location.reload();
    });
}
</script>
