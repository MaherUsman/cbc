<header class="main-header header-style-one">
    <div class="header-top">
        <div class="top-inner">
            <div class="top-left">
                <ul class="info clearfix">
                    <li><i class="flaticon-email"></i><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                </ul>
            </div>
            <div class="top-right">
                @include('frontend.partials.social_links')
            </div>
        </div>
    </div>
    <div class="header-lower">
        <div class="outer-box">
            <div class="logo-box">
                <figure class="logo"><a href="{{url('/')}}"><img src="{{asset('assets/images/cbc.png')}}" alt=""
                            width="100"></a></figure>
            </div>
            <div class="menu-area">
                <!--Mobile Navigation Toggler-->
                <div class="mobile-nav-toggler">
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                    <i class="icon-bar"></i>
                </div>
                <nav class="main-menu navbar-expand-md navbar-light">
                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                        <ul id="navbar" class="navigation clearfix">
                            <li class="{{ Request::routeIs('home') ? 'active' : '' }}"><a href="{{url('/')}}">Home</a>
                            </li>


                            <li class="{{ Request::routeIs('frontend.about.us') ? 'active' : '' }}"><a
                                    href="{{route('frontend.about.us')}}">About Us</a>

                            </li>

                            <li class="dropdown "><a href="#">Our Animals</a>
                                <ul>
                                    @foreach($animals as $animal)
                                    <li class="{{ Request::is('animal/' . $animal->slug) ? 'active' : '' }}">
                                        <a
                                            href="{{ route('frontend.find.animal', $animal->slug) }}">{{$animal->title}}</a>
                                    </li>
                                    @endforeach
                                    <li class="{{ Request::routeIs('frontend.animal.categories') ? 'active' : '' }}">
                                        <a href="{{ route('frontend.animal.categories') }}">Other Species</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="{{ Request::routeIs('frontend.events.index' ) ? 'active' : '' }}"><a
                                    href="{{route('frontend.events.index')}}">Events</a>

                                <!-- <ul>
                                    <li><a href="events.html">Our Blog</a></li>
                                    <li><a href="event-details.html">Blog Details</a></li>
                                </ul> -->
                            </li>
                            <li><a href="{{url('rearchArticle')}}">Research & Articles</a></li>

                            <li class="{{ Request::routeIs('frontend.topas.gallery' ) ? 'active' : '' }}"><a
                                    href="{{route('frontend.topas.gallery')}}">Tobas</a></li>
                            <li class="{{ Request::routeIs('frontend.activities.gallery' ) ? 'active' : '' }}"><a
                                    href="{{route('frontend.activities.gallery')}}">Acitivities</a></li>
                            <li class="{{ Request::routeIs('frontend.visitors.gallery' ) ? 'active' : '' }}"><a
                                    href="{{route('frontend.visitors.gallery')}}">Visitors</a></li>
                            <li class="{{ Request::routeIs('frontend.career.store' ) ? 'active' : '' }}"><a
                                    href="{{route('frontend.career.store')}}">Career</a></li>
                            <li class="{{ Request::routeIs('frontend.contact.us' ) ? 'active' : '' }}"><a
                                    href="{{route('frontend.contact.us')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="menu-right-content">
                {{-- <div class="support-box">
                    <div class="icon"><i class="flaticon-phone-ringing"></i></div>
                    <span>Have Questions?</span>
                    <h6><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></h6>
            </div> --}}
            <div class="search-box-outer">
                <div class="dropdown">
                    <button class="search-box-btn" type="button" id="dropdownMenu3" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="flaticon-magnifying-glass"></i></button>
                    <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu3">
                        <div class="form-container">
                            <form method="get" action="{{url('animals/listing')}}">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="{{ request('search-field') }}" placeholder="Search...."
                                        required="">
                                    <button type="submit" class="search-btn"><span
                                            class="fas fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="btn-box">
                    <a href="index.html">Book your ticket</a>
                </div> -->
        </div>
    </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="logo-box">
                <figure class="logo"><a href="{{url('/')}}"><img src="{{asset('assets/images/cbc.png')}}" alt=""
                            width="100"></a></figure>
            </div>
            <div class="menu-area">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
            <div class="menu-right-content">
                {{-- <div class="support-box">
                    <div class="icon"><i class="flaticon-phone-ringing"></i></div>
                    <span>Have Questions?</span>
                    <h6><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></h6>
            </div> --}}
            <div class="search-box-outer">
                <div class="dropdown">
                    <button class="search-box-btn" type="button" id="dropdownMenu4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"><i class="flaticon-magnifying-glass"></i></button>
                    <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu4">
                        <div class="form-container">
                            <form method="get" action="{{url('animals/listing')}}">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="{{ request('search-field') }}"
                                        required="">
                                    <button type="submit" class="search-btn"><span
                                            class="fas fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>
