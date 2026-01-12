@extends('layouts.frontend')

@section('content')

<!-- VIDEO HEADER -->
<div class="video-header">
    <video class="video-bg" autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/ecomvid.mp4') }}" type="video/mp4">
    </video>

    <!-- DARK OVERLAY -->
    <div class="video-overlay"></div>

</div>

@endsection
