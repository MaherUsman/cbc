@extends('layouts.admin.index')
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('users.admin.breadcrumbs.name'), 'route' => 'user.index'],
        ['name' => __('users.admin.breadcrumbs.create'), 'route' => null]],
        'pageTitle' => __('users.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('users.admin.create.create')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('user.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.first_name')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('users.admin.create.first_name_message')}}"
                                           name="first_name" value="{{old('first_name')}}" class="form-control"
                                           placeholder="{{__('users.admin.create.first_name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.last_name')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('users.admin.create.last_name_message')}}"
                                           name="last_name" value="{{old('last_name')}}" class="form-control"
                                           placeholder="{{__('users.admin.create.last_name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.email')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="email"
                                           value="{{old('email')}}"
                                           data-rule-required="true"
                                           data-rule-email="true"
                                           data-msg-email="{{__('users.admin.create.email_validation')}}"
                                           data-msg-required="{{__('users.admin.create.email_required')}}"
                                           class="form-control" placeholder="{{__('users.admin.create.email')}}">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.username')}} </label>
                                    <input type="text"
                                           name="username" value="{{old('username')}}" class="form-control"
                                           placeholder="{{__('users.admin.create.username')}}">
                                </div>
                            </div>
                        </div><!-- Row -->
                        <div class="row">
                            {{--<div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.address')}}</label>
                                    <input type="text" value="{{old('address')}}" name="address" class="form-control"
                                           placeholder="{{__('users.admin.create.address')}}">
                                </div>
                            </div><!-- Col -->--}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.phone')}}</label>
                                    <input type="text"
                                           value="{{old('phone')}}"
                                           data-rule-required="true"
                                           data-msg-required="{{__('users.admin.create.phone_required')}}"
                                           name="phone" class="form-control"
                                           placeholder="{{__('users.admin.create.phone')}}">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.password')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" data-rule-required="true"
                                           data-msg-required="{{__('users.admin.create.required_password')}}"
                                           data-rule-minlength="8"
                                           class="form-control" placeholder="{{__('users.admin.create.password')}}">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.confirm_password')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation"
                                           data-rule-required="true"
                                           data-msg-required="{{__('users.admin.create.required_password')}}"
                                           data-rule-minlength="8"
                                           data-rule-equalTo="#password"
                                           data-msg-equalTo="{{__('users.admin.create.password_match')}}"
                                           class="form-control"
                                           placeholder="{{__('users.admin.create.confirm_password')}}">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.create.role')}}<span
                                            class="text-danger">*</span></label>
                                    <select name="role" class="form-control" data-rule-required="true"
                                            data-msg-required="{{__('users.admin.create.role_required')}}">
                                        <option value="">{{__('users.admin.create.select_role')}}</option>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('user.admin.create.image')}}</label>
                                    <input type="file" name="pic" class="form-control" id="imageUpload"
                                           accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <a href="{{route('user.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('users.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('users.admin.create.submit')}}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('imageUpload').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('imagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').style.display = 'none';
            }
        });

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

            $('#formValidation').validate({
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
                        regex: /^[a-zA-Z0-9_.-]+$/
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        regex: /^[0-9-]+$/
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
                    phone: {
                        required: "Please enter your Phone number",
                        regex: "Please enter a valid Phone number"
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
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.href = "{{route('user.index')}}";
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
