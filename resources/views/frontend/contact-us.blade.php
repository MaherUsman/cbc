@extends('frontend.layout.index')

@section('content')
    <style>
        /* Make sure the phone input container stays in line */
        .iti {
            width: 100%; /* Ensures the phone input takes up full width */
            display: inline-block;
        }

        /* Flag container */
        .iti__flag-container {
            margin-right: 8px; /* Adjust space between flag and phone number */
            vertical-align: middle; /* Align flag icon with input text */
        }

        /* Phone input to ensure text does not overlap with the dropdown */
        .iti input {
            padding-left: 58px; /* Create enough space for the flag and dropdown */
        }

        /* Adjust dropdown arrow positioning */
        .iti__selected-flag {
            width: 48px; /* Space for the flag and dropdown icon */
        }

        /* Optional: Make the dropdown arrow more prominent */
        .iti__arrow {
            margin-left: 4px; /* Slight adjustment to the arrow */
            vertical-align: middle; /* Ensures it stays aligned with the flag */
        }
        .map-inner iframe{
            width: 100%;
        }

    </style>
    <!-- google-map-section -->
    <section class="google-map-section">
        <div class="auto-container">
            <div class="map-inner">
                <!-- <div class="map-canvas"
                     data-zoom="12"
                     data-lat="-37.817085"
                     data-lng="144.955631"
                     data-type="roadmap"
                     data-hue="#ffc400"
                     data-title="Envato"
                     data-icon-path="assets/images/icons/map-marker.png"
                     data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">
                </div> -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1574.4138450616574!2d72.041171!3d29.2950139!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393b8b464ba8f583%3A0xee4fbde50e2c9475!2sSHEIKH%20MOHAMMAD%20BIN%20ZAYED%20AL%20NAHYAN%20CONSERVATION%20BREEDING%20CENTRE!5e1!3m2!1sen!2s!4v1731305585633!5m2!1sen!2s" width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="content-box">
                    <h2>get in touch with us</h2>
                    <ul class="info clearfix">
                        <li><i class="flaticon-telephone"></i><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a></li>
                        <li><i class="flaticon-email"></i><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></li>
                        <!-- <li><i class="flaticon-pin"></i>60 broklyn street, new york</li> -->
                    </ul>
                    <!-- <div class="inner">
                        <div class="icon-box"><i class="flaticon-clock-1"></i></div>
                        <p>Monday - Sunday</p>
                        <h4>9:00am to 6:00pm</h4>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- google-map-section end -->

    <!-- contact-section -->
    <section class="contact-section centred">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-8 col-lg-12 offset-xl-2 big-column">
                    <div class="sec-title centred">
                        <h2>have question? <br />drop a line</h2>
                    </div>

                    @if($errors->any())
                        {{--                        @dd($errors)--}}
                        <div id="error-message" class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div id="success-message" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-inner">
                        <form method="post" action="{{ route('frontend.contact.submit') }}" id="contact-form" class="default-form" novalidate="novalidate">
                            @csrf
                            <div class="row clearfix">

                                <!-- Username -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group p-0">
                                        <input type="text" name="username" placeholder="Full name" value="{{ old('username') }}" required>
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required style="padding: 10px 10px 10px 45px">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Message -->
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Write a message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0">
                                    <button class="theme-btn btn-one" type="submit" name="submit-form"><span>Submit</span></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorDiv = document.getElementById('error-message');
            var successDiv = document.getElementById('success-message');
            var offset = 135; // Change this value to adjust how much higher you want to scroll

            function scrollToElement(element) {
                var elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
                var offsetPosition = elementPosition - offset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }

            if (errorDiv) {
                scrollToElement(errorDiv);
            } else if (successDiv) {
                scrollToElement(successDiv);
            }
        });


        $(document).ready(function() {
            var input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "us";
                        callback(countryCode);
                    });
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            // Placeholder length default to 13, or use the actual placeholder length if present
            var placeholderLength = 15;
            if ($('#phone').attr('placeholder')) {
                placeholderLength = $('#phone').attr('placeholder').length;
            }

            // When the form is submitted, get the full phone number with the country code
            $('#contact-form').on('submit', function() {
                var fullPhoneNumber = iti.getNumber();
                $("#phone").val(fullPhoneNumber); // Replace the input value with the full phone number
            });

            $.validator.addMethod("strictEmail", function(value, element) {
                // Regular expression to ensure email has a valid domain and TLD (e.g., mmr@mmr.com)
                return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
            }, "Please enter a valid email address with a proper domain.");



            // Set up the validation for the form
            $('#contact-form').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        email: true,
                        strictEmail: true
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: placeholderLength
                    },
                    subject: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    message: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your full name",
                        minlength: "Your name must be at least 3 characters long",
                        maxlength: "Your name cannot exceed 255 characters"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    phone: {
                        required: "Please enter your phone number",
                        minlength: "Your phone number must be at least 10 characters long",
                        maxlength: "Your phone number cannot exceed " + placeholderLength + " characters"
                    },
                    subject: {
                        required: "Please enter the subject",
                        minlength: "The subject must be at least 3 characters long",
                        maxlength: "The subject cannot exceed 255 characters"
                    },
                    message: {
                        required: "Please enter a message",
                        minlength: "The message must be at least 10 characters long"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

    </script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM"></script>
@endpush
