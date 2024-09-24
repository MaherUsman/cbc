<header class="main-header header-style-one">
    <div class="header-top">
        <div class="top-inner">
            <div class="top-left">
                <ul class="info clearfix">
                    <li><i class="flaticon-pin"></i>{{$setting->address}}</li>
                    <li><i class="flaticon-email"></i><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                    <li><i class="flaticon-clock"></i>Mon - Sat 9:00 am to 6:00 pm</li>
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
                <figure class="logo"><a href="index.html"><img src="{{asset('assets/images/cbc.png')}}" alt="" width="100"></a></figure>
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
                        <ul class="navigation clearfix">
                            <li class="dropdown"><a href="index.html">Home</a></li>


                            <li class="dropdown"><a href="about.html">About Us</a>
                                <ul>
                                    <li><a href="tobas.html">Tobas</a></li>
                                    <li><a href="activities.html">Acitivities </a></li>
                                    <li><a href="visitors.html">Visitors </a></li>


                                </ul>
                            </li>

                            <li class="dropdown"><a href="animals.html">Our Animals</a>
                                <ul>
                                    <li><a href="chinkara.html">Chinkara</a></li>
                                    <li><a href="blackbucks.html">Black Buck</a></li>
                                    <li><a href="bluebull.html">Blue Bull</a></li>
                                    <li><a href="blackwingedKite.html">Black – winged Kite</a></li>
                                    <li><a href="whitethroatedkingfisher.html">White-throated Kingfisher</a></li>
                                    <li><a href="tawnyeagle.html">Tawny Eagle</a></li>
                                    <li><a href="whiteearedbulbul.html">White-eared Bulbul</a></li>

                                </ul>
                            </li>

                            <li class="dropdown"><a href="events.html">Events</a>

                                <!-- <ul>
                                    <li><a href="events.html">Our Blog</a></li>
                                    <li><a href="event-details.html">Blog Details</a></li>
                                </ul> -->
                            </li>
                            <li><a href="researcandarticles.html">Research & Articles</a></li>

                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="menu-right-content">
                <div class="support-box">
                    <div class="icon"><i class="flaticon-phone-ringing"></i></div>
                    <span>Have Questions?</span>
                    <h6><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></h6>
                </div>
                <div class="search-box-outer">
                    <div class="dropdown">
                        <button class="search-box-btn" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon-magnifying-glass"></i></button>
                        <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu3">
                            <div class="form-container">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <input type="search" name="search-field" value="" placeholder="Search...." required="">
                                        <button type="submit" class="search-btn"><span class="fas fa-search"></span></button>
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
                <figure class="logo"><a href="index.html"><img src="{{asset('assets/images/cbc.png')}}" alt="" width="100"></a></figure>
            </div>
            <div class="menu-area">
                <nav class="main-menu clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
            </div>
            <div class="menu-right-content">
                <div class="support-box">
                    <div class="icon"><i class="flaticon-phone-ringing"></i></div>
                    <span>Have Questions?</span>
                    <h6><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></h6>
                </div>
                <div class="search-box-outer">
                    <div class="dropdown">
                        <button class="search-box-btn" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon-magnifying-glass"></i></button>
                        <div class="dropdown-menu search-panel" aria-labelledby="dropdownMenu4">
                            <div class="form-container">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <input type="search" name="search-field" value="" placeholder="Search...." required="">
                                        <button type="submit" class="search-btn"><span class="fas fa-search"></span></button>
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
