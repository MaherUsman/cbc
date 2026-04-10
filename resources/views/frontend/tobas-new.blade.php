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

        .gallery-block-two .inner-box .image-box img {
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
            <div class="parallax-inner back-img" style="background-image: url({{ asset($data->banner_image ?? $data->image ?? '') }});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>{{ $data->title ?? 'Hydration' }}</li>
                </ul>
                <div class="title">
                    <h1>{{ $data->title ?? 'Hydration' }}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    @if (!empty($data->description))
        <section class="sec-pad pt-5 pb-0">
            <div class="auto-container">
                {!! $data->description !!}
            </div>
        </section>
    @endif


    <!-- about-style-three -->
    @if(false)
        <section class="about-style-three sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    {{-- <div class="col-lg-6 col-md-12 col-sm-12 image-column"> --}}
                        {{-- <figure class="image-box"> --}}
                            {{-- <img src="{{asset('assets/images/background/page-title.jpg')}}" alt=""> --}}
                            {{-- </figure> --}}
                        {{-- </div> --}}

                    {{-- <div class="col-lg-12 col-md-12 col-sm-12 content-column"> --}}
                        {{-- <div class="content_block_three"> --}}
                            {{-- <div class="content-box"> --}}
                                {{-- <div class="sec-title"> --}}
                                    {{-- <h2>{{$data->title??''}}</h2> --}}
                                    {{-- </div> --}}
                                {{-- <div class="text"> --}}
                                    {{-- <div id="limited-text"> --}}
                                        {{-- {!! $data->description??'' !!} --}}
                                        {{-- </div> --}}

                                    {{-- <div id="full-text" style="display: none;"> --}}
                                        {{-- {!! $data->description !!} --}}
                                        {{-- </div> --}}
                                    {{-- <button id="read-more-btn" class="theme-btn btn-one" onclick="toggleReadMore()">Read
                                        --}}
                                        {{-- More --}}
                                        {{-- </button> --}}

                                    {{-- </div> --}}
                                {{--
                                <!-- <div class="btn-box"> --}}
                                                                                                {{--                                <a href="index-2.html" class="theme-btn btn-one">discover more</a> --}}
                                                                                                {{--                            </div> -->
                                --}}
                                {{--
                            </div> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}
                </div>

            </div>
        </section>
    @endif
    <!-- about-style-three end -->



    {{-- @if ($tobaGalleries->isNotEmpty()) --}}
    {{-- <section class="gallery-page-section pt-0"> --}}
        {{-- <div class="auto-container"> --}}
            {{-- <div class="row clearfix"> --}}
                {{-- <div class="col-md-12"> --}}
                    {{-- <div class="sec-title"> --}}
                        {{-- <h2>all images</h2> --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                {{-- @foreach ($tobaGalleries as $tobaGallery) --}}
                {{-- <div class="col-lg-4 col-md-6 col-sm-12 gallery-block"> --}}
                    {{-- <a> --}}
                        {{-- <div class="gallery-block-two"> --}}
                            {{-- <div class="inner-box"> --}}
                                {{-- <figure class="image-box"> --}}
                                    {{-- <a href="{{route('frontend.tobas.gallery' , ['tobasGallery'=>$tobaGallery])}}">
                                        --}}
                                        {{-- <img src="{{asset($tobaGallery->image??'')}}" alt=""></a></figure> --}}

                                {{-- </div> --}}
                            {{-- </div> --}}
                        {{-- </a> --}}
                    {{-- <div class="category-overlay"> --}}
                        {{-- <a
                            href="{{route('frontend.tobas.gallery' , ['tobasGallery'=>$tobaGallery])}}">{{$tobaGallery->title??''}}</a>
                        --}}
                        {{-- </div> --}}
                    {{-- </div> --}}
                {{-- @endforeach --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </section> --}}
    {{-- @endif --}}

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

    <!-- bottom-image-section -->
    <section class="bottom-image-section pb-5" style="height: fit-content;">
        <div class="auto-container">
            <div class="image-box text-center">
                <img src="{{ asset('assets/images/Hydration/cbc_map.jpg') }}" alt="Hydration Map" class="img-fluid"
                    style="width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); object-fit: contain; max-height: 800px;">
            </div>
        </div>
    </section>
    <!-- bottom-image-section end -->

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