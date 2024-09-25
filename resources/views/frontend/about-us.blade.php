@extends('frontend.layout.index')

@section('content')


    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url(assets/images/about/1.jpg);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>About Us</li>
                </ul>
                <div class="title">
                    <h1>About Us</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- about-style-three -->
    <section class="about-style-three sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <figure class="image-box"><img src="{{asset('assets/images/about/banner.jpg')}}" alt=""></figure>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_three">
                        <div class="content-box">
                            <div class="sec-title">
                                <h2> Conservation Breeding Centre – (CBC).  </h2>
                            </div>
                            <!-- <div class="inner">
                                <div class="icon-box"><i class="flaticon-zoo"></i></div>
                                <h5>Dolor in reprehenderit in voluptate velit esse cillum dolore fugiat nulla pariatur sed eiusmod simply free text tempor incidi dunt.</h5>
                            </div> -->
                            <div class="text">
                                <p>Passion of His Highness Sheikh Mohamed Bin Zayed Al Nahyan (The President of UAE and Ruler of Abu Dhabi) for conservation stemmed from his close association with nature especially the desert and its flora & fauna. His Highness has truly carried forward the legacy of his illustrious Father, Late His Highness Sheikh Zayed Bin Sultan Al-Nahyan (May his soul rest in peace). In the relentless pursuit of conservation objectives, CBC, a landmark project and the first of its kind in Pakistan, was sponsored by His Highness Sheikh Mohamed Bin Zayed Al Nahyan (The President of UAE and Ruler of Abu Dhabi) in Lal Sohanra, Cholistan Desert in 2014.
                                </p>

                            </div>
                            <!-- <div class="btn-box">
                                <a href="index-2.html" class="theme-btn btn-one">discover more</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text">
                <p>
                    It is a highly guarded desert expanse spread across 165 sq. Km (40,772.4 acres), where Chinkaras, Black Bucks and Blue Bull along with other natural species thrive unencumbered with minimal human signature. A 5,000-acre Sheikh Zayed Bin Sultan Al-Nahyan Deer Breeding Centre (H.H Wildlife Park) where around 5,000 Chinkara Gazelles had been bred. Out of this stock 3400 Chinkara Gazelles have been translocated to various habitats and enclosures in Pakistan for breeding. .  Regular seeding of flora through conventional and aerial means is carried out to ensure feed for the fauna in abundance.  23x Existing Tobas (23) in the area are maintained/recharged watchfully through HWNCS water bowsers in all seasons. The flourishing projects which are actively improving the natural habitat to support wildlife are a vivid acknowledgment of H.H. Sheikh Mohamed Bin Zayed Al Nahyan’s (The President of UAE and Ruler of Abu Dhabi) manifest service to nature.
                </p>

            </div>
        </div>
    </section>
    <!-- about-style-three end -->

    <!-- gallery-page-section -->
    {{-- <section class="gallery-page-section pt-0">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="sec-title">
                        <h2>all images</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/1.jpg" alt=""></figure>
                            <div class="view-box d-flex align-items-center flex-column justify-content-center">
                                <a href="assets/images/about/1.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery">
                                    <i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Conservation Breeding Center
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/3.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/3.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Research Centre
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/4.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/4.jpg" class="lightbox-image  d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Research Laboratory
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/5.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/5.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        Aerial View of Check Post in Conservation Breeding Centre
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/6.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/6.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>
                                    <span class="text-heading text-center">
                                        A typical Gopa in Cholistan Desert
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 gallery-block">
                    <div class="gallery-block-two">
                        <div class="inner-box">
                            <figure class="image-box"><img src="assets/images/about/7.jpg" alt=""></figure>
                            <div class="view-box"><a href="assets/images/about/7.jpg" class="lightbox-image d-flex justify-content-center align-items-center flex-column" data-fancybox="gallery"><i class="flaticon-plus-symbol"></i>

                                    <span class="text-heading text-center">
                                        Solar System in Conservation Breeding Centre
                                    </span>
                                </a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    <!-- gallery-page-section end -->


    <!-- testimonial-section -->
    <!-- <section class="testimonial-section centred sec-pad bg-color-1">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-6.png);"></div>
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>What they’re <br />saying?</h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                <div class="testimonil-block-one">
                    <div class="inner-box">
                        <div class="author-thumb">
                            <figure class="thumb-box"><img src="assets/images/resource/testimonial-1.jpg" alt=""></figure>
                            <div class="quote"><i class="flaticon-quote"></i></div>
                        </div>
                        <div class="text">
                            <p>I was impresed by the company services, lorem is simply free text used by copytyping no refreshing.  Neque porro est qui dolorem</p>
                        </div>
                        <div class="author-info">
                            <h5>Christine Rose</h5>
                            <span class="designation">Customer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonil-block-one">
                    <div class="inner-box">
                        <div class="author-thumb">
                            <figure class="thumb-box"><img src="assets/images/resource/testimonial-2.jpg" alt=""></figure>
                            <div class="quote"><i class="flaticon-quote"></i></div>
                        </div>
                        <div class="text">
                            <p>I was impresed by the company services, lorem is simply free text used by copytyping no refreshing.  Neque porro est qui dolorem</p>
                        </div>
                        <div class="author-info">
                            <h5>Mike hardson</h5>
                            <span class="designation">Customer</span>
                        </div>
                    </div>
                </div>
                <div class="testimonil-block-one">
                    <div class="inner-box">
                        <div class="author-thumb">
                            <figure class="thumb-box"><img src="assets/images/resource/testimonial-3.jpg" alt=""></figure>
                            <div class="quote"><i class="flaticon-quote"></i></div>
                        </div>
                        <div class="text">
                            <p>I was impresed by the company services, lorem is simply free text used by copytyping no refreshing.  Neque porro est qui dolorem</p>
                        </div>
                        <div class="author-info">
                            <h5>sarah albert</h5>
                            <span class="designation">Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- testimonial-section end -->


    <!-- video-section -->
    <!-- <section class="video-section centred">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url(assets/images/background/video-bg.jpg);"></div>
        </div>
        <div class="auto-container">
            <div class="inner-box">
                <div class="video-btn">
                    <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption=""><i class="fas fa-play"></i></a>
                </div>
                <h2>ready to meet <br />wildlife animals</h2>
            </div>
        </div>
    </section> -->
    <!-- video-section end -->


    <!-- clients-section -->
    <!-- <section class="clients-section alternat-2 border-bottom">
        <div class="auto-container">
            <div class="five-item-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
                <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-6.png" alt=""></a></figure>
                <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-7.png" alt=""></a></figure>
                <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-8.png" alt=""></a></figure>
                <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-9.png" alt=""></a></figure>
                <figure class="clients-logo"><a href="index.html"><img src="assets/images/clients/clients-10.png" alt=""></a></figure>
            </div>
        </div>
    </section> -->
    <!-- clients-section end -->


    <!-- team-section -->
    <section class="team-section sec-pad">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>the Team in <br />our zoo</h2>
            </div>
            <div class="inner-content">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{asset('assets/images/team/team-1.jpg')}}" alt=""></figure>
                                <div class="lower-content">
                                    <h3><a href="about.html">Aleesha</a> <span>Animal Doctor</span></h3>
                                    <p>There are many of lorem ipsum available but the have in some form.</p>
                                    <ul class="social-links clearfix">
                                        <li><a href="about.html"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="about.html"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="about.html"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{asset('assets/images/team/team-2.jpg')}}" alt=""></figure>
                                <div class="lower-content">
                                    <h3><a href="about.html">michale</a> <span>Animal Doctor</span></h3>
                                    <p>There are many of lorem ipsum available but the have in some form.</p>
                                    <ul class="social-links clearfix">
                                        <li><a href="about.html"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="about.html"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="about.html"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                        <div class="team-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><img src="{{asset('assets/images/team/team-3.jpg')}}" alt=""></figure>
                                <div class="lower-content">
                                    <h3><a href="about.html">sarah</a> <span>Animal Doctor</span></h3>
                                    <p>There are many of lorem ipsum available but the have in some form.</p>
                                    <ul class="social-links clearfix">
                                        <li><a href="about.html"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="about.html"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="about.html"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team-section end -->

@endsection
