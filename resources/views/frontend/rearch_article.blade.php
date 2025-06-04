@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img"
                 style="background-image: url({{asset('assets/images/background/page-title.jpg')}});"></div>
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
                        <div class="auto-container">
        <div class="row clearfix pt-2" id="animal-list">
            @foreach($researchArticles as $key => $researchArticle)
                {{--            <section class="about-section sec-pad ainmal-sec setformobilechin">--}}

                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ asset($researchArticle->banner_image) }}" alt=""/>
                            </figure>
                            <div class="content-box">
                                <h3><a
                                        href="{{ route('frontend.researchArticle.FShow', $researchArticle) }}">{{ $researchArticle->title }}</a>
                                </h3>
                            </div>
                            <div class="overlay-content">
                                <h3><a
                                        href="{{ route('frontend.researchArticle.FShow', $researchArticle) }}">{{ $researchArticle->title }}</a>
                                </h3>
                                <div class="link">
                                    <a href="{{ route('frontend.researchArticle.FShow', $researchArticle) }}"><i
                                            class="flaticon-right-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--            </section>--}}
            @endforeach
        </div>
                        </div>
    </div>
@endsection
