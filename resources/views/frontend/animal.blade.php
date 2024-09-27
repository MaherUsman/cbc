@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img chinkara-img" style="background-image: url({{asset($animal->banner_image)}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{$animal->title}}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- animals-details -->
    <section class="animals-details">
        <div class="auto-container">
            <div class="animals-details-content">
                <figure class="image-box"><img src="{{asset($animal->image)}}" alt=""></figure>
                <div class="content-box">
                    <div class="row clearfix">
                        <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                            <div class="text">
                                <div class="animal-title">
                                    <h2>{{$animal->title}}</h2>
                                </div>

                                <div class="animals-description">
                                <p>{{$animal->details}}</p>
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

    <!-- gallery-page-section -->
    <section class="gallery-page-section pt-0 mt-5">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="sec-title">
                        <h2>all images</h2>
                    </div>
                </div>
                @foreach($animal->animalGalleries as $animalGalleries)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-two">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{asset($animalGalleries->image)}}" alt=""></figure>
                                <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                    <a href="{{asset($animalGalleries->image)}}" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol">


                                        </i>

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
                                    <h3><a href="{{route('frontend.find.animal' , $relatedAnimal->image)}}">{{asset($relatedAnimal->image)}}</a></h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a href="{{route('frontend.find.animal' , $relatedAnimal->image)}}">{{asset($relatedAnimal->image)}}</a></h3>
                                    <!-- <p>There are many type of <br />variations pass not available</p> -->
                                    <div class="link"><a href="{{route('frontend.find.animal' , $relatedAnimal->image)}}"><i class="flaticon-right-arrow"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/resource/blue.jpg" alt=""></figure>
                            <div class="content-box">
                                <h3><a href="bluebull.html">Nilgai/ Blue Bull</a></h3>
                            </div>
                            <div class="overlay-content">
                                <h3><a href="bluebull.html">Nilgai/ Blue Bull</a></h3>
                                <!-- <p>There are many type of <br />variations pass not available</p> -->
                                <div class="link"><a href="bluebull.html"><i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/resource/Kingfisher.jpeg" alt=""></figure>
                            <div class="content-box">
                                <h3><a href="whitethroatedkingfisher.html">White-throated Kingfisher</a></h3>
                            </div>
                            <div class="overlay-content">
                                <h3><a href="whitethroatedkingfisher.html">White-throated Kingfisher</a></h3>
                                <!-- <p>There are many type of <br />variations pass not available</p> -->
                                <div class="link"><a href="whitethroatedkingfisher.html"><i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-box d-flex justify-content-center align-items-center mt-5">
            <a href="animals.html" class="theme-btn btn-one">discover more</a>
        </div>
    </section>
    <!-- animals-section end -->


@endsection
