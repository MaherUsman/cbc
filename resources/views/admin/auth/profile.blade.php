@extends('layouts.admin.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Profile Update</h4>
        </div>
    </div>

    <!-- Update Profile Form -->
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Profile</h4>
                    <form
                        id="updateAdminProfile"
                        action="{{ route('admin.profile.update') }}"
                        method="POST"
                        enctype="multipart/form-data">
                    @csrf  <!-- CSRF Token for security -->

                        <!-- Name Field -->
                        <div class="mb-3 row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="name" class="form-control" id="first_name" name="first_name"
                                       value="{{Auth::user()->first_name}}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Last Name</label>
                                <input type="name" class="form-control" id="last_name" name="last_name"
                                       value="{{Auth::user()->last_name}}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Username</label>
                                <input type="name" class="form-control" id="username" name="username"
                                       value="{{Auth::user()->username}}" required>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{Auth::user()->email}}" required>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="text-muted"></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmation Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                       name="password_confirmation">
                                <small class="text-muted"></small>
                            </div>

                            <!-- Image Field -->
                            <div class="mb-3 col-md-6">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="pic" name="pic" accept="image/*"
                                       onchange="previewImage(event)">
                                <div class="mt-3">
                                    <img id="image-preview"
                                         src="{{asset(Auth::user()->pic?:'images/no-img-avatar.png')}}" alt=""
                                         class="img-thumbnail"
                                         style="max-width: 200px;">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection

@section('script')

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file instanceof Blob) {
                const reader = new FileReader();
                reader.onload = function () {
                    const output = document.getElementById('image-preview');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            } /*else {
                console.error('Invalid file object:', file);
            }*/
        }

        $(document).ready(function () {
            $.validator.addMethod("regex", function (value, element, param) {
                return this.optional(element) || param.test(value);
            }, "Invalid format.");

            $.validator.addMethod("requiredIfNotEmpty", function (value, element, param) {
                return this.optional(element) || ($(param).val() === "" && value === "") || $(param).val() !== "";
            }, "Please enter confirmation password");

            $.validator.addMethod("filesize", function (value, element, param) {
                return this.optional(element) || element.files[0].size <= param;
            }, "Max image size allowed is 5 MB");

            $.validator.addMethod("imageFileType", function (value, element) {
                // Allowed image file extensions (case-insensitive)
                var allowedExtensions = ["jpg", "jpeg", "png"];
                var fileExtension = value.split('.').pop().toLowerCase();
                console.log(fileExtension);
                if (fileExtension === '') {
                    return true;
                }
                return $.inArray(fileExtension, allowedExtensions) !== -1;
            }, "Please select a valid image file (JPG, JPEG, or PNG).");

            $('#updateAdminProfile').validate({
                rules: {
                    first_name: {
                        required: true,
                        regex: /^[a-zA-Z]+$/
                    },
                    last_name: {
                        required: true,
                        regex: /^[a-zA-Z]+$/
                    },
                    username: {
                        required: true,
                        regex: /^[a-zA-Z0-9_]+$/
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 8
                    },
                    password_confirmation: {
                        equalTo: "#password"
                    },
                    pic: {
                        imageFileType: true,
                        filesize: 5242880 // 5MB (adjust as needed)
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name",
                        minlength: "Your first name must be at least 5 characters long",
                        regex: "First name can only contain letters"
                    },
                    last_name: {
                        required: "Please enter your last name",
                        minlength: "Your last name must be at least 5 characters long",
                        regex: "Last name can only contain letters"
                    },
                    username: {
                        required: "Please enter your username",
                        minlength: "Your username must be at least 5 characters long",
                        regex: "Username can only contain letters, numbers, and underscores"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    pic: {
                        filesize: "Max image size allowed is 5 MB"
                    },
                    password: {
                        minlength: "Password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        equalTo: "Passwords do not match"
                    }
                },
                submitHandler: function (form, event) {
                    event.preventDefault();
                    var url = $(form).attr('action');
                    var data = new FormData($(form)[0]);
                    $.blockUI({
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function (response, status, xhr) {
                            $.unblockUI();
                            successMsg('Profile Updated Successfully');
                            setTimeout(function () {
                                window.location.href = "{{route('admin.dashboard')}}";
                            }, 1000);
                        },
                        error: function (xhr, status, error) {
                            if (xhr.status === 422) {
                                $.unblockUI();
                                errorMsg(xhr.responseJSON.message);
                            } else {
                                $.unblockUI();
                                errorMsg(xhr.responseJSON.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
