<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <div class="sb-sidenav-menu-heading">Home</div>
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
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
                    <a class="nav-link" href="{{ url('admin/categories/create') }}">Create Product Categories</a>
                    <a class="nav-link" href="{{ url('admin/categories') }}">View Product Categories</a>
                </nav>
            </div>

            <!-- Brands -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-tags"></i>
                </div>
                Brands
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseProduct" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/brands/create') }}">Create Brand Types</a>
                    <a class="nav-link" href="{{ url('admin/brands') }}">View Brands</a>
                </nav>
            </div>

            <!-- Products -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-box"></i>
                </div>
                Products
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-angle-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseBrand" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/products/create') }}">Create Product</a>
                    <a class="nav-link" href="{{ url('admin/products') }}">View Products</a>
                </nav>
            </div>

            <div class="sb-sidenav-menu-heading">Management</div>
            <!-- Accounts -->
            <a class="nav-link" href="{{ url('admin/accounts') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-users"></i>
                </div>
                Accounts
            </a>

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
