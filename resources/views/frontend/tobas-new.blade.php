@extends('frontend.layout.index')

@section('content')

    <style>
        .gallery-block-two {
            height: 270px;
        }

        .inner-box,
        .image-box {
            height: 100%;
        }

        .gallery-block-two .inner-box .image-box img{
            height: 100% !important;
            object-fit: cover;
        }

        @media (max-width: 767px) {
            .gallery-block-two {
                height: auto;
            }
        }
    </style>

    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{ asset($data->image ?? '') }});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Hydration</li>
                </ul>
                <div class="title">
                    <h1>Hydration</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <section class="sec-pad pt-5 pb-0">
        <div class="auto-container">
            <p style="text-align: center;"><strong>[Dummy Content]:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </section>


    <!-- about-style-three -->
    @if(false)
    <section class="about-style-three sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                {{--                <div class="col-lg-6 col-md-12 col-sm-12 image-column"> --}}
                {{--                    <figure class="image-box"> --}}
                {{--                        <img src="{{asset('assets/images/background/page-title.jpg')}}" alt=""> --}}
                {{--                    </figure> --}}
                {{--                </div> --}}

                {{--                <div class="col-lg-12 col-md-12 col-sm-12 content-column"> --}}
                {{--                    <div class="content_block_three"> --}}
                {{--                        <div class="content-box"> --}}
                {{--                            <div class="sec-title"> --}}
                {{--                                <h2>{{$data->title??''}}</h2> --}}
                {{--                            </div> --}}
                {{--                            <div class="text"> --}}
                {{--                                <div id="limited-text"> --}}
                {{--                                    {!! $data->description??'' !!} --}}
                {{--                                </div> --}}

                {{--                                <div id="full-text" style="display: none;"> --}}
                {{--                                    {!! $data->description !!} --}}
                {{--                                </div> --}}
                {{--                                <button id="read-more-btn" class="theme-btn btn-one" onclick="toggleReadMore()">Read --}}
                {{--                                    More --}}
                {{--                                </button> --}}

                {{--                            </div> --}}
                {{--                            <!-- <div class="btn-box"> --}}
                {{--                                <a href="index-2.html" class="theme-btn btn-one">discover more</a> --}}
                {{--                            </div> --> --}}
                {{--                        </div> --}}
                {{--                    </div> --}}
                {{--                </div> --}}
            </div>

        </div>
    </section>
    @endif
    <!-- about-style-three end -->



    {{--    @if ($tobaGalleries->isNotEmpty()) --}}
    {{--        <section class="gallery-page-section pt-0"> --}}
    {{--            <div class="auto-container"> --}}
    {{--                <div class="row clearfix"> --}}
    {{--                    <div class="col-md-12"> --}}
    {{--                        <div class="sec-title"> --}}
    {{--                            <h2>all images</h2> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                    @foreach ($tobaGalleries as $tobaGallery) --}}
    {{--                        <div class="col-lg-4 col-md-6 col-sm-12 gallery-block"> --}}
    {{--                            <a> --}}
    {{--                                <div class="gallery-block-two"> --}}
    {{--                                    <div class="inner-box"> --}}
    {{--                                        <figure class="image-box"> --}}
    {{--                                            <a href="{{route('frontend.tobas.gallery' , ['tobasGallery'=>$tobaGallery])}}"> --}}
    {{--                                                <img src="{{asset($tobaGallery->image??'')}}" alt=""></a></figure> --}}

    {{--                                    </div> --}}
    {{--                                </div> --}}
    {{--                            </a> --}}
    {{--                            <div class="category-overlay"> --}}
    {{--                                <a href="{{route('frontend.tobas.gallery' , ['tobasGallery'=>$tobaGallery])}}">{{$tobaGallery->title??''}}</a> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                    @endforeach --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </section> --}}
    {{--    @endif --}}

    @if ($tobaGalleries->isNotEmpty())
        <!-- gallery-page-section -->
        <section class="gallery-page-section">
            <div class="auto-container">
                <div class="row clearfix" id="gallery-items">
                    @foreach ($tobaGalleries as $gallery)
                        <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                            <div class="gallery-block-two">
                                <div class="inner-box">
                                    {{-- <figure class="image-box">
                                        <img src="{{ asset($gallery->image) }}" alt="">
                                    </figure> --}}
                                    <div class="image-box">
                                        <img src="{{ asset($gallery->image) }}" alt="">
                                    </div>
                                    <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                        <a href="{{ asset($gallery->image) }}"
                                            class="lightbox-image d-flex justify-content-center align-items-center flex-column"
                                            data-fancybox="gallery">
                                            <i class="fa fa-eye"></i>
                                            <span class="text-heading text-center">{{ $gallery->title }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- gallery-page-section end -->
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
