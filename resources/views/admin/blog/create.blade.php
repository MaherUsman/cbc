@extends('layouts.admin.index')
@section('css')
    {{-- <!-- Pick date -->--}}
    <link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
    <link href="{{asset('vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('blogs.admin.breadcrumbs.name'), 'route' => 'blogs.index'],
        ['name' => __('blogs.admin.breadcrumbs.create'), 'route' => 'blogs.create']],
        'pageTitle' => __('blogs.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('blogs.admin.create.create')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('blogs.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('blogs.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('blogs.admin.create.title_message')}}"
                                           name="title" value="{{old('title')}}" class="form-control"
                                           placeholder="{{__('blogs.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('blogs.admin.create.slug')}}<span
                                            class="text-danger"></span> </label>
                                    <input type="text"
                                           name="slug" value="{{old('slug')}}" class="form-control"
                                           placeholder="{{__('blogs.admin.create.slug')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <label class="form-label">{{__('blogs.admin.create.start_time')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group clockpicker">
                                            <input name="time" type="text" class="form-control" data-rule-required="true" autocomplete="off"
                                                   data-msg-required="{{__('blogs.admin.create.start_time_message')}}"
                                                   placeholder="{{__('blogs.admin.create.start_time')}}">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label"
                                           for="datepicker">{{__('blogs.admin.create.start_date')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="input-hasicon mb-xl-0 mb-3">
                                        <input name="start_date"
                                               class="datepicker-default form-control" autocomplete="off"
                                               data-rule-required="true"
                                               data-msg-required="{{__('blogs.admin.create.start_date_message')}}"
                                               id="datepicker" value="{{old('start_date')}}"
                                               placeholder="{{__('blogs.admin.create.start_date')}}">
                                        <div class="icon"><i class="far fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label"
                                           >{{__('blogs.admin.create.details')}}<span class="text-danger">*</span></label>
                                    <textarea name="details" id="ckeditor" data-rule-required="true"
                                              data-msg-required="{{__('blogs.admin.create.address_message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label"
                                    >{{__('blogs.admin.create.address')}}<span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" data-rule-required="true"
                                              data-msg-required="{{__('blogs.admin.create.address_message')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('blogs.admin.create.image')}}
                                        <span class="text-danger">(770 x 417)</span>
                                    </label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('blogs.admin.create.banner_image')}}
                                        <span class="text-danger">(1894 x 496)</span>
                                    </label>
                                    <input type="file" name="banner_image" class="form-control" id="bannerImageUpload"
                                           accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <img id="bannerImagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <a href="{{route('blogs.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('blogs.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('blogs.admin.create.submit')}}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- pickdate -->
    <script src="{{asset('vendor/pickadate/picker.js')}}"></script>
    <script src="{{asset('vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>

    <!-- Pickdate -->
    <script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>
    <script src="{{asset('js/plugins-init/clock-picker-init.js')}}"></script>

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

        document.getElementById('bannerImageUpload').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('bannerImagePreview').style.display = 'block';
                    document.getElementById('bannerImagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').style.display = 'none';
            }
        });

        $(document).ready(function () {
            var imageColName = 'image';

            $('#formValidation').validate({
                submitHandler: async function (form, event) {
                    event.preventDefault();

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

                    var url = $(form).attr('action');
                    var imageColName = $('#imageUpload').attr('name');
                    var data = new FormData($(form)[0]);
                    var imageFile = $('#imageUpload')[0].files[0];

                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                data.set(imageColName, response.filePath);
                                // await submitFormData(url, data);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the image upload');
                        }
                    }

                    var bannerImageColName = $('#bannerImageUpload').attr('name');
                    var bannerImageFile = $('#bannerImageUpload')[0].files[0];

                    if (bannerImageFile) {
                        try {
                            let response = await uploadImageInChunks(bannerImageFile);
                            if (response.success) {
                                data.set(bannerImageColName, response.filePath);
                                // console.log(data, 'adil here');
                                await submitFormData(url, data);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the banner Image upload');
                        }
                    } else {
                        await submitFormData(url, data);
                    }
                }
            });

            async function uploadImageInChunks(file) {
                var chunkSize = 1024 * 1024 * 2; // 2MB chunk size
                var totalChunks = Math.ceil(file.size / chunkSize);
                var currentChunk = 0;

                while (currentChunk < totalChunks) {
                    var start = currentChunk * chunkSize;
                    var end = Math.min(start + chunkSize, file.size);
                    var chunk = file.slice(start, end);
                    var chunkData = new FormData();
                    chunkData.append('chunk', chunk);
                    chunkData.append('chunkNumber', currentChunk + 1);
                    chunkData.append('totalChunks', totalChunks);
                    chunkData.append('fileName', file.name);
                    chunkData.append('ImageUploadPath', imageColName);

                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                    try {
                        let response = await $.ajax({
                            type: 'POST',
                            url: '{{route("uploadImageChunk")}}',
                            data: chunkData,
                            processData: false,
                            contentType: false,
                        });

                        currentChunk++;
                        if (currentChunk === totalChunks) {
                            return {success: true, filePath: response.filePath};
                        }
                    } catch (error) {
                        return {success: false, error: error};
                    }
                }
            }

            async function submitFormData(url, data) {
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

                try {
                    let response = await $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        processData: false,
                        contentType: false,
                    });
                    $.unblockUI();
                    successMsg(response.message);
                    setTimeout(function () {
                        window.location.href = "{{route('blogs.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });

    </script>
@endsection
