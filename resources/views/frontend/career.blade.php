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
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <div class="form-inner">
                        <form method="post" id="career-application-form" action="{{ route('frontend.career.apply') }}" enctype="multipart/form-data" class="default-form">
                            @csrf
                            <div class="row clearfix">

                                <!-- Username -->
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="username" placeholder="Full name" value="{{ old('username') }}" required>
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                    <input type="text" id="phone" name="phone" placeholder="Phone number" value="{{ old('phone') }}" required style="padding: 10px 10px 10px 45px">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Subject -->
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="subject" placeholder="Job Title" value="{{ old('subject') }}" required>
                                    @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- File upload (PDF, DOC, DOCX) -->
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    {{-- <div class="file-input-wrapper text-left"> --}}
                                        <input type="file" name="upload" accept=".pdf,.doc,.docx" required>
                                        @error('upload')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    {{-- </div> --}}
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

                // Placeholder length default to 13, or use the actual placeholder length if present
                var placeholderLength = 13;
                if ($('#phone').attr('placeholder')) {
                    placeholderLength = $('#phone').attr('placeholder').length;
                }

                // When the form is submitted, get the full phone number with the country code
                $('#career-application-form').on('submit', function() {
                    var fullPhoneNumber = iti.getNumber();
                    $("#phone").val(fullPhoneNumber); // Replace the input value with the full phone number
                });


                $.validator.addMethod("strictEmail", function(value, element) {
                    // Regular expression to ensure email has a valid domain and TLD (e.g., mmr@mmr.com)
                    return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value);
                }, "Please enter a valid email address with a proper domain.");


                // Set up the validation for the form
                $('#career-application-form').validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 3,
                            maxlength: 255
                        },
                        email: {
                            required: true,
                            email: true,
                            strictEmail: true,  // Use the custom email validation rule

                        },
                        phone: {
                            required: true,
                            minlength: 10,
                            maxlength: placeholderLength  // Dynamically use placeholder length here
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
                            maxlength: "Your phone number cannot exceed " + placeholderLength + " characters"
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
