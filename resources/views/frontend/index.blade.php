@extends('layouts.frontend')

@section('content')

<!-- VIDEO HEADER -->

<div class="video-header" style="
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
">

    <!-- DARK OVERLAY -->
    <!-- <div class="video-overlay" style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Adjust for desired darkness */
        z-index: 1;
    "></div> -->

    <video class="video-bg" autoplay muted loop playsinline>
        <source src="{{ asset('assets/images/ecomvid.mp4') }}" type="video/mp4">
    </video>

  
    <style>

        .video-bg {

            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover; /* This is the key property */
            transform: translateX(-50%) translateY(-50%);
            z-index: 0;
        }
    </style>
</div>

 @endsection
