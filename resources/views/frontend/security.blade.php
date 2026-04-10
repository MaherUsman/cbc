@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{asset($security->banner_image??'')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    {{--<li><a href="{{route('frontend.rearchArticle')}}">Research & Articles</a></li>--}}
                    <li>{{$security->title}}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- about-style-three -->
    <section class="about-style-three sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
               {{-- <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <figure class="image-box">
                        <img src="{{asset($security->banner_image)}}" alt="">
                    </figure>
                </div>--}}
                <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div class="content_block_three">
                        <div class="content-box">
                            {{--<div class="sec-title">
                                <h2>{{$security->title??''}}</h2>
                            </div>--}}
                            <div class="text">
                                <div id="limited-text">
                                    {!! $security->description??'' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- about-style-three end -->



    @if($security->galleries->isNotEmpty())
        <!-- gallery-page-section with "Load More" Button -->
        <section class="gallery-page-section pt-0 mt-5">
            <div class="auto-container">
                <div class="row clearfix" id="gallery-container">
                    @foreach($security->galleries as $gallery)
                        <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                            <div class="gallery-block-two">
                                <div class="inner-box">
                                    <figure class="image-box"><img src="{{asset($gallery->image??'')}}" alt=""></figure>
                                    <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                        <a href="{{asset($gallery->image??'')}}"
                                           class="lightbox-image d-flex justify-content-center align-items-center flex-column"
                                           data-fancybox="gallery"> {{$gallery->title??''}} <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
{{--                <div class="text-center mt-3">--}}
{{--                    <button id="load-more-btn" class="theme-btn btn-one">Load More</button>--}}
{{--                    <div id="loading-message" style="display: none;">Loading more images...</div>--}}
{{--                </div>--}}
            </div>
        </section>
        <!-- gallery-page-section end -->
    @endif

    <style type="text/css">
        .gallery-block-two .inner-box .image-box img {
            height: 100%;
        }
    </style>

@endsection

<script>
    function toggleReadMore() {
        const limitedText = document.getElementById('limited-text');
        const fullText = document.getElementById('full-text');
        const readMoreBtn = document.getElementById('read-more-btn');

        if (fullText.style.display === 'none') {
            // Show full text and hide limited text
            fullText.style.display = 'block';
            limitedText.style.display = 'none';
            readMoreBtn.innerText = 'Show Less';
        } else {
            // Show limited text and hide full text
            fullText.style.display = 'none';
            limitedText.style.display = 'block';
            readMoreBtn.innerText = 'Read More';
        }
    }
</script>
