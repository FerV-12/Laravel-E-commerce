<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <!-- Navbar Brand -->
    <a class="navbar-brand ps-3" href="{{ url('user/dashboard') }}">
        Fast Shopping Store
    </a>

    <!-- Sidebar Toggle -->
    @if(Auth::user() && Auth::user()->role === 'admin')
    <!-- Sidebar Toggle -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
        id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    @endif

    <!-- Spacer (push icons to the right) -->
    <div class="ms-auto"></div>

    <!-- Cart Icon -->
    <ul class="navbar-nav me-3">
        <li class="nav-item">
            <a class="nav-link position-relative" href="{{ route('user.cart.index') }}">
                <i class="fas fa-shopping-cart"></i> Cart

                @if(isset($cartCount)  && $cartCount > 0)
                    <span class="position-absolute top- 10 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size:0.65em; transform:translate(-40%, -35%);">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </li>
    </ul>

     <!-- Wishlist Icon -->
    <ul class="navbar-nav me-3">
        <li class="nav-item">
            <a class="nav-link position-relative" href="{{ route('user.wishlist.index') }}">
                <i class="fas fa-heart"></i> Wishlist
    
                @if(isset($wishlistCount) && $wishlistCount > 0)
                    <span class="position-absolute top- 10 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size:0.65em; transform:translate(-40%, -35%);">
                        {{ $wishlistCount }}
                    </span>
                @endif
            </a>
        </li>
    </ul>

    <!-- User Dropdown -->
    <ul class="navbar-nav me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown"
                href="#" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-user fa-fw"></i>
                {{ Auth::user()->name ?? 'No user' }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
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
