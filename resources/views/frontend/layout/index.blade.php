<!DOCTYPE html>
<html lang="en">
@include('frontend.layout.header')
<!-- page wrapper -->
<body>

<div class="boxed_wrapper">


    <!-- preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close">x</div>
            <div id="handle-preloader" class="handle-preloader about-page-2">
                <div class="animation-preloader">
                    <div class="spinner">
                        <div class="nav-logo"><a href="index.html"><img src="{{asset('assets/images/cbc.png')}}" alt="" title="" width="300"></a></div>
                    </div>
                    <div class="txt-loading">
                            <span data-text-preloader="c" class="letters-loading">
                                c
                            </span>
                        <span data-text-preloader="o" class="letters-loading">
                                o
                            </span>
                        <span data-text-preloader="n" class="letters-loading">
                                n
                            </span>
                        <span data-text-preloader="s" class="letters-loading">
                                s
                            </span>
                        <span data-text-preloader="e" class="letters-loading">
                                e
                            </span>
                        <span data-text-preloader="r" class="letters-loading">
                                r
                            </span>
                        <span data-text-preloader="v" class="letters-loading">
                                v
                            </span>
                        <span data-text-preloader="a" class="letters-loading">
                                a
                            </span>
                        <span data-text-preloader="t" class="letters-loading">
                                t
                            </span>
                        <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                        <span data-text-preloader="o" class="letters-loading">
                                o
                            </span>
                        <span data-text-preloader="n" class="letters-loading">
                                n
                            </span>
                    </div>
                    <div class="txt-loading">
                            <span data-text-preloader="b" class="letters-loading">
                                b
                            </span>
                        <span data-text-preloader="r" class="letters-loading">
                                r
                            </span>
                        <span data-text-preloader="e" class="letters-loading">
                                e
                            </span>
                        <span data-text-preloader="d" class="letters-loading">
                                d
                            </span>
                        <span data-text-preloader="i" class="letters-loading">
                                i
                            </span>
                        <span data-text-preloader="n" class="letters-loading">
                                n
                            </span>
                        <span data-text-preloader="g" class="letters-loading">
                                g
                            </span>
                        <span data-text-preloader="" class="letters-loading">

                            </span>
                        <span data-text-preloader="c" class="letters-loading">
                                c
                            </span>
                        <span data-text-preloader="e" class="letters-loading">
                                e
                            </span>
                        <span data-text-preloader="n" class="letters-loading">
                                n
                            </span>
                        <span data-text-preloader="t" class="letters-loading">
                                t
                            </span>
                        <span data-text-preloader="e" class="letters-loading">
                                e
                            </span>
                        <span data-text-preloader="r" class="letters-loading">
                                r
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->


    <!-- main header -->
   @include('frontend.partials.navbar')
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="w-100" style="background:#202020; height: 30px"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>


        <nav class="menu-box">
            <div class="nav-logo"><a href="index.html"><img src="{{asset('assets/images/cbc.png')}}"  width="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            {{-- <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Chicago 12, Melborne City, USA</li>
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div> --}}
        </nav>
    </div><!-- End Mobile Menu -->

    @yield('content')

    <!-- main-footer -->
    <section class="main-footer">
        <div class="footer-top">
            <div class="pattern-layer" style="background-image: url({{asset('assets/images/shape/shape-4.png')}});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo"><a href="index.html"><img src="{{asset('assets/images/cbc.png')}}" alt="" width="100"></a></figure>
                            @include('frontend.partials.social_links' , ['className' => 'footer-social'])
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h5>Links</h5>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="animals.html">Meet the Animals</a></li>
                                    <li><a href="events.html">Survey</a></li>
                                    <li><a href="gallery.html">Our Gallery</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget contact-widget">
                            <div class="widget-title">
                                <h5>Contact</h5>
                            </div>
                            <div class="widget-content">
                                <ul class="info clearfix">
                                    <li><i class="flaticon-telephone"></i><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></li>
                                    <li><i class="flaticon-email"></i><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                                    <li><i class="flaticon-pin"></i>{{$setting->address}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom centred">
            <div class="auto-container">
                <div class="copyright">
                    <p>{{$setting->copyright_text}} {{$setting->copyright_year}} by <a href="{{$setting->copyright_link}}">{{$setting->copyright_link_name}}</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- main-footer end -->



    <!-- scroll to top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fal fa-long-arrow-up"></i>
    </button>
</div>

@include('frontend.layout.footer')

</body><!-- End of .page_wrapper -->

</html>
