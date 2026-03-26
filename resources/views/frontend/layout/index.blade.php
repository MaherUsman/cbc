<!DOCTYPE html>
<html lang="en">
@include('frontend.layout.header')
<!-- page wrapper -->
<body>

<div class="boxed_wrapper">


    <!-- preloader -->
{{--    <div class="loader-wrap">--}}
{{--        <div class="preloader">--}}
{{--            <div class="preloader-close">x</div>--}}
{{--            <div id="handle-preloader" class="handle-preloader about-page-2">--}}
{{--                <div class="animation-preloader">--}}
{{--                    <div class="spinner">--}}
{{--                        <div class="nav-logo"><a href="{{url('/')}}"><img src="{{asset('assets/images/cbc.png')}}"--}}
{{--                                                                          alt="" title="" width="300"></a></div>--}}
{{--                    </div>--}}

{{--                    @php--}}
{{--                        $preloaderText = "Conservation Breeding Centre";--}}
{{--                            $textParts = explode(' ', $setting->Loading_page_text??$preloaderText, 2);--}}
{{--                            $part1 = $textParts[0] ?? '';--}}
{{--                            $part2 = $textParts[1] ?? '';--}}
{{--                    @endphp--}}

{{--                    <div class="txt-loading">--}}
{{--                        @foreach(str_split($part1) as $char)--}}
{{--                            @if($char === ' ')--}}
{{--                                <span data-text-preloader=" " class="letters-loading">&nbsp;</span>--}}
{{--                            @else--}}
{{--                                <span data-text-preloader="{{ $char }}" class="letters-loading">{{ $char }}</span>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                    <div class="txt-loading">--}}
{{--                        @foreach(str_split($part2) as $char)--}}
{{--                            @if($char === ' ')--}}
{{--                                <span data-text-preloader=" " class="letters-loading">&nbsp;</span>--}}
{{--                            @else--}}
{{--                                <span data-text-preloader="{{ $char }}" class="letters-loading">{{ $char }}</span>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
            <div class="nav-logo"><a href="{{url('/')}}"><img src="{{asset('assets/images/cbc.png')}}" width=""
                                                              title=""></a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    {{-- <li>Chicago 12, Melborne City, USA</li> --}}
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="https://www.facebook.com/houbara"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="https://www.instagram.com/hfip_216/"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="https://www.youtube.com/@houbarafoundationinternati5340"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->

@yield('content')

<!-- main-footer -->
    <section class="main-footer">
        <div class="footer-top">
            <div class="pattern-layer"
                 style="background-image: url({{asset('assets/images/shape/shape-4.png')}});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo"><a href="{{url('/')}}"><img
                                        src="{{asset('assets/images/cbc.png')}}" alt="" width="100"></a></figure>
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
                                    <li class="{{ Request::routeIs('frontend.about.us' ) ? 'active' : '' }}"><a href="{{route('frontend.about.us')}}">About Us</a></li>
                                    <li class="{{ Request::routeIs('frontend.listing.animal' ) ? 'active' : '' }}"><a href="{{route('frontend.listing.animal')}}">Species</a></li>
                                    <li class="{{ Request::routeIs('frontend.tobas.page' ) ? 'active' : '' }}"><a href="{{route('frontend.tobas.page')}}">Hydration</a></li>
                                    {{-- <li class="{{ Request::routeIs('frontend.activites.page' ) ? 'active' : '' }}"><a href="{{route('frontend.activites.page')}}">Activities</a></li> --}}
                                    {{-- <li class="{{ Request::routeIs('frontend.students.index' ) ? 'active' : '' }}"><a href="{{route('frontend.students.index')}}">Our Veterinarian</a></li> --}}
                                    <li class="{{ Request::routeIs('frontend.security' ) ? 'active' : '' }}"><a href="{{route('frontend.security')}}">Security</a></li>
                                    <li class="{{ Request::routeIs('frontend.contact.us' ) ? 'active' : '' }}"><a href="{{route('frontend.contact.us')}}">Contact Us</a></li>

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
                                    <li><i class="flaticon-telephone"></i><a
                                            href="tel:{{$setting->phone}}">{{$setting->phone}}</a></li>
                                    <li><i class="flaticon-email"></i><a
                                            href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>

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
                    <p>{!! $setting->copyright_text !!} {{$setting->copyright_year}} by <a
                            href="{{$setting->copyright_link}}">{{$setting->copyright_link_name}}</a></p>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>


<!-- Include jQuery -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


<!-- Include jQuery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="{{asset('assets/js/map-script.js')}}"></script>


<script>
    $(document).ready(function () {


        $(".fa-search").click(function () {
            $(".srch-wrap, .input").toggleClass("active");
            $("input[type='text']").focus();
        });

    });


</script>

@stack('scripts')


</body><!-- End of .page_wrapper -->

</html>
