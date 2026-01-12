    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'GTS') }}</title>

            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
            <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
            <style>
                /* When there is no sidebar, remove the left padding reserved by admin CSS */
                .no-sidenav #layoutSidenav #layoutSidenav_content {
                    padding-left: 0 !important;
                    margin-left: 0 !important;
                }
                .no-sidenav .sb-topnav {
                    top: 0; /* keep topnav positioned normally */
                }
            </style>
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
            
        </head>
        <body class="sb-nav-fixed @if(!(Auth::user() && Auth::user()->role === 'admin')) no-sidenav @endif">
            
            @include('layouts.partials.user.navbar')
            <div id="layoutSidenav">
                @if(Auth::user() && Auth::user()->role === 'admin')
                <div id="layoutSidenav_nav">
                    @include('layouts.partials.user.sidebar')
                </div>
                @endif
                <div id="layoutSidenav_content">
                    <main>
                        @php
                            // Use a centered fixed-width container for regular users (no sidebar),
                            // and fluid container when admin (sidebar present).
                            $contentClass = (Auth::user() && Auth::user()->role === 'admin')
                                ? 'container-fluid px-4'
                                : 'container py-4';
                        @endphp
                        <div class="{{ $contentClass }}">

                            @yield('content')
                            
                        </div>
                    </main>
                    @include('layouts.partials.user.footer')
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
            
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
            <script src="{{ asset('assets/admin/js/datatables-simple-demo.js') }}"></script>
        </body>
    </html>