@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{asset('assets/images/background/page-title.jpg')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Research & Articles</li>
                </ul>
                <div class="title">
                    <h1>Research & Articles</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


@endsection
