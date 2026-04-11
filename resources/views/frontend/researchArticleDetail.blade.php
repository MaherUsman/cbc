@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{asset($researchArticle->banner_image??'')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
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
                        <img src="{{asset($researchArticle->banner_image)}}" alt="">
                    </figure>
                </div>--}}
                <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div class="content_block_three">
                        <div class="content-box">
                            {{--<div class="sec-title">
                                <h2>{{$researchArticle->title??''}}</h2>
                            </div>--}}
                            <div class="text">
                                <div id="limited-text">
                                    {!! $researchArticle->description??'' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- about-style-three end -->



{{--    @if($researchArticle->galleries->isNotEmpty())--}}
{{--        <section class="gallery-page-section pt-0">--}}
{{--            <div class="auto-container">--}}
{{--                <div class="row clearfix">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="sec-title">--}}
{{--                            <h2>all images</h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @foreach($researchArticle->galleries as $gallery)--}}
{{--                        <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">--}}
{{--                            <a>--}}
{{--                                <div class="gallery-block-two">--}}
{{--                                    <div class="inner-box">--}}
{{--                                        <figure class="image-box">--}}
{{--                                                <img src="{{asset($gallery->image??'')}}" alt="">--}}
{{--                                        </figure>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                            <div class="category-overlay">--}}
{{--                               {{$gallery->title??''}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}

    @if($researchArticle->galleries->isNotEmpty())
        <!-- gallery-page-section with "Load More" Button -->
        <section class="gallery-page-section pt-0 mt-5">
            <div class="auto-container">
                <div class="row clearfix" id="gallery-container">
                    @foreach($researchArticle->galleries as $gallery)
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
            </div>
        </section>
    @endif

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
