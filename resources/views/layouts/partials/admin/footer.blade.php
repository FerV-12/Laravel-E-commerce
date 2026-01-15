 <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Fast Shopping Store 2026</div>
                            <div> 
                                <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                                &middot;
                                <a href="{{ url('/terms-and-conditions') }}">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>

{{-- Page specific scripts --}}
@yield('scripts')
</body>
</html>
