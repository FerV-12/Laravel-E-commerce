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

    <!-- ✅ Footer with animated GIF & improved text -->
    <div class="sb-sidenav-footer d-flex align-items-center justify-content-between p-3" style="background-color:#1c1c1c; border-top:1px solid #333;">
        <div>
            <div class="small text-light">
                Hello there, <span class="fw-bold">{{ Auth::user()->name ?? 'Guest' }}</span>!
            </div>
            @auth
                <div class="small text-info" style="font-size:0.85rem;">
                    <i class="fas fa-user-shield"></i> Your role: <span class="fw-semibold">{{ ucfirst(Auth::user()->role ?? 'user') }}</span>
                </div>
            @else
                <div class="small text-warning" style="font-size:0.85rem;">
                    <i class="fas fa-user"></i> Guest
                </div>
            @endauth
        </div>
        <div>
            <!-- Dancing cat GIF -->
            <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExOHB1MzVhcHg2aDljaWIzdHh0NTBseml0MXo2eWdqemFqYmVuZTdiNSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/CK5gKBdBXdGtVv6AfG/giphy.gif" 
                 alt="Dancing Cat" 
                 width="50" 
                 height="50"
                 style="border-radius:40%;"/>
        </div>
    </div>
</nav>
