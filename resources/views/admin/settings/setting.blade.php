@extends('layouts.admin.index')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-3">Settings Update</h4>
        </div>
    </div>

    <!-- Update Profile Form -->
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form
                        id="updateAdminProfile"
                        action="{{ route('admin.settings.update') }}"
                        method="POST"
                        enctype="multipart/form-data">
                    @csrf  <!-- CSRF Token for security -->

                        <!-- Name Field -->
                        <div class="mb-3 row">
{{--                            <div class="mb-3 col-md-12">--}}
{{--                                <label for="name" class="form-label">{{__('setting.address')}}</label>--}}
{{--                                <input type="name" class="form-control" id="address" name="address"--}}
{{--                                       value="{{$settings->address}}" required>--}}
{{--                            </div>--}}
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{__('setting.phone')}}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{$settings->phone}}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{__('setting.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{$settings->email}}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">{{__('setting.zoo_map')}}</label>
                                <input type="text" class="form-control" id="zoo_map" name="zoo_map"
                                       value="{{$settings->zoo_map}}" required>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{__('setting.copyright_text')}}</label>
                                <input type="text" class="form-control" id="copyright_text" name="copyright_text"
                                       value="{{$settings->copyright_text}}" required>
                            </div>
                            <!-- Email Field -->
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">{{__('setting.copyright_link')}}</label>
                                <input type="text" class="form-control" id="copyright_link" name="copyright_link"
                                       value="{{$settings->copyright_link}}" required>
                            </div>
                            <!-- Email Field -->
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">{{__('setting.copyright_link_name')}}</label>
                                <input type="text" class="form-control" id="copyright_link_name" name="copyright_link_name"
                                       value="{{$settings->copyright_link_name}}" required>
                            </div>


                            <!-- Image Field -->
{{--                            <div class="mb-3 col-md-6">--}}
{{--                                <label for="image" class="form-label">{{__('setting.logo')}}</label>--}}
{{--                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*"--}}
{{--                                       onchange="previewImage(event)">--}}
{{--                                <div class="mt-3">--}}
{{--                                    <img id="image-preview"--}}
{{--                                         src="{{asset($settings->logo?:'images/no-img-avatar.png')}}" alt=""--}}
{{--                                         class="img-thumbnail"--}}
{{--                                         style="max-width: 200px;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                            <div>
                                <h4 class="mb-3 mb-md-3">Home Counter Data Update</h4>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Email Field -->
                            @php
                                $homeCounter = json_decode($settings->home_counter, true);
                            @endphp

                            @foreach($homeCounter['home_counter_name'] as $count)
                            <div class="mb-3 col-md-3">
                                <label for="email" class="form-label">{{__('setting.home_counter_name')}}</label>
                                <input type="text" class="form-control" id="home_counter_name" name="home_counter_name[]"
                                       value="{{$count??''}}">
                            </div>
                            @endforeach
                            <!-- Email Field -->
                            @foreach($homeCounter['home_count'] as $count)
                            <div class="mb-3 col-md-3">
                                <label for="text" class="form-label">{{__('setting.home_counter_value')}}</label>
                                <input type="text" class="form-control" id="home_count" name="home_count[]"
                                       data-rule-required="true"
                                       data-msg-required="sdfsdf"
                                       value="{{$count??''}}">
                            </div>
                            @endforeach
                            <!-- Email Field -->
                            @foreach($homeCounter['icon_class'] as $count)
                            <div class="mb-3 col-md-3">
                                <label for="email" class="form-label">{{__('setting.home_counter_icon')}}</label>
                                <input type="text" class="form-control" id="icon_class" name="icon_class[]"
                                       value="{{$count??''}}">
                            </div>
                            @endforeach
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
                            successMsg('Settings Updated Successfully');
                            setTimeout(function () {
                                window.location.href = "{{route('admin.settings')}}";
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
