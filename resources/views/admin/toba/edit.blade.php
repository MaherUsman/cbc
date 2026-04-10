@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => '', 'route' =>null],
        ['name' => __('toba.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('toba.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('toba.admin.edit.edit')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('toba.update',['toba'=>$toba])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('toba.admin.edit.title')}}<span
                                                    class="text-danger">*</span> </label>
                                            <input type="text" data-rule-required="true"
                                                   data-msg-required="{{__('toba.admin.edit.title_message')}}"
                                                   name="title" value="{{$toba->title}}" class="form-control"
                                                   placeholder="{{__('toba.admin.edit.title')}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label"
                                            >{{__('toba.admin.edit.description')}}</label>
                                            <textarea name="description" id="PageDetails" rows="4" class="form-control" data-rule-required="true"
                                           data-msg-required="{{__('toba.admin.create.description_message')}}">{{$toba->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('toba.admin.edit.image')}}</label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="{{asset($toba->image?:'no_image.jpg')}}"
                                         alt="Image Preview" class="img-thumbnail"
                                         style="{{$toba->image?'':'display:none;'}} max-width:200px; height:auto;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control" id="bannerImageUpload"
                                           accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <img id="bannerImagePreview" src="{{asset($toba->banner_image?:'no_image.jpg')}}"
                                         alt="Banner Preview" class="img-thumbnail"
                                         style="{{$toba->banner_image?'':'display:none;'}} max-width:200px; height:auto;">
                                </div>
                            </div>        </div>
                                </div>


                            <a href="{{route('admin.dashboard')}}" class="btn btn-danger light btn-sl-sm" type="button">
                                {{__('toba.admin.form.cancel')}}
                            </a>
                            <button type="submit" class="btn btn-primary submit">
                                {{__('toba.admin.edit.submit')}}
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: '#PageDetails',
                skin: 'oxide',
                images_upload_url: '{{route("ckeditor.upload")}}',
                file_picker_types: 'image media',
                images_upload_handler: function (blobInfo) {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            url: '{{route("ckeditor.upload")}}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.location) {
                                    resolve(response.location);
                                } else {
                                    reject('Invalid response from server');
                                }
                            },
                            error: function (xhr) {
                                reject('Image upload failed: ' + xhr.status);
                            }
                        });
                    });
                },
                min_height: 350,
                plugins: [
                    'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                    'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'table'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media',
            });
        });

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
                document.getElementById('bannerImagePreview').style.display = 'none';
            }
        });

        $(document).ready(function () {
            var imageColName = 'pic';

            $('#formValidation').validate({
                submitHandler: async function (form, event) {
                    event.preventDefault();
                    tinymce.triggerSave();

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
                    var bannerFile = $('#bannerImageUpload')[0]?.files[0];

                    if (bannerFile) {
                        data.set('banner_image', bannerFile);
                    }

                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                data.set(imageColName, response.filePath);
                                await submitFormData(url, data);
                            } else {
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            errorMsg('An error occurred during the image upload');
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
                        window.location.href = "{{route('toba.COE')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });
    </script>
@endsection
