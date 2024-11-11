@extends('frontend.layout.index')

@section('content')

 <!-- banner-section -->
 <section class="banner-section">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        <div class="slide-item">
            <div class="image-layer" style="background-image:url({{asset('images/big/img1.jpg')}})"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h3>asdasd</h3>
                    <h2>asdasd</h2>
                    <div class="btn-box">
                        <a target="_blank" href="#" class="theme-btn btn-one">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-item">
            <div class="image-layer" style="background-image:url({{asset('images/big/img1.jpg')}})"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h3>asdasd</h3>
                    <h2>asdasd</h2>
                    <div class="btn-box">
                        <a target="_blank" href="#" class="theme-btn btn-one">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- banner-section end -->

    <!-- Page Title -->
   <!--  <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img chinkara-img" style="background-image: url({{asset($animal->banner_image)}});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{$animal->title}}</h1>
                </div>
            </div>
        </div>
    </section> -->
    <!-- End Page Title -->

    <!-- animals-details -->
    <section class="animals-details">
        <div class="auto-container">
            <div class="animals-details-content">
                <!-- <figure class="image-box"><img src="{{asset($animal->image)}}" alt=""></figure> -->
                <div class="content-box">
                    <div class="row clearfix">
                        <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                            <div class="text">
                                <div class="animal-title">
                                    <h2>{{$animal->title}}</h2>
                                </div>
                                <div class="animals-description">
                                    <p>{!! $animal->details !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                            <div class="sidebar-content">
                                @foreach($animal->animalProps as $animalProps)
                                    <div class="single-item">
                                        <h5>{{$animalProps->title}}</h5>
                                        <p>{{$animalProps->details}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
                @foreach($animal->animalGalleries->take(10) as $animalGallery)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-two">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{ asset($animalGallery->thumb) }}" alt=""></figure>
                                <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                    <a href="{{ asset($animalGallery->image) }}"
                                       class="lightbox-image d-flex justify-content-center align-items-center flex-column"
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
                <h2>visit these <br />animals also</h2>
            </div>
            <div class="row clearfix">
                @foreach($relatedAnimals as $relatedAnimal)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-one">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{asset($relatedAnimal->image)}}" alt=""></figure>
                                <div class="content-box">
                                    <h3><a href="{{route('frontend.find.animal' , $relatedAnimal->slug)}}">{{$relatedAnimal->title}}</a></h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a href="{{route('frontend.find.animal' , $relatedAnimal->slug)}}">{{$relatedAnimal->title}}</a></h3>
                                    <div class="link"><a href="{{route('frontend.find.animal' , $relatedAnimal->slug)}}"><i class="flaticon-right-arrow"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="btn-box d-flex justify-content-center align-items-center mt-5">
            <a href="{{route('frontend.listing.animal')}}" class="theme-btn btn-one">discover more</a>
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
            let assetPath = "{{asset('/')}}"

            fetch(`/loadmore/${slug}/animals?page=${page}`)
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
