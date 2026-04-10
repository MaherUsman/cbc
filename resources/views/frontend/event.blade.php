@extends('frontend.layout.index')

@section('content')

<style type="text/css">
    .gallery-block-two .inner-box .image-box img{
        height: 100%;
    }
</style>


    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{asset($event->banner_image)}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container">
        <div class="auto-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                        <div class="blog-classic-content">
                            <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a href="#"><img src="{{asset($event->image ?? 'assets/images/available.png')}}" alt=""></a></figure>


                                        <div class="post-date"><h6>{{ \Carbon\Carbon::parse($event->start_date)->format('j M') }}</h6></div>
                                    </div>
                                    <div class="lower-content">
                                        <h2><a href="{{ route('frontend.find.event',$event->slug) }}">{{$event->title}}</a></h2>
                                        <p>{!! $event->details !!}</p>
                                        {{--                                    <div class="btn-box"><a href="{{url($event->slug)}}" class="theme-btn">view more</a></div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- gallery-page-section with "Load More" Button -->
                    <section class="gallery-page-section pt-0 mt-5">
                        <div class="auto-container">
                            <div class="row clearfix" id="gallery-container">
                                <!-- Initial Gallery Images -->
                                @foreach($event->blogGalleries->take(10) as $blogGallery)
                                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                                        <div class="gallery-block-two">
                                            <div class="inner-box">
                                                <figure class="image-box"><img src="{{ asset($blogGallery->thumb) }}" alt=""></figure>
                                                <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                                    <a href="{{ asset($blogGallery->image) }}"
                                                       class="lightbox-image d-flex justify-content-center align-items-center flex-column"
                                                       data-fancybox="gallery"> <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($event->blogGalleries->count() > 0)
                                <div class="text-center mt-3">
                                    <button id="load-more-btn" class="theme-btn btn-one">Load More</button>
                                    <div id="loading-message" style="display: none;">Loading more images...</div>
                                </div>
                            @endif
{{--                            <div class="text-center mt-3">--}}
{{--                                <button id="load-more-btn" class="theme-btn btn-one">Load More</button>--}}
{{--                                <div id="loading-message" style="display: none;">Loading more images...</div>--}}
{{--                            </div>--}}
                        </div>
                    </section>
                    <!-- gallery-page-section end -->

                    <style type="text/css">
                        .gallery-block-two .inner-box .image-box img {
                            height: 100%;
                        }
                    </style>

                </div>
            </div>
            <div class="col-lg-4">
                <div class=" sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h5>Recent Posts</h5>
                            </div>
                            <div class="post-inner">
                                @foreach($recentEvents as $recentEvent)
                                    <div class="post">
                                        <figure class="post-thumb"><a href="{{ route('frontend.find.event',$recentEvent->slug) }}"><img src="{{asset($recentEvent->image)}}" alt=""></a></figure>
                                        <h6><a href="{{ route('frontend.find.event',$recentEvent->slug) }}">{{$recentEvent->title}}</a></h6>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        </div>
    </section>
    <!-- sidebar-page-container end -->

<!-- Load More Button JavaScript -->
<script>
    let page = 2;
    const slug = "{{ $event->slug }}";

    document.getElementById('load-more-btn').addEventListener('click', function() {
        const loadingMessage = document.getElementById('loading-message');
        loadingMessage.style.display = 'block';
        let assetPath = "{{asset('/')}}"

        fetch(`/loadmore/${slug}/events?page=${page}`)
            .then(response => response.json())
            .then(data => {
                if (data.data.length > 0) {
                    const galleryContainer = document.getElementById('gallery-container');
                    data.data.forEach(gallery => {
                        console.log(gallery , 'gallery name')
                        const galleryBlock = document.createElement('div');
                        galleryBlock.classList.add('col-lg-4', 'col-md-6', 'col-sm-12', 'gallery-block');
                        galleryBlock.innerHTML = `
                            <div class="gallery-block-two">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="${assetPath}/${gallery.thumb}" alt="">
                                    </figure>
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
