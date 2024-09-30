@extends('frontend.layout.index')
@section('content')
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url(assets/images/background/page-title.jpg);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>404</li>
                </ul>
                <div class="title">
                    <h1>404</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- error-section -->
    <section class="error-section centred">
        <div class="auto-container">
            <div class="inner-box">
                <h1>404</h1>
                <h2>page is not found. <br />the page is doesn’t exist or deleted</h2>
                <a href="index.html" class="theme-btn btn-one">Go To Home</a>
            </div>
        </div>
    </section>
    <!-- error-section end -->
@endsection
