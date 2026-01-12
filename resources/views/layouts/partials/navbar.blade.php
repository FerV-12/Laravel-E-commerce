<div class="sticky-top">

  <!-- TOP NAVBAR -->
  <div class="top-navbar">
    <div class="container py-1">
      <div class="row align-items-center">

        <!-- LEFT SIDE EMAIL + PHONE -->
        <div class="col-md-6 col-12">
          <ul class="list-group list-group-horizontal top-contact">
            <li>
              <i class="fa fa-envelope-o me-1"></i>
              <a href="mailto:goldentigershipping@gmail.com" class="top-nav-link">
                goldentigershipping@gmail.com
              </a>
            </li>
            <li>
              <i class="fa fa-phone me-1"></i>
              <a href="tel:+639102933079" class="top-nav-link">
                +63 910 293 3079
              </a>
            </li>
          </ul>
        </div>

        <!-- RIGHT SIDE SOCIALS -->
        <div class="col-md-6 text-md-end mt-2 mt-md-0">
          <ul class="list-group list-group-horizontal top-social">
            <li class="me-2">Follow Us:</li>
            <li><i class="fa fa-facebook"></i></li>
            <li><i class="fa fa-youtube"></i></li>
            <li><i class="fa fa-twitter"></i></li>
            <li><i class="fa fa-instagram"></i></li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <!-- MAIN NAVBAR -->
  <nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">

      <!-- LOGO -->
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('assets/images/GTLOGO.webp') }}" alt="Logo" class="brand-logo">
        <span class="brand-title">Golden Tiger Shipping Agencies</span>
      </a>

      <!-- TOGGLER -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- NAV LINKS -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">

          @auth
          <!-- USER DROPDOWN -->
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a href="{{ route('logout') }}" class="dropdown-item"
                     onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                  </a>
                </form>
              </li>
            </ul>
          </li>

          @else

          <!-- LOGIN / SIGNUP -->
          <li class="nav-item dropdown ms-3">
            <a class="nav-btn dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <i class="fa fa-sign-in me-1"></i> Login / Sign Up
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
              @if (Route::has('register'))
              <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
              @endif
            </ul>
          </li>

          @endauth
        </ul>

      </div>

    </div>
  </nav>

</div>
