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

    </style>
    <!-- Page Title -->
    <section class="page-title">
        <div class="img-wrap parallax-demo-1">
            <div class="parallax-inner back-img" style="background-image: url({{asset('assets/images/background/page-title.jpg')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Career</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- contact-section -->
    <section class="contact-section centred mt-5 pt-5">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-8 col-lg-12 offset-xl-2 big-column">
                    <div class="sec-title centred">
                        <h2>Apply</h2>
                    </div>
                    <div class="form-inner">
                        <form method="post" id="career-application-form" action="{{ route('frontend.career.apply') }}" enctype="multipart/form-data" class="default-form">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="username" placeholder="Full name" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Email address" required>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" id="phone" name="phone" required>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="subject" required placeholder="Subject">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="file" name="upload" required>
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

    @push('scripts')
        <script>
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


                function updatePlaceholder() {
                    var placeholder = iti.isValidNumber() ? iti.getNumber(intlTelInputUtils.numberFormat.E164) : iti.getSelectedCountryData().dialCode;
                    var exampleNumber = intlTelInputUtils.getExampleNumber(iti.getSelectedCountryData().iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL);
                    input.setAttribute('placeholder', exampleNumber); // Set placeholder based on country
                    input.maxLength = exampleNumber.length; // Set max length based on placeholder
                }

                // Update placeholder on initialization
                updatePlaceholder();

                // Update placeholder when the country changes
                input.addEventListener('countrychange', updatePlaceholder);

                // Restrict the input to the max length based on the placeholder format
                input.addEventListener('input', function() {
                    if (input.value.length > input.maxLength) {
                        input.value = input.value.slice(0, input.maxLength); // Restrict input to max length
                    }
                });



                // When the form is submitted, get the full phone number with the country code
                $('#career-application-form').on('submit', function() {
                    var fullPhoneNumber = iti.getNumber();
                    $("#phone").val(fullPhoneNumber); // Replace the input value with the full phone number
                });


                $('#career-application-form').validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 3,
                            maxlength: 255
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        phone: {
                            required: true,
                            minlength: 10,
                            maxlength: 15
                        },
                        subject: {
                            required: true,
                            minlength: 3,
                            maxlength: 255 // Set a maximum length for the subject
                        },
                        upload: {
                            required: true,
                            extension: "pdf|doc|docx",
                            filesize: 2048 // 2MB
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
                            maxlength: "Your phone number cannot exceed 15 characters"
                        },
                        subject: {
                            required: "Please enter the subject",
                            minlength: "The subject must be at least 3 characters long",
                            maxlength: "The subject cannot exceed 255 characters"
                        },
                        upload: {
                            required: "Please upload your resume",
                            extension: "Only PDF, DOC, and DOCX files are allowed",
                            filesize: "Your file must be smaller than 2MB"
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });

                // Custom rule for file size
                $.validator.addMethod('filesize', function(value, element, param) {
                    return this.optional(element) || (element.files[0].size <= param * 1024);
                });
            });
        </script>


    @endpush
@endsection
