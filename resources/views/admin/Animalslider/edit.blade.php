@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('sliders.admin.breadcrumbs.name'), 'route' =>'slider-animals.index'],
        ['name' => __('sliders.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('sliders.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('sliders.admin.edit.edit')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('slider-animals.update',['slider_animal'=>$slider_animal])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.edit.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('sliders.admin.edit.title_message')}}"
                                           name="title" value="{{$slider_animal->title}}" class="form-control"
                                           placeholder="{{__('sliders.admin.edit.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.edit.slink')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-rule-maxlength="255"
                                           data-msg-required="{{__('sliders.admin.edit.slink_message')}}"
                                           name="slink" value="{{$slider_animal->slink}}" class="form-control"
                                           placeholder="{{__('sliders.admin.edit.slink')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label"
                                    >{{__('sliders.admin.edit.details')}}</label>
                                    <textarea name="details" id="ckeditor">{{$slider_animal->details}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.edit.imageOrVideo')}}</label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*,video/*">
                                    <input type="hidden" name="is_image" value="{{$slider_animal->is_image?1:0}}" id="is_image">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="{{asset($slider_animal->image?:'no_image.jpg')}}"
                                         alt="Image Preview" class="img-thumbnail"
                                         style="{{$slider_animal->is_image?'':'display:none;'}} max-width:200px; height:auto;">
                                    <video id="videoPreview" src="{{asset($slider_animal->image?:'no_image.jpg')}}" controls style="{{$slider_animal->is_image?'display:none;':''}} max-width:200px; height:auto;"></video>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <a href="{{route('slider-animals.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('sliders.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('sliders.admin.edit.submit')}}
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
            const imagePreview = document.getElementById('imagePreview');
            const videoPreview = document.getElementById('videoPreview');
            const is_image = document.getElementById('is_image');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (file.type.startsWith('image/')) {
                        imagePreview.style.display = 'block';
                        videoPreview.style.display = 'none';
                        imagePreview.src = e.target.result;
                        is_image.value=1;
                    } else if (file.type.startsWith('video/')) {
                        videoPreview.style.display = 'block';
                        imagePreview.style.display = 'none';
                        videoPreview.src = e.target.result;
                        is_image.value=0;
                    }
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
                videoPreview.style.display = 'none';
                is_image.value='';
            }
        });

        $(document).ready(function () {
            var imageColName = 'pic';

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
                    var file = $('#imageUpload')[0].files[0];
                    var isImage = $('#is_image').val() === '1';

                    if (file) {
                        try {
                            let response;
                            if (isImage) {
                                // Use chunk upload for images
                                response = await uploadImageInChunks(file);
                                if (response.success) {
                                    data.set(imageColName, response.filePath);
                                } else {
                                    $.unblockUI();
                                    errorMsg('Image upload failed');
                                    return;
                                }
                            } else {
                                // Direct upload for videos
                                response = await uploadVideo(file);
                                if (response.success) {
                                    data.set(imageColName, response.filePath);
                                } else {
                                    $.unblockUI();
                                    errorMsg('Video upload failed');
                                    return;
                                }
                            }
                            await submitFormData(url, data);
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the upload');
                        }
                    } else {
                        await submitFormData(url, data);
                    }
                }
            });

            async function uploadVideo(file) {
                var formData = new FormData();
                formData.append('video', file);
                formData.append('_token', "{{ csrf_token() }}");

                try {
                    let response = await $.ajax({
                        type: 'POST',
                        url: '{{ route('uploadVideo') }}', // You'll need to create this route
                        data: formData,
                        processData: false,
                        contentType: false,
                    });
                    return {
                        success: true,
                        filePath: response.filePath
                    };
                } catch (error) {
                    return {
                        success: false,
                        error: error
                    };
                }
            }

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
                        window.location.href = "{{route('slider-animals.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });
    </script>
@endsection
