@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('animalCategories.admin.breadcrumbs.name'), 'route' => 'animal-categories.index'],
        ['name' => __('animalCategories.admin.breadcrumbs.create'), 'route' => 'animal-categories.create']],
        'pageTitle' => __('animalCategories.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('animalCategories.admin.create.create')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('animal-categories.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animalCategories.admin.create.name')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animalCategories.admin.create.name_message')}}"
                                           name="name" value="{{old('title')}}" class="form-control"
                                           placeholder="{{__('animalCategories.admin.create.name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animalCategories.admin.create.slug')}}<span
                                            class="text-danger"></span> </label>
                                    <input type="text"
                                           name="slug" value="{{old('slug')}}" class="form-control"
                                           placeholder="{{__('animalCategories.admin.create.slug')}}">
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animalCategories.admin.create.image')}}</label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <a href="{{route('animal-categories.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('animalCategories.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('animalCategories.admin.create.submit')}}
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
            // Initialize TinyMCE
            tinymce.init({
                selector: '#description',
                skin: 'oxide',
                images_upload_url: '{{route('ckeditor.upload')}}',
                file_picker_types: 'image media',
                min_height: 350,
                default_text_color: 'red',
                plugins: [
                    'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                    'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'table'
                ],
                toolbar1: 'dropcaps | undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
            });

            var imageColName = 'image';

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

                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                data.set(imageColName, response.filePath);
                                await submitFormData(url, data);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the image upload');
                        }
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
                        window.location.href = "{{route('animal-categories.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });

    </script>
@endsection
