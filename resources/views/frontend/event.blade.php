@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{$event->banner_image}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Events</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-classic-content">
                        <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="#"><img src="{{$event->image}}" alt=""></a></figure>
                                    <div class="post-date"><h6>16<span>dec</span></h6></div>
                                </div>
                                <div class="lower-content">
                                    <h2><a href="{{url($event->slug)}}">{{$event->title}}</a></h2>
                                    <p>{!! $event->details !!}</p>
{{--                                    <div class="btn-box"><a href="{{url($event->slug)}}" class="theme-btn">view more</a></div>--}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="search-widget">
                            <form action="" method="post" class="search-form">
                                <div class="form-group">
                                    <input type="search" name="search-field" placeholder="Search" required>
                                    <button type="submit"><i class="flaticon-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h5>Recent Posts</h5>
                            </div>
                            <div class="post-inner">
                                @foreach($recentEvents as $recentEvent)
                                    <div class="post">
                                        <figure class="post-thumb"><a href="{{url($event->slug)}}"><img src="{{$recentEvent->image}}" alt=""></a></figure>
                                        <h6><a href="{{url($event->slug)}}">{{$event->title}}</a></h6>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->

@endsection
