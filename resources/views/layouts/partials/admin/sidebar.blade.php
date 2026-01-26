<style>
    /* ================= MODERN SIDEBAR STYLES ================= */
    .sb-sidenav {
        background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        box-shadow: 4px 0 20px rgba(0,0,0,0.3);
    }

    .sb-sidenav-menu-heading {
        color: #667eea;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 1.5rem 1rem 0.5rem;
        margin-top: 0.5rem;
        position: relative;
    }

    .sb-sidenav-menu-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 1rem;
        right: 1rem;
        height: 2px;
        background: linear-gradient(90deg, #667eea 0%, transparent 100%);
        border-radius: 2px;
    }

    .sb-sidenav .nav-link {
        color: #e0e0e0;
        font-weight: 600;
        padding: 1rem 1.25rem;
        margin: 0.25rem 0.75rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .sb-sidenav .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102,126,234,0.2), transparent);
        transition: left 0.5s;
    }

    .sb-sidenav .nav-link:hover::before {
        left: 100%;
    }

    .sb-sidenav .nav-link:hover {
        background: linear-gradient(135deg, rgba(102,126,234,0.2) 0%, rgba(118,75,162,0.2) 100%);
        color: #ffffff;
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(102,126,234,0.3);
    }

    .sb-sidenav .nav-link.active,
    .sb-sidenav .nav-link[aria-expanded="true"] {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        box-shadow: 0 4px 20px rgba(102,126,234,0.4);
    }

    .sb-nav-link-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        margin-right: 0.75rem;
        transition: all 0.3s ease;
    }

    .sb-sidenav .nav-link:hover .sb-nav-link-icon {
        background: rgba(255,255,255,0.2);
        transform: rotate(5deg) scale(1.1);
    }

    .sb-nav-link-icon i {
        font-size: 1rem;
    }

    .sb-sidenav-collapse-arrow {
        transition: transform 0.3s ease;
    }

    .sb-sidenav .nav-link[aria-expanded="true"] .sb-sidenav-collapse-arrow {
        transform: rotate(180deg);
    }

    .sb-sidenav-menu-nested .nav-link {
        padding-left: 3rem;
        font-size: 0.9rem;
        margin: 0.15rem 0.75rem;
    }

    .sb-sidenav-menu-nested .nav-link::before {
        content: '▸';
        position: absolute;
        left: 2rem;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .sb-sidenav-menu-nested .nav-link:hover::before {
        opacity: 1;
        left: 2.25rem;
    }

    /* ================= FOOTER STYLES ================= */
    .sb-sidenav-footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #0f0f1e 100%);
        border-top: 2px solid rgba(102,126,234,0.3);
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .sb-sidenav-footer::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(102,126,234,0.1) 0%, transparent 70%);
        animation: footerGlow 8s ease-in-out infinite;
    }

    @keyframes footerGlow {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(-20px, 20px); }
    }

    .footer-user-info {
        flex: 1;
        position: relative;
        z-index: 2;
    }

    .footer-user-name {
        font-size: 0.9rem;
        color: #e0e0e0;
        margin-bottom: 0.25rem;
    }

    .footer-user-name .user-name {
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .footer-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(102,126,234,0.2);
        border: 1px solid rgba(102,126,234,0.4);
        border-radius: 20px;
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
        color: #c7d2fe;
        backdrop-filter: blur(10px);
    }

    .footer-role-badge i {
        color: #667eea;
    }

    .footer-avatar {
        position: relative;
        z-index: 2;
        border-radius: 50%;
        border: 3px solid rgba(102,126,234,0.5);
        box-shadow: 0 4px 15px rgba(102,126,234,0.3);
        animation: avatarFloat 3s ease-in-out infinite;
    }

    @keyframes avatarFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }

    .footer-avatar:hover {
        border-color: #667eea;
        transform: scale(1.1) rotate(5deg);
        transition: all 0.3s ease;
    }

    /* ================= SCROLLBAR ================= */
    .sb-sidenav-menu::-webkit-scrollbar {
        width: 8px;
    }

    .sb-sidenav-menu::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.2);
    }

    .sb-sidenav-menu::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }

    .sb-sidenav-menu::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #764ba2 0%, #667eea 100%);
    }

    /* ================= ACTIVE LINK INDICATOR ================= */
    .sb-sidenav .nav-link.active::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 70%;
        background: #ffffff;
        border-radius: 4px 0 0 4px;
        box-shadow: -2px 0 10px rgba(255,255,255,0.5);
    }
</style>

<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <!-- Home Section -->
            <div class="sb-sidenav-menu-heading">
                <i class="fas fa-home me-2"></i>Home
            </div>
            <a class="nav-link active" href="{{ url('admin/dashboard') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                Dashboard
            </a>

            <!-- Activity Section -->
            <div class="sb-sidenav-menu-heading">
                <i class="fas fa-bolt me-2"></i>Activity
            </div>

            <!-- Categories -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                Categories
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseCategory" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/categories/create') }}">
                        <i class="fas fa-plus-circle me-2"></i>Create Category
                    </a>
                    <a class="nav-link" href="{{ url('admin/categories') }}">
                        <i class="fas fa-list-ul me-2"></i>View Categories
                    </a>
                </nav>
            </div>

            <!-- Brands -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-award"></i>
                </div>
                Brands
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseProduct" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/brands/create') }}">
                        <i class="fas fa-plus-circle me-2"></i>Create Brand
                    </a>
                    <a class="nav-link" href="{{ url('admin/brands') }}">
                        <i class="fas fa-list-ul me-2"></i>View Brands
                    </a>
                </nav>
            </div>

            <!-- Products -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBrand">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                Products
                <div class="sb-sidenav-collapse-arrow">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </a>
            <div class="collapse" id="collapseBrand" data-bs-parent="#sidenavAccordion">
               <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/products/create') }}">
                        <i class="fas fa-plus-circle me-2"></i>Create Product
                    </a>
                    <a class="nav-link" href="{{ url('admin/products') }}">
                        <i class="fas fa-list-ul me-2"></i>View Products
                    </a>
                </nav>
            </div>

            <!-- Management Section -->
            <div class="sb-sidenav-menu-heading">
                <i class="fas fa-cog me-2"></i>Management
            </div>

            <!-- Accounts -->
            <a class="nav-link" href="{{ url('admin/accounts') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                User Accounts
            </a>

            <!-- Orders -->
            <a class="nav-link" href="{{ url('admin/orders') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                Orders
            </a>

            <!-- Pre-Orders -->
            <a class="nav-link" href="{{ route('admin.preorders.index') }}">
                <div class="sb-nav-link-icon">
                    <i class="fas fa-clock"></i>
                </div>
                Pre-Orders
            </a>

        </div>
    </div>

    <!-- Enhanced Footer -->
    <div class="sb-sidenav-footer">
        <div class="d-flex align-items-center justify-content-between">
            <div class="footer-user-info">
                <div class="footer-user-name">
                    <span class="text-muted small">Welcome,</span>
                    <div class="user-name">{{ Auth::user()->name ?? 'Guest' }}</div>
                </div>
                @auth
                    <div class="footer-role-badge mt-2">
                        <i class="fas fa-shield-alt"></i>
                        <span>{{ ucfirst(Auth::user()->role ?? 'user') }}</span>
                    </div>
                @else
                    <div class="footer-role-badge mt-2">
                        <i class="fas fa-user"></i>
                        <span>Guest</span>
                    </div>
                @endauth
            </div>
            <div>
                <img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExOHB1MzVhcHg2aDljaWIzdHh0NTBseml0MXo2eWdqemFqYmVuZTdiNSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/CK5gKBdBXdGtVv6AfG/giphy.gif" 
                     alt="Dancing Cat" 
                     class="footer-avatar"
                     width="55" 
                     height="55"/>
            </div>
        </div>
    </div>
</nav>