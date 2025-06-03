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

    <div class="set-direction-wrapper">


        @foreach($researchArticles as $key => $researchArticle)
            <section class="about-section sec-pad ainmal-sec setformobilechin">
                <div class="auto-container">
                    <div class="row clearfix">
                        @if($key%2==0)
                            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                <div class="image_block_one">
                                    <div class="image-box">
                                        <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                                        <figure class="image "><img src="{{asset($researchArticle->banner_image)}}" alt="" class="img-fluid"></figure>
                                        <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 content-column ps-5">
                                <div class="content_block_one">
                                    <div class="content-box ss">
                                        <div class="sec-title">
                                            <h2>{{$researchArticle->title}}</h2>
                                        </div>
                                        <div class="text">
                                            <p>{!! Str::words($researchArticle->description, 50, '...') !!}</p>
                                        </div>
                                        <div class="btn-box">
                                            <a href="{{route('frontend.researchArticle.FShow' , $researchArticle)}}" class="theme-btn btn-one">discover more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6 col-md-12 col-sm-12 content-column mt-5 pr-5">
                                <div class="content_block_one">
                                    <div class="content-box">
                                        <div class="sec-title">
                                            <h2>{{$researchArticle->title}}</h2>
                                        </div>
                                        <div class="text">
                                            <p>{!! Str::words($researchArticle->description, 50, '...') !!}</p>
                                        </div>
{{--                                        <div style="display: none;" id="full-text-modal">--}}
{{--                                            <div class="full-text-content">--}}
{{--                                                {!! $intro->description !!}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="btn-box">
                                            <a href="{{route('frontend.researchArticle.FShow' , $researchArticle)}}" class="theme-btn btn-one">discover more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                <div class="image_block_one">
                                    <div class="image-box">
                                        <div class="shape" style="background-image: url('assets/images/shape/shape-1.png');"></div>
                                        <figure class="image {{$researchArticle->title}}"><img src="{{asset($researchArticle->banner_image)}}" alt=""></figure>
                                        <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </section>
        @endforeach
    </div>
@endsection
