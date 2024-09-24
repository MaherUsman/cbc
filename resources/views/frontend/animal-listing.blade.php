@extends('frontend.layout.index')

@section('content')

    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div
                class="parallax-inner back-img"
                style="
              background-image: url({{asset('assets/images/background/page-title.jpg')}});
            "
            ></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Animals</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- animals-page-section -->
    <section class="animals-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                @foreach($animals as $animal)
                    <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                        <div class="gallery-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{asset($animal->image)}}" alt="" />
                                </figure>
                                <div class="content-box">
                                    <h3><a href="{{route('frontend.listing.animal' , $animal->slug)}}">                                                                   </a></h3>
                                </div>
                                <div class="overlay-content">
                                    <h3><a href="{{route('frontend.listing.animal' , $animal->slug)}}">{{$animal->title}}</a></h3>
                                    <!-- <p>There are many type of <br />variations pass not available</p> -->
                                    <div class="link">
                                        <a href="{{route('frontend.listing.animal' , $animal->slug)}}"
                                        ><i class="flaticon-right-arrow"></i
                                            ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- animals-page-section end -->

@endsection
