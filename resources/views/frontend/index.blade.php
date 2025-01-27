@extends('frontend.layout.index')

@section('content')
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

    <!-- banner-section -->
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            @foreach($sliders as $slider)

                @if(!$slider->is_image)
                    <!-- If video exists, add video tag -->

{{--                        <div class="item-video" data-merge="1"><a class="owl-video" href="{{ $slider->image }}"></a></div>--}}
                        <div class="item-video" data-merge="1">
                            <video autoplay muted loop controls>
                                <source src="{{ asset($slider->image) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
{{--                        <div class="video-layer">--}}
{{--                            <video autoplay muted loop controls>--}}
{{--                                <source src="{{ $slider->image }}" --}}{{--type="video/mp4"--}}{{-->--}}
{{--                                Your browser does not support the video tag.--}}
{{--                            </video>--}}
{{--                        </div>--}}
                @else
                        <div class="slide-item">
                    <!-- If no video, fallback to image -->
                        <div class="image-layer" style="background-image:url({{ $slider->image }})"></div>
                            <div class="auto-container customSlider-wrapper">
                                <div class="content-box">
{{--                                    <h3 class="mb-4">{{ $slider->title }}</h3>--}}
                                    <h2>{!! $slider->details !!}</h2>
                                    <div class="btn-box">
                                        <a target="_blank" href="{{ $slider->slink }}" class="theme-btn btn-one">Discover More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


            @endforeach
        </div>
    </section>
    <!-- banner-section end -->

    <!-- info-section -->
    <section class="info-section">
        <div class="bg-layer"></div>
        <div class="auto-container">
            <div class="inner-container introtext">
                <div class="row clearfix">
                    <div class="col-lg-3">
                        <div class="highness-img">
                            <img src="{{ asset($intro->image) }}" />
                        </div>
                    </div>
                    <div class="col-lg-9 highness-text">
                        <div class="sec-title mb-2">
                            <h2>{{ $intro->title }}</h2>
                        </div>

                        <?php
                        // Set the character limit
                        $charLimit = 1000;

                        // Check if the content length exceeds the character limit
                        $introDetails = strip_tags($intro->details); // Remove HTML tags for accurate character counting
                        if (strlen($introDetails) > $charLimit) {
                            // If the content exceeds the limit, display a truncated version with a "Show More" button
                            $shortDetails = substr($introDetails, 0, $charLimit) . '...';
                            echo '<p class="highness-text short-text">' . $shortDetails . ' <span><a href="javascript:void(0)" class="btn p-0 show-more">Show More</a></span></p>';

                            echo '<div style="display:none" class="highness-text full-text" id="full-text-modal">
        <p>'.$intro->details.' <span><a href="javascript:void(0)" class="btn p-0 show-less">Show Less</a></span></p>
    </div>';
                        } else {
                            // If the content is within the limit, display the full content
                            echo '<p class="highness-text">' . $intro->details . '</p>';
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- Full Text Modal -->
    <div style="display:none" id="full-text-modal">
        <p>{!! $intro->details !!}</p>
    </div>


    <!-- info-section end -->






    <!-- Chincara-section -->
     <div class="set-direction-wrapper">


    @foreach($animals as $key => $animal)
        <section class="about-section sec-pad ainmal-sec setformobilechin">
            <div class="auto-container">
                <div class="row clearfix">
                    @if($key%2==0)
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_one">
                            <div class="image-box">
                                <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                                <figure class="image "><img src="{{asset($animal->home_image)}}" alt="" class="img-fluid"></figure>
                                <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column ps-5">
                        <div class="content_block_one">
                            <div class="content-box ss">
                                <div class="sec-title">
                                    <h2>{{$animal->title}}</h2>
                                </div>
                                <div class="text">
                                    <p>{!! Str::words($animal->details, 100, '...') !!}</p>
                                </div>
                                <div class="btn-box">
                                    <a href="{{route('frontend.find.animal' , $animal->slug)}}" class="theme-btn btn-one">discover more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column mt-5 pr-5">
                        <div class="content_block_one">
                            <div class="content-box">
                                <div class="sec-title">
                                    <h2>{{$animal->title}}</h2>
                                </div>
                                <div class="text">
                                    <p>{!! Str::words($animal->details, 100, '...') !!}</p>
                                </div>
                                <div style="display: none;" id="full-text-modal">
                                    <div class="full-text-content">
                                        {!! $intro->details !!}
                                    </div>
                                </div>
                                <div class="btn-box">
                                    <a href="{{route('frontend.find.animal' , $animal->slug)}}" class="theme-btn btn-one">discover more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                            <div class="image_block_one">
                                <div class="image-box">
                                    <div class="shape" style="background-image: url('assets/images/shape/shape-1.png');"></div>
                                    <figure class="image {{$animal->title}}"><img src="{{asset($animal->home_image)}}" alt=""></figure>
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
    <!-- gallery-section -->
    <section class="gallery-section">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>{{$setting->home_page_title}}</h2>
            </div>
        </div>
        <div class="outer-container">
            <div class="gallery-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                @foreach($amazing_animals as $amazing_animal)
                    <div class="gallery-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{asset($amazing_animal->home_image)}}" alt=""></figure>
                            <div class="content-box">
                                <h3><a href="{{route('frontend.find.animal' , $amazing_animal->slug)}}">{{$amazing_animal->title}}</a></h3>
                            </div>
                            <div class="overlay-content">
                                <h3><a href="{{route('frontend.find.animal' , $amazing_animal->slug)}}">{{$amazing_animal->title}}</a></h3>
                                <div class="link"><a href="{{route('frontend.find.animal' , $amazing_animal->slug)}}"><i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

        <div class="btn-box d-flex justify-content-center align-items-center mt-5 mb-4">
            <a href="{{route('frontend.listing.animal')}}" class="theme-btn btn-one">discover more</a>
        </div>
    </section>
    <!-- gallery-section end -->

    @if($events->count() > 0)
    <!-- events-section -->
    <section class="events-section sec-pad mt-5">
        <div class="bg-layer"></div>
        <div class="bg-image" style="background-image: url(assets/images/background/events-bg.jpg);"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 title-column">
                    <div class="sec-title light">
                        <h2>Check zoo upcoming events</h2>
                        <a href="{{route('frontend.events.index')}}" class="theme-btn btn-one">view all</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                    <div class="inner-content">
                        @foreach($events as $event)
                            <div class="events-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{asset($event->image)}}" alt=""></figure>
                                        <div class="post-date">    <h6>{{ \Carbon\Carbon::parse($event->start_date)->format('j M') }}</h6>
                                        </div>
                                    </div>
                                    <div class="inner">
                                        <ul class="info clearfix">
                                            <li><i class="far fa-clock"></i>{{\Carbon\Carbon::parse($event->time)->format('H:i a')}}</li>
                                            <li><i class="far fa-map"></i>{{$event->address}}</li>
                                        </ul>
                                        <h3><a href="{{route('frontend.find.event' , $event->slug)}}">{{$event->title}}</a></h3>
                                        <p>{!! $event->details !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- events-section end -->


    <!-- funfact-section -->
    <section class="funfact-section mt-5">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url(assets/images/background/funfact-bg.jpg);"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                @if (isset($homeCounter['home_count']))

                @foreach($homeCounter['home_count'] as $index => $count)
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="{{ $homeCounter['icon_class'][$index] }}"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" >{{ $count }}</span>
                            </div>
                            <p>{{ $homeCounter['home_counter_name'][$index] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
                @endif


            </div>
        </div>
    </section>


    <!-- news-section -->
    <!-- <section class="news-section centred">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>Latest news & <br />Articles</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="event-details.html"><img src="assets/images/news/news-1.jpg" alt=""></a></figure>
                                <div class="post-date"><h6>16<span>dec</span></h6></div>
                            </div>
                            <div class="lower-content">
                                <ul class="post-info clearfix">
                                    <li><i class="far fa-user-circle"></i><a href="event-details.html">Admin</a></li>
                                    <li><i class="far fa-comments"></i><a href="event-details.html">2 Comments</a></li>
                                </ul>
                                <h3><a href="event-details.html">how Interaction with Animal can Release</a></h3>
                                <div class="link"><a href="event-details.html"><i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="event-details.html"><img src="assets/images/news/news-2.jpg" alt=""></a></figure>
                                <div class="post-date"><h6>15<span>dec</span></h6></div>
                            </div>
                            <div class="lower-content">
                                <ul class="post-info clearfix">
                                    <li><i class="far fa-user-circle"></i><a href="event-details.html">Admin</a></li>
                                    <li><i class="far fa-comments"></i><a href="event-details.html">3 Comments</a></li>
                                </ul>
                                <h3><a href="event-details.html">Donec eget condimentum sapien</a></h3>
                                <div class="link"><a href="event-details.html"><i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="event-details.html"><img src="assets/images/news/news-3.jpg" alt=""></a></figure>
                                <div class="post-date"><h6>14<span>dec</span></h6></div>
                            </div>
                            <div class="lower-content">
                                <ul class="post-info clearfix">
                                    <li><i class="far fa-user-circle"></i><a href="event-details.html">Admin</a></li>
                                    <li><i class="far fa-comments"></i><a href="event-details.html">0 Comments</a></li>
                                </ul>
                                <h3><a href="event-details.html">Etiam vel porttitor mi convallis</a></h3>
                                <div class="link"><a href="event-details.html"><i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- news-section end -->

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



            // Ensure full content is hidden initially
            const fullText = document.querySelector('.full-text');
            const shortText = document.querySelector('.short-text');
            const scrollTarget = document.querySelector('.introtext'); // The class you want to scroll to

            // Only attach event listeners if full content exists
            if (fullText && shortText) {
                fullText.style.display = 'none'; // Hide full content initially

                // Show more link functionality
                document.querySelector('.show-more').addEventListener('click', function() {
                    shortText.style.display = 'none';  // Hide short text
                    fullText.style.display = 'block';  // Show full text
                });

                // Show less link functionality
                document.querySelector('.show-less').addEventListener('click', function() {
                    fullText.style.display = 'none';   // Hide full text
                    shortText.style.display = 'block'; // Show short text

                    // Scroll back to the top of the highness-text section
                    scrollTarget.scrollIntoView({
                        behavior: 'smooth' // Smooth scroll back to the highness-text class
                    });
                });
            }
        });
    </script>


@endpush
