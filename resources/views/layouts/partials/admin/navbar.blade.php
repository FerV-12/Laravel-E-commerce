<style>
    /* ================= TOP NAVIGATION STYLES ================= */
    .sb-topnav {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        border-bottom: 2px solid rgba(102,126,234,0.3);
        padding: 0.75rem 1rem;
    }

    /* Brand Logo */
    .navbar-brand {
        font-size: 1.4rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .navbar-brand::before {
        content: '🛍️';
        margin-right: 0.5rem;
        filter: drop-shadow(0 2px 5px rgba(102,126,234,0.5));
    }

    .navbar-brand:hover {
        transform: scale(1.05);
        filter: drop-shadow(0 4px 10px rgba(102,126,234,0.6));
    }

    /* Sidebar Toggle Button */
    #sidebarToggle {
        background: rgba(102,126,234,0.2);
        border: 1px solid rgba(102,126,234,0.4);
        border-radius: 10px;
        color: #667eea;
        padding: 0.5rem 0.75rem;
        transition: all 0.3s ease;
    }

    #sidebarToggle:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(102,126,234,0.4);
    }

    /* Search Bar */
    .search-wrapper {
        position: relative;
    }

    .search-wrapper .form-control {
        background: rgba(255,255,255,0.1);
        border: 2px solid rgba(102,126,234,0.3);
        border-radius: 25px 0 0 25px;
        color: white;
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .search-wrapper .form-control::placeholder {
        color: rgba(255,255,255,0.5);
    }

    .search-wrapper .form-control:focus {
        background: rgba(255,255,255,0.15);
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102,126,234,0.2);
        color: white;
    }

    .search-wrapper .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 2px solid rgba(102,126,234,0.3);
        border-left: none;
        border-radius: 0 25px 25px 0;
        padding: 0.6rem 1.5rem;
        transition: all 0.3s ease;
    }

    .search-wrapper .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(102,126,234,0.5);
    }

    /* Notification Bell */
    .notification-bell {
        position: relative;
        background: rgba(102,126,234,0.15);
        border-radius: 12px;
        padding: 0.6rem 1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .notification-bell:hover {
        background: rgba(102,126,234,0.25);
        border-color: rgba(102,126,234,0.5);
        transform: scale(1.05);
    }

    .notification-bell i {
        font-size: 1.3rem;
        color: #667eea;
        animation: bellRing 2s ease-in-out infinite;
    }

    @keyframes bellRing {
        0%, 100% { transform: rotate(0deg); }
        10%, 30% { transform: rotate(14deg); }
        20%, 40% { transform: rotate(-14deg); }
        50% { transform: rotate(0deg); }
    }

    .notification-badge {
        position: absolute;
        top: 0;
        right: 0;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.2rem 0.5rem;
        border-radius: 20px;
        box-shadow: 0 2px 10px rgba(245,87,108,0.6);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Notification Dropdown */
    .notification-dropdown {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        width: 380px;
        max-height: 500px;
        overflow: hidden;
    }

    .notification-dropdown .dropdown-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 800;
        font-size: 1.1rem;
        padding: 1rem 1.5rem;
        border-bottom: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .notification-dropdown .mark-read-btn {
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        border-radius: 20px;
        padding: 0.3rem 0.8rem;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .notification-dropdown .mark-read-btn:hover {
        background: rgba(255,255,255,0.3);
        transform: scale(1.05);
    }

    .notification-scroll {
        max-height: 350px;
        overflow-y: auto;
    }

    .notification-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .notification-scroll::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.05);
    }

    .notification-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }

    .notification-item {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    .notification-item:hover {
        background: linear-gradient(135deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%);
        transform: translateX(5px);
    }

    .notification-item.unread {
        background: linear-gradient(135deg, rgba(102,126,234,0.08) 0%, rgba(118,75,162,0.08) 100%);
    }

    .notification-icon-wrapper {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .notification-icon-wrapper.order {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .notification-icon-wrapper.user {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .notification-icon-wrapper.default {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .notification-icon-wrapper i {
        color: white;
        font-size: 1.2rem;
    }

    .notification-text {
        flex: 1;
    }

    .notification-message {
        color: #2d3748;
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 0.3rem;
        font-weight: 500;
    }

    .notification-time {
        color: #718096;
        font-size: 0.8rem;
    }

    .notification-new-badge {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.3rem 0.7rem;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(245,87,108,0.4);
    }

    .notification-footer {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        text-align: center;
        padding: 1rem;
        border-top: 1px solid #dee2e6;
        position: sticky;
        bottom: 0;
    }

    .notification-footer a {
        color: #667eea;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .notification-footer a:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    .empty-notification {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #718096;
    }

    .empty-notification i {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }

    /* User Profile Dropdown */
    .user-profile {
        position: relative;
        background: rgba(102,126,234,0.15);
        border-radius: 12px;
        padding: 0.4rem 0.8rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .user-profile:hover {
        background: rgba(102,126,234,0.25);
        border-color: rgba(102,126,234,0.5);
        transform: scale(1.05);
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 2px solid rgba(102,126,234,0.5);
        object-fit: cover;
        box-shadow: 0 2px 10px rgba(102,126,234,0.3);
    }

    .user-avatar-icon {
        font-size: 1.5rem;
        color: #667eea;
    }

    .user-dropdown {
        background: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        min-width: 200px;
    }

    .user-dropdown .dropdown-item {
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .user-dropdown .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%);
        color: #667eea;
        transform: translateX(5px);
    }
</style>

<nav class="sb-topnav navbar navbar-expand navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand ps-3" href="{{ url('admin/dashboard') }}">
        Fast Shopping Store
    </a>

    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Search Bar -->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 search-wrapper">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search products, orders..." />
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <!-- Right Nav Items -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

        <!-- Notifications -->
        <li class="nav-item dropdown me-3">
            @php
                $unreadCount = \App\Models\SiteNotification::where('is_read', false)->count();
                $notifications = \App\Models\SiteNotification::latest()->take(6)->get();
            @endphp

            <a class="nav-link dropdown-toggle notification-bell" href="#" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell"></i>
                @if($unreadCount > 0)
                    <span class="notification-badge">{{ $unreadCount }}</span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                <!-- Header -->
                <li class="dropdown-header d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-bell me-2"></i>Notifications
                    </span>
                    @if($unreadCount > 0)
                        <button class="btn btn-sm mark-read-btn"
                                onclick="markAllAsRead(event)">
                            <i class="fas fa-check-double me-1"></i>Mark all
                        </button>
                    @else
                        <button class="btn btn-sm mark-read-btn"
                                onclick="markAllAsUnread(event)">
                            <i class="fas fa-undo me-1"></i>Reset
                        </button>
                    @endif
                </li>

                <!-- Notification List -->
                <div class="notification-scroll">
                    @forelse($notifications as $note)
                        <li>
                            <a class="dropdown-item notification-item {{ $note->is_read ? '' : 'unread' }}"
                               href="{{ $note->link ?? '#' }}"
                               onclick="event.preventDefault(); markAsRead({{ $note->id }}, '{{ $note->link ?? '' }}')">

                                <div class="d-flex align-items-start">
                                    @php
                                        $iconClass = match($note->type) {
                                            'order_created' => 'order',
                                            'user_updated' => 'user',
                                            default => 'default'
                                        };
                                        $icon = match($note->type) {
                                            'order_created' => 'fa-shopping-cart',
                                            'user_updated' => 'fa-user-edit',
                                            default => 'fa-bell'
                                        };
                                    @endphp

                                    <div class="notification-icon-wrapper {{ $iconClass }}">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>

                                    <div class="notification-text">
                                        <div class="notification-message">
                                            {{ \Illuminate\Support\Str::limit($note->message, 80) }}
                                        </div>
                                        <div class="notification-time">
                                            <i class="far fa-clock me-1"></i>
                                            {{ $note->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    @if(!$note->is_read)
                                        <span class="notification-new-badge ms-2">New</span>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="empty-notification">
                            <i class="fas fa-inbox"></i>
                            <div class="fw-bold">No notifications yet</div>
                            <small>You're all caught up!</small>
                        </li>
                    @endforelse
                </div>

                <!-- Footer -->
                @if($notifications->count() > 0)
                    <li class="notification-footer">
                        <a href="{{ route('admin.notifications.index') }}">
                            View all notifications <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <!-- User Profile -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle user-profile" href="#" 
               data-bs-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->profile)
                    <img src="{{ asset('profiles/'.Auth::user()->profile) }}"
                         class="user-avatar"
                         alt="Profile">
                @else
                    <i class="fas fa-user-circle user-avatar-icon"></i>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.settings') }}">
                        <i class="fas fa-user-cog me-2"></i>Profile Settings
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           class="dropdown-item text-danger"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                        </a>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<script>
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
    event.stopPropagation();

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
    event.stopPropagation();

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