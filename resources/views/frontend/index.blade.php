@extends('frontend.layout.index')

@section('content')

    <!-- banner-section -->
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            @foreach($sliders as $slider)
                <div class="slide-item">
                    <div class="image-layer" style="background-image:url({{$slider->image}})"></div>
                    <div class="auto-container">
                        <div class="content-box">
                            <h3>{{$slider->title}}</h3>
                            <h2>{!! $slider->details !!}</h2>
                            <div class="btn-box">
                                <a target="_blank" href="{{$slider->slink}}" class="theme-btn btn-one">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- banner-section end -->


    <!-- info-section -->
    <section class="info-section">
        <div class="bg-layer"></div>
        <span class="rotate-text">wild animal zoo</span>
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-3">
                        <div class="highness-img">
                            <img src="{{asset($intro->image)}}" />
                        </div>

                    </div>
                    <div class="col-lg-9">
                        <div class="sec-title mb-2">
                            <h2>{{$intro->title}}</h2>
                        </div>

                        <p class="highness-text">
                            {!! $intro->details !!}
                        </p>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- info-section end -->






    <!-- Chincara-section -->
    <section class="about-section sec-pad ainmal-sec setformobilechin">
        <div class="auto-container">
            <div class="row clearfix">

                <div class="col-lg-6 col-md-12 col-sm-12 content-column mt-5 pr-5">
                    <div class="content_block_one">
                        <div class="content-box">
                            <div class="sec-title">
                                <h2>Chincara</h2>
                            </div>
                            <div class="text">
                                <!-- <h4>Help us to protect wildlife around the world.</h4> -->
                                <p>The Chinkara (Gazella bennettii), also known as the Indian gazelle, it is native to India, Iran, Afghanistan and Pakistan. Chinkara live in arid plains and hills, deserts, dry scrub and light forests. In Pakistan, they range up to elevations of 1,500 m (4,900 ft). It stands at 65 cm tall and weighs about 23 kg. It has a reddish-buff summer coat with smooth, glossy fur. The sides of the face have dark chestnut stripes from the corner of the eye to the muzzle, bordered by white stripes. Its horns reach over 39 cm in males.</p>
                                <!-- <ul class="list-style-one clearfix">
                                    <li> In Pakistan, they range up to elevations of 1,500 m (4,900 ft). </li>
                                    <li>It stands at 65 cm tall and weighs about 23 kg.</li>
                                    <li>Its horns reach over 39 cm in males.</li>
                                </ul> -->
                            </div>
                            <div class="btn-box">
                                <a href="chinkara.html" class="theme-btn btn-one">discover more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box">
                            <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                            <figure class="image "><img src="assets/images/resource/chincara.jpg" alt=""></figure>
                            <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Chincara-section end -->



    <!-- Black Bucks-section -->
    <section class="about-section sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box img-style">
                            <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                            <figure class="image "><img src="assets/images/resource/blackbunks2.jpg" alt=""></figure>
                            <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box">
                            <div class="sec-title">
                                <h2>Black Bucks</h2>
                            </div>
                            <div class="text">

                                <p>The Blackbuck (Antilope cervicapra), also known as the Indian antelope, is a medium-sized antelope native to India and Nepal. It inhabits grassy plains and lightly forested areas with perennial water sources. It stands up to 74 to 84 cm high at the shoulder. Males weigh 20–57 kg. Females are lighter, weighing 20–33 kg. Males have 35–75 cm  long corkscrew horns, and females usually have no horns.</p>
                                <!-- <ul class="list-style-one clearfix">
                                    <li>Lorem Ipsum is not simply random text</li>
                                    <li>If you are going to use a passage</li>
                                    <li>Making this the first true generator on the Internet</li>
                                </ul> -->
                            </div>
                            <div class="btn-box">
                                <a href="blackbucks.html" class="theme-btn btn-one">discover more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Black Bucks-section end -->



    <!-- Blue Bull-section -->
    <section class="about-section sec-pad ainmal-sec setformobilechin">
        <div class="auto-container">
            <div class="row clearfix">

                <div class="col-lg-6 col-md-12 col-sm-12 content-column ps-5">
                    <div class="content_block_one">
                        <div class="content-box">
                            <div class="sec-title">
                                <h2>Blue Bull</h2>
                            </div>
                            <div class="text">
                                <!-- <h4>Help us to protect wildlife around the world.</h4> -->
                                <p>The Nilgai (Boselaphus tragocamelus)  is the largest antelope of Asia and is ubiquitous across the northern Indian subcontinent. The Nilgai stands 3.3–4.9 ft at the shoulder; males weigh 109–288 kg and the lighter females 100–213 kg. A sturdy thin-legged antelope, the Nilgai is characterized by sloping back, a deep neck with a white patch on the throat, a short crest of hair along the neck terminating in a tuft and white facial spots. A column of pendant coarse hair hangs from the dewlap ridge below the white patch. Sexual dimorphism is prominent, the females and juveniles are orange to tawny in coloration while adult males have a bluish-grey coat. Only males possess 15–24 cm long horns.</p>
                                <!-- <ul class="list-style-one clearfix">
                                    <li>Lorem Ipsum is not simply random text</li>
                                    <li>If you are going to use a passage</li>
                                    <li>Making this the first true generator on the Internet</li>
                                </ul> -->
                            </div>
                            <div class="btn-box">
                                <a href="bluebull.html" class="theme-btn btn-one">discover more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box">
                            <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                            <figure class="image "><img src="assets/images/resource/blue.jpg" alt=""></figure>
                            <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blue Bull-section end -->


    <!-- Houbara bustard-section -->
    <section class="about-section sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box img-style">
                            <div class="shape" style="background-image: url(assets/images/shape/shape-1.png);"></div>
                            <figure class="image "><img src="assets/images/resource/houbara.jpg" alt=""></figure>
                            <!-- <div class="icon-box"><img src="assets/images/icons/icon-1.png" alt=""></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box">
                            <div class="sec-title">
                                <h2>Houbara bustard</h2>
                            </div>
                            <div class="text">
                                <h4>Help us to protect wildlife around the world.</h4>
                                <p>There are many variations of passages of available but the majority have suffered alteration in some form, by injected humou or randomised words even slightly believable.</p>
                                <ul class="list-style-one clearfix">
                                    <li>Lorem Ipsum is not simply random text</li>
                                    <li>If you are going to use a passage</li>
                                    <li>Making this the first true generator on the Internet</li>
                                </ul>
                            </div>
                            <div class="btn-box">
                                <a href="houbarabustard.html" class="theme-btn btn-one">discover more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Houbara bustard-section end -->


    <!-- gallery-section -->
    <section class="gallery-section">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>amazing Animals <br />in our zoo</h2>
            </div>
        </div>
        <div class="outer-container">
            <div class="gallery-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                <div class="gallery-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="assets/images/resource/chincara.jpg" alt=""></figure>
                        <div class="content-box">
                            <h3><a href="chinkara.html">Chinkara</a></h3>
                        </div>
                        <div class="overlay-content">
                            <h3><a href="chinkara.html">Chinkara</a></h3>
                            <!-- <p>There are many type of <br />variations pass not available</p> -->
                            <div class="link"><a href="chinkara.html"><i class="flaticon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="gallery-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="assets/images/resource/blackbunks2.jpg" alt=""></figure>
                        <div class="content-box">
                            <h3><a href="blackbucks.html">Black Buck</a></h3>
                        </div>
                        <div class="overlay-content">
                            <h3><a href="blackbucks.html">Black Buck</a></h3>
                            <!-- <p>There are many type of <br />variations pass not available</p> -->
                            <div class="link"><a href="blackbucks.html"><i class="flaticon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
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
                <div class="gallery-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="assets/images/resource/wingedKite.jpg" alt=""></figure>
                        <div class="content-box">
                            <h3><a href="blackwingedKite.html">Black – winged Kite</a></h3>
                        </div>
                        <div class="overlay-content">
                            <h3><a href="blackwingedKite.html">Black – winged Kite</a></h3>
                            <!-- <p>There are many type of <br />variations pass not available</p> -->
                            <div class="link"><a href="blackwingedKite.html"><i class="flaticon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
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
                <div class="gallery-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="assets/images/resource/tawnye.jpg" alt=""></figure>
                        <div class="content-box">
                            <h3><a href="tawnyeagle.html">Tawny Eagle</a></h3>
                        </div>
                        <div class="overlay-content">
                            <h3><a href="tawnyeagle.html">Tawny Eagle</a></h3>
                            <!-- <p>There are many type of <br />variations pass not available</p> -->
                            <div class="link"><a href="tawnyeagle.html"><i class="flaticon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="gallery-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="assets/images/resource/White-earedBulbul.jpg" alt=""></figure>
                        <div class="content-box">
                            <h3><a href="whiteearedbulbul.html">White-eared Bulbul</a></h3>
                        </div>
                        <div class="overlay-content">
                            <h3><a href="whiteearedbulbul.html">White-eared Bulbul</a></h3>
                            <!-- <p>There are many type of <br />variations pass not available</p> -->
                            <div class="link"><a href="whiteearedbulbul.html"><i class="flaticon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>






            </div>
        </div>

        <div class="btn-box d-flex justify-content-center align-items-center mt-5">
            <a href="animals.html" class="theme-btn btn-one">discover more</a>
        </div>
    </section>
    <!-- gallery-section end -->



    <!-- events-section -->
    <section class="events-section sec-pad mt-5">
        <div class="bg-layer"></div>
        <div class="bg-image" style="background-image: url(assets/images/background/events-bg.jpg);"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 title-column">
                    <div class="sec-title light">
                        <h2>Check zoo upcoming events</h2>
                        <a href="index.html" class="theme-btn btn-one">view all</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                    <div class="inner-content">
                        <div class="events-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="assets/images/resource/events-1.jpg" alt=""></figure>
                                    <div class="post-date"><h6>16<span>dec</span></h6></div>
                                </div>
                                <div class="inner">
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>2:00 am</li>
                                        <li><i class="far fa-map"></i>60 broklyn street</li>
                                    </ul>
                                    <h3><a href="index.html">zebra and girrafe on the street</a></h3>
                                    <p>Suspendisse finibus urna mauris, lorem ipsum is simply free.</p>
                                </div>
                            </div>
                        </div>
                        <div class="events-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="assets/images/resource/events-2.jpg" alt=""></figure>
                                    <div class="post-date"><h6>05<span>dec</span></h6></div>
                                </div>
                                <div class="inner">
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>2:00 am</li>
                                        <li><i class="far fa-map"></i>60 broklyn street</li>
                                    </ul>
                                    <h3><a href="index.html">how Interaction with Animal can</a></h3>
                                    <p>Suspendisse finibus urna mauris, lorem ipsum is simply free.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- events-section end -->


    <!-- funfact-section -->
    <section class="funfact-section">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url(assets/images/background/funfact-bg.jpg);"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-polar-bear"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="60">0</span><span>+</span>
                            </div>
                            <p>Wild Animals</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-whale"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="20">0</span><span>+</span>
                            </div>
                            <p>Aquatic Animals</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-bird"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="40">0</span><span>+</span>
                            </div>
                            <p>Beautiful Birds</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-smiling-emoticon-square-face"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="60">0</span><span>k</span>
                            </div>
                            <p>Happy Visitors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- funfact-section end -->


    <!-- news-section -->
    <section class="news-section centred">
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
    </section>
    <!-- news-section end -->

@endsection
