@extends('frontend.layout.index')

@section('content')
    <!-- Page Title -->
    <style>
        .video-layer {
            width: 100%;
            height: auto;
            background-color: black; /* or any fallback color */
        }

        .video-layer video {
            /*width: 100%;*/
            width: auto;
            height: 400px;
            display: block;
        }

        .customSlider-wrapper:first-child h2{
            display: none;
        }
        .banner-carousel .customSlider-wrapper .content-box{
            max-width: 85%;
        }
        .banner-carousel .customSlider-wrapper .content-box h2{
            font-size: 44px;
            line-height: 54px;
            margin-bottom: 0px;
        }
        .banner-carousel .customSlider-wrapper .content-box h3{
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .banner-carousel .customSlider-wrapper .content-box h4{
            margin-top: 10px;
            margin-bottom: 30px;
            color: #fff;
            font-weight: 500;
            font-size: 24px;
        }

    </style>


    @isset($sliders)
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            @foreach ($sliders as $slider)
                @if (!$slider->is_image)
                    <!-- If video exists, add video tag -->

                    {{--                        <div class="item-video" data-merge="1"><a class="owl-video" href="{{ $slider->image }}"></a></div> --}}
                    <div class="item-video" data-merge="1">
                        {{-- {{ dd(asset($slider->image)) }} --}}
                        <video autoplay muted loop controls>
                            <source src="{{ asset($slider->image) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    {{--                        <div class="video-layer"> --}}
                    {{--                            <video autoplay muted loop controls> --}}
                    {{--                                <source src="{{ $slider->image }}" --}}{{-- type="video/mp4" --}}{{-- > --}}
                    {{--                                Your browser does not support the video tag. --}}
                    {{--                            </video> --}}
                    {{--                        </div> --}}
                @else
                    <div class="slide-item">
                        <!-- If no video, fallback to image -->
                        <div class="image-layer" style="background-image:url({{ url($slider->image) }})"></div>
                        <div class="auto-container customSlider-wrapper">
                            <div class="content-box">
                                {{--                                    <h3 class="mb-4">{{ $slider->title }}</h3> --}}
                                <h2>{!! $slider->details !!}</h2>
                                {{-- <div class="btn-box">
                                    <a target="_blank" href="{{ $slider->slink }}" class="theme-btn btn-one">Discover
                                        More</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    @endisset
    <!-- End Page Title -->

    <!-- animals-page-section -->
    <section class="animals-page-section">
        <div class="auto-container">
            @isset($category)
                <div class="row clearfix pb-5">
                    <h6 class="section-title">{{ $category->name }}</h6>
                </div>
            @endisset
            <div class="row clearfix justify-content-end pb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex justify-content-end">
                        <div class="srch-wrap">
                            <form>
                                <input type="text" class="input" placeholder="search...">
                            </form>
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix" id="animal-list">
                @foreach ($animals as $animal)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ asset($animal->image) }}" alt="" />
                                </figure>
                                <div class="content-box">
                                    <h3><a
                                            href="{{ route('frontend.find.animal', $animal->slug) }}">{{ $animal->title }}</a>
                                    </h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a
                                            href="{{ route('frontend.find.animal', $animal->slug) }}">{{ $animal->title }}</a>
                                    </h3>
                                    <div class="link">
                                        <a href="{{ route('frontend.find.animal', $animal->slug) }}"><i
                                                class="flaticon-right-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (count($animals) == 0)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <h6>Animal Not Found</h6>
                    </div>
                @endif
            </div>

            <!-- Load More Button -->
            @if ($animals->hasMorePages())
                <div class="text-center" id="load-more-container">
                    <button id="load-more" data-page="1" class="theme-btn btn-one">Load More</button>
                </div>
            @endif
        </div>
    </section>
    <!-- animals-page-section end -->
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.banner-carousel').on('translated.owl.carousel', function(event) {
                $('video').each(function(){
                    $(this).get(0).pause();
                });
                var currentSlide = $('.owl-item.active').find('video');
                if(currentSlide.length){
                    currentSlide.get(0).play();
                }
            });
        });
        $(document).on('click', '#load-more', function() {
            let page = $(this).data('page');
            page += 1;

            $.ajax({
                url: '{{ route('frontend.listing.animal') }}',
                type: 'GET',
                data: {
                    page: page
                },
                success: function(response) {
                    $('#animal-list').append(response.html);

                    // Update the page count
                    $('#load-more').data('page', page);

                    // Check if there are more pages
                    if (!response.morePages) {
                        $('#load-more').hide(); // Hide the button when there are no more pages
                    }
                }
            });
        });
    </script>
@endpush
