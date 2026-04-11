@extends('frontend.layout.index')

@section('content')

    <style>

        .text ul li{
            list-style: disc !important;
        }
        
        .text ol li{
            list-style-type: inherit !important;
        }
        @media only screen and (max-width: 767px) {
            .sec-title h2 {
                font-size: 20px;
                line-height: 46px;
                text-align: justify;
            }

            .text p {
                font-size: 15pt !important;
                text-align: justify !important;
            }

            .text h2 {
                font-size: 26pt !important;
                text-align: justify;
            }

            .text h3 {
                font-size: 18pt !important;
                text-align: justify;
            }

            .text ul li{
                text-align: justify;
            }
        }
    </style>
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            {{-- <div class="parallax-inner back-img" style="background-image: url(assets/images/about/1.jpg);"></div> --}}
            <div class="parallax-inner back-img" style="background-image: url({{ asset($aboutUs->image) }});"></div>
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
                {{--                <div class="col-lg-6 col-md-12 col-sm-12 image-column"> --}}
                {{--                    <figure class="image-box"><img src="{{asset($aboutUs->image ?? 'assets/images/about/banner.jpg')}}" alt=""></figure> --}}
                {{--                    <figure class="image-box"><img src="{{asset($aboutUs->image)}}" alt=""></figure> --}}
                {{--                </div> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div class="content_block_three">
                        <div class="content-box">
                            <div class="sec-title">
                                <h2>{{ $aboutUs->title }}</h2>
                            </div>
                            <div class="text">
                                {{-- <div id="limited-text">
                                    {!!   Str::words($aboutUs->p1, 100, '...') !!}
                                </div> --}}
                                <div id="full-text" {{-- style="display: none;" --}}>
                                    {!! $aboutUs->p1 !!}
                                </div>
                                {{-- <button id="read-more-btn" class="theme-btn btn-one" onclick="toggleReadMore()">Read
                                    More
                                </button> --}}

                            </div>
                            <!-- <div class="btn-box">
                                                    <a href="index-2.html" class="theme-btn btn-one">discover more</a>
                                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text">
                <p>{!! $aboutUs->p2 !!}</p>

            </div>
        </div>
    </section>
    <!-- about-style-three end -->

    <!-- gallery-page-section -->
    {{-- <section class="gallery-page-section pt-0">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="sec-title">
                        <h2>all images</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/1.jpg" alt=""></figure>
                            <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                <a href="assets/images/about/1.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery">
                                    <i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Conservation Breeding Center
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/3.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/3.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Research Centre
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/4.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/4.jpg" class="lightbox-image  d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Research Laboratory
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/5.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/5.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Aerial View of Check Post in Conservation Breeding Centre
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/6.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/6.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        A typical Gopa in Cholistan Desert
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/7.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/7.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>

                                    <span class="text-heading text-center">
                                        Solar System in Conservation Breeding Centre
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    <!-- gallery-page-section end -->


    <!-- testimonial-section -->
    <!-- <section class="testimonial-section centred sec-pad bg-color-1">
                            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-6.png);"></div>
                            <div class="auto-container">
                                <div class="sec-title centred">
                                    <h2>What they’re <br />saying?</h2>
                                </div>
                                <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                                    <div class="testimonil-block-one">
                                        <div class="inner-box">
                                            <div class="author-thumb">
                                                <figure class="thumb-box"><img src="assets/images/resource/testimonial-1.jpg" alt=""></figure>
                                                <div class="quote"><i class="flaticon-quote"></i></div>
                                            </div>
                                            <div class="text">
                                                <p>I was impresed by the company services, lorem is simply free text used by copytyping no refreshing.  Neque porro est qui dolorem</p>
                                            </div>
                                            <div class="author-info">
                                                <h5>Christine Rose</h5>
                                                <span class="designation">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonil-block-one">
                                        <div class="inner-box">
                                            <div class="author-thumb">
                                                <figure class="thumb-box"><img src="assets/images/resource/testimonial-2.jpg" alt=""></figure>
                                                <div class="quote"><i class="flaticon-quote"></i></div>
                                            </div>
                                            <div class="text">
                                                <p>I was impresed by the company services, lorem is simply free text used by copytyping no refreshing.  Neque porro est qui dolorem</p>
                                            </div>
                                            <div class="author-info">
                                                <h5>Mike hardson</h5>
                                                <span class="designation">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="testimonil-block-one">
                                        <div class="inner-box">
                                            <div class="author-thumb">
                                                <figure class="thumb-box"><img src="assets/images/resource/testimonial-3.jpg" alt=""></figure>
                                                <div class="quote"><i class="flaticon-quote"></i></div>
                                            </div>
                                            <div class="text">
                                                <p>I was impresed by the company services, lorem is simply free text used by copytyping no refreshing.  Neque porro est qui dolorem</p>
                                            </div>
                                            <div class="author-info">
                                                <h5>sarah albert</h5>
                                                <span class="designation">Customer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> -->
    <!-- testimonial-section end -->


    <!-- video-section -->
    <!-- <section class="video-section centred">
                            <div class="img-wrap parallax-demo-1">
                                <div class="parallax-inner back-img" style="background-image: url(assets/images/background/video-bg.jpg);"></div>
                            </div>
                            <div class="auto-container">
                                <div class="inner-box">
                                    <div class="video-btn">
                                        <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption=""><i class="fas fa-play"></i></a>
                                    </div>
                                    <h2>ready to meet <br />wildlife animals</h2>
                                </div>
                            </div>
                        </section> -->
    <!-- video-section end -->


    <!-- clients-section -->
    <!-- <section class="clients-section alternat-2 border-bottom">
                            <div class="auto-container">
                                <div class="five-item-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
                                    <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-6.png" alt=""></a></figure>
                                    <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-7.png" alt=""></a></figure>
                                    <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-8.png" alt=""></a></figure>
                                    <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-9.png" alt=""></a></figure>
                                    <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-10.png" alt=""></a></figure>
                                </div>
                            </div>
                        </section> -->
    <!-- clients-section end -->



    {{--    @if ($galleries->isNotEmpty()) --}}
    {{--        <section class="gallery-page-section pt-0"> --}}
    {{--            <div class="auto-container"> --}}
    {{--                <div class="row clearfix"> --}}
    {{--                    <div class="col-md-12"> --}}
    {{--                        <div class="sec-title"> --}}
    {{--                            <h2>all images</h2> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                    @foreach ($galleries as $gallery) --}}
    {{--                        <div class="col-lg-4 col-md-6 col-sm-12 gallery-block"> --}}
    {{--                            <a> --}}
    {{--                                <div class="gallery-block-two"> --}}
    {{--                                    <div class="inner-box"> --}}
    {{--                                        <figure class="image-box"> --}}
    {{--                                            <a href="{{route('frontend.aboutus.gallery' , $gallery->id)}}"><img --}}
    {{--                                                    src="{{asset($gallery->image)}}" alt=""></a></figure> --}}
    {{--                                        --}}{{--                                <div class="view-box d-flex align-items-center flex-column justify-content-center"> --}}
    {{--                                        --}}{{--                                    <a href="{{asset($gallery->image)}}" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"> --}}
    {{--                                        --}}{{--                                        <i class="flaticon-plus-symbol"></i> --}}
    {{--                                        --}}{{--                                        <span class="text-heading text-center"> --}}
    {{--                                        --}}{{--                                            {{$gallery->title}} --}}
    {{--                                        --}}{{--                                        </span> --}}
    {{--                                        --}}{{--                                    </a> --}}
    {{--                                        --}}{{--                                </div> --}}
    {{--                                    </div> --}}
    {{--                                </div> --}}
    {{--                            </a> --}}
    {{--                            <div class="category-overlay"> --}}
    {{--                                <a href="{{route('frontend.aboutus.gallery' , $gallery->id)}}">{{$gallery->title}}</a> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                    @endforeach --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </section> --}}
    {{--    @endif --}}
    <!-- team-section -->
    @if (count($teams) > 0)
        <section class="team-section sec-pad">
            <div class="auto-container">
                <div class="sec-title centred">
                    <h2>Our Team </h2>
                </div>
                <div class="inner-content">
                    <div class="row clearfix">
                        @foreach ($teams as $team)
                            <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                                <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms"
                                    data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <figure class="image-box"><img src="{{ asset($team->image) }}" alt="">
                                        </figure>
                                        <div class="lower-content">
                                            <h3><a href="#">{{ $team->name }}</a>
                                                <span>{{ $team->designation }}</span>
                                            </h3>
                                            <p>{!! $team->details !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- team-section end -->

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
