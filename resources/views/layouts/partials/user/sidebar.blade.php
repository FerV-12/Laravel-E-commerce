<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <div class="sb-sidenav-menu-heading">Home</div>
            <a class="nav-link" href="{{ url('user/dashboard') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Activity</div>

            <!-- Categories -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-list"></i>
                </div>
                Categories
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseCategory" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    @if(Auth::user()->role === 'admin')
                        <a class="nav-link" href="{{ url('user/categories/create') }}">Create Categories</a>
                    @endif
                    <a class="nav-link" href="{{ url('user/categories') }}">View Categories</a>
                </nav>
            </div>

            <!-- Brands -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-building"></i>
                </div>
                Brands
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseProduct" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    @if(Auth::user()->role === 'admin')
                        <a class="nav-link" href="{{ url('user/brands/create') }}">Create Brands</a>
                    @endif
                    <a class="nav-link" href="{{ url('user/brands') }}">View Brands</a>
                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tags"></i>
                </div>
                Product
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseBrand" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    @if(Auth::user()->role === 'admin')
                        <a class="nav-link" href="{{ url('user/products/create') }}">Create Product</a>
                    @endif
                    <a class="nav-link" href="{{ url('user/products') }}">View Products</a>
                </nav>
            </div>

        </div>
    </div>
    

    <div class="sb-sidenav-footer">
        <div class="small">Hello there: {{ Auth::user()->name }}</div>
        @auth
            <div class="small">Your role is: {{ ucfirst(Auth::user()->role ?? 'user') }}</div>
        @else
            <div>Guest</div>
        @endauth
    </div>
</nav>
