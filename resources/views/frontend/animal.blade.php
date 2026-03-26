@extends('frontend.layout.index')

@section('content')
    <style>
        .banner-carousel .slide-item:before {
            content: unset;
        }

        .banner-carousel .slide-item {
            padding: unset;
            height: 650px;
        }

        .banner-section {
            margin-top: 168px;
        }

        .gallery-block-two {
            height: 100%;
        }

        .inner-box {
            height: 100%;
        }

        .image-box {
            height: 270px;
        }

        .gallery-block-two .inner-box .image-box img {
            height: 100%;
            object-fit: cover;
        }

        .img-caption-txt {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 0px 5px 5px 5px;
        }
    </style>

    <!-- banner-section -->
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            @foreach ($animal->animalSliders as $slider)
                <div class="slide-item">
                    <div class="image-layer" style="background-image:url({{ asset($slider->image) }})"></div>
                    <div class="auto-container">
                        <div class="content-box">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- banner-section end -->

    <!-- Page Title -->
    {{--   <section class="page-title"> --}}
    {{--        <div class="img-wrap parallax-demo-1"> --}}
    {{--            <div class="parallax-inner back-img chinkara-img" style="background-image: url({{asset($animal->banner_image)}});"> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--        <div class="auto-container"> --}}
    {{--            <div class="content-box"> --}}
    {{--                <div class="title"> --}}
    {{--                    <h1>{{$animal->title}}</h1> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </div> --}}
    {{--    </section> --}}
    <!-- End Page Title -->

    <!-- animals-details -->
    <section class="animals-details">
        <div class="auto-container">
            <div class="animals-details-content">
                {{-- <figure class="image-box"><img src="{{asset($animal->image)}}" alt=""></figure> --}}
                <div class="content-box">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                            <div class="text">
                                <div class="animal-title">
                                    <h2>{{ $animal->title }}</h2>
                                </div>
                                <div class="animals-description">
                                    @if(empty(trim(strip_tags($animal->details))) || trim(strip_tags($animal->details)) === '&nbsp;')
                                        <p><strong>[Dummy Content]:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    @else
                                        <p>{!! $animal->details !!}</p>
                                    @endif
                                </div>
                                {{--                                <div class="animals-description"> --}}
                                {{--                                    <p>{!! $animal->details !!}</p> --}}
                                {{--                                </div> --}}
                            </div>
                        </div>
                        {{--                        <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side"> --}}
                        {{--                            <div class="sidebar-content"> --}}
                        {{--                                @foreach ($animal->animalProps as $animalProps) --}}
                        {{--                                    <div class="single-item"> --}}
                        {{--                                        <h5>{{$animalProps->title}}</h5> --}}
                        {{--                                        <p>{{$animalProps->details}}</p> --}}
                        {{--                                    </div> --}}
                        {{--                                @endforeach --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- animals-details end -->

    <!-- gallery-page-section with "Load More" Button -->
    <section class="gallery-page-section pt-0 mt-5">
        <div class="auto-container">
            <div class="row clearfix" id="gallery-container">
                <!-- Initial Gallery Images -->
                @foreach ($animal->animalGalleries->take(10) as $animalGallery)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-two">
                            <div class="inner-box">
                                {{-- <figure class="image-box">
                                    <img src="{{ asset($animalGallery->thumb) }}" alt="">
                                </figure> --}}
                                <div class="image-box">
                                    <img src="{{ asset($animalGallery->thumb) }}" alt="">
                                </div>
                                @if ($animalGallery->title)
                                    <div class="text-center mt-2">
                                        <p class="mb-0 fw-semibold img-caption-txt">
                                            {{ $animalGallery->title }}
                                        </p>
                                    </div>
                                @endif
                                <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                    <a href="{{ asset($animalGallery->image) }}"
                                        class="lightbox-image d-flex justify-content-center align-items-center flex-column"
                                        data-caption="{{ $animalGallery->title ? $animalGallery->title : '' }}"
                                        data-fancybox="gallery"> <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3">
                <button id="load-more-btn" class="theme-btn btn-one">Load More</button>
                <div id="loading-message" style="display: none;">Loading more images...</div>
            </div>
        </div>
    </section>
    <!-- gallery-page-section end -->

    <style type="text/css">
        .gallery-block-two .inner-box .image-box img {
            height: 100%;
        }
    </style>


    <!-- animals-section -->
    <section class="animals-section sec-pad">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>Visit these <br />species also</h2>
            </div>
            <div class="row clearfix">
                @foreach ($relatedAnimals as $relatedAnimal)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-one">
                            <div class="inner-box">
                                {{-- <figure class="image-box"><img src="{{asset($relatedAnimal->image)}}" alt=""></figure> --}}
                                <figure class="image-box"><img src="{{ asset($relatedAnimal->home_image) }}" alt="">
                                </figure>
                                <div class="content-box">
                                    <h3><a
                                            href="{{ route('frontend.find.animal', $relatedAnimal->slug) }}">{{ $relatedAnimal->title }}</a>
                                    </h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a
                                            href="{{ route('frontend.find.animal', $relatedAnimal->slug) }}">{{ $relatedAnimal->title }}</a>
                                    </h3>
                                    <div class="link"><a
                                            href="{{ route('frontend.find.animal', $relatedAnimal->slug) }}"><i
                                                class="flaticon-right-arrow"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="btn-box d-flex justify-content-center align-items-center mt-5">
            <a href="{{ route('frontend.listing.animal') }}" class="theme-btn btn-one">discover more</a>
        </div>
    </section>
    <!-- animals-section end -->

    <!-- Load More Button JavaScript -->
    <script>
        let page = 2;
        const slug = "{{ $animal->slug }}";

        document.getElementById('load-more-btn').addEventListener('click', function() {
            const loadingMessage = document.getElementById('loading-message');
            loadingMessage.style.display = 'block';
            let assetPath = "{{ asset('/') }}"

            fetch(`/loadmore/${slug}/animals?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data.length > 0) {
                        const galleryContainer = document.getElementById('gallery-container');
                        data.data.forEach(gallery => {
                            console.log(gallery, 'gallery name')
                            const galleryBlock = document.createElement('div');
                            galleryBlock.classList.add('col-lg-4', 'col-md-6', 'col-sm-12',
                                'gallery-block');
                            galleryBlock.innerHTML = `
                            <div class="gallery-block-two">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <img src="${assetPath}/${gallery.thumb}" alt="">
                                    </div>

                                    <div class="text-center mt-2">
                                        <p class="mb-0 fw-semibold img-caption-txt">
                                            ${ gallery.title }
                                        </p>
                                    </div>

                        <div class="view-box d-flex align-items-center flex-column justify-content-center">
                            <a href="${assetPath}/${gallery.compressed}"
                                            class="lightbox-image d-flex justify-content-center align-items-center flex-column"
                                            data-fancybox="gallery">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `;
                            galleryContainer.appendChild(galleryBlock);
                        });
                        page++;
                        loadingMessage.style.display = 'none';
                    } else {
                        loadingMessage.innerText = 'No more images to load';
                        document.getElementById('load-more-btn').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error loading more images:', error));
        });
    </script>
@endsection
