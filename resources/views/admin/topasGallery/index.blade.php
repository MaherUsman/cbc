@extends('layouts.admin.index')
@section('css')
    <!-- Light Gallery -->
    <link href="{{asset('vendor/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/lightgallery/dist/css/lg-thumbnail.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/lightgallery/dist/css/lg-zoom.css')}}" rel="stylesheet">
@endsection
@section('content')

    <style>
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                {{--<li class="nav-item"><a href="{{route('topas-galleries.index')}}#list-view" data-bs-toggle="tab"
                                        class="nav-link me-1 show active">{{ __('topasGallery.list_view') }}</a></li>--}}
                {{--<li class="nav-item"><a href="{{route('topas-galleries.gridView')}}#grid-view" --}}{{--data-bs-toggle="tab"--}}{{--
                    class="nav-link">{{ __('topasGallery.grid_view') }}</a></li>--}}
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('topasGallery.page_content') }}</h4>

                        </div>

                        <div class="card-body pb-1">
                            <div class="mb-3">
                                <form method="POST" id="formValidationn" action="{{route('galleriesContent.store')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="type" value="topas">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">{{__('blogs.admin.create.title')}}<span
                                                        class="text-danger"></span> </label>
                                                <input type="text" data-rule-required="false"
                                                       data-msg-required="{{__('blogs.admin.create.title_message')}}"
                                                       name="title" value="{{$topasGalleriesContent->data['title']??''}}" class="form-control"
                                                       placeholder="{{__('blogs.admin.create.title')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label"
                                                >{{__('blogs.admin.create.details')}}<span class="text-danger"></span></label>
                                                <textarea name="details" id="ckeditor" data-rule-required="true"
                                                          data-msg-required="{{__('blogs.admin.create.address_message')}}">{{$topasGalleriesContent->data['details']??''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('admin.dashboard')}}" class="btn btn-danger light btn-sl-sm" type="button">
                                        {{__('blogs.admin.form.cancel')}}
                                    </a>
                                    <button type="submit" class="btn btn-primary submit">
                                        {{__('blogs.admin.create.submit')}}
                                    </button>
                                </form>

                            </div>
                            <hr>
                            <div id="lightgallery" class="row">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">{{ __('topasGallery.list_topasGallery') }}</h4>
                                    <a type="button" class="btn btn-primary mb-2" href="{{ route('topas-galleries.create', $tobas->id) }}">{{ __('topasGallery.add_topasGallery') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.admin.modal.delete_modal')
    @include('layouts.admin.modal.message_modal')
    <div id="loader" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('vendor/lightgallery/dist/lightgallery.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.messageDetails', function () {
                var details = $(this).data('details');
                $('#messageText').html(details);
                $('#message_modal').modal('show');
            });

            $('#formValidationn').validate({
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
                    var data = new FormData($(form)[0]);

                    await submitFormData(url, data);
                }
            });

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
                    //var data = new FormData($(form)[0]); // Form data including all images and titles
                    var data = new FormData();
                    // Get all file input elements
                    var titleInputs = $('input[name="title[]"]');
                    var imageInputs = $('input[name="image[]"]');
                    titleInputs.each(function (index, element) {
                        data.append('title[]', $(element).val());
                    });

                    try {
                        for (let i = 0; i < imageInputs.length; i++) {
                            let imageFile = imageInputs[i].files[0]; // Get file from each input

                            if (imageFile) {
                                let response = await uploadImageInChunks(imageFile, i);
                                if (response.success) {
                                    data.append(`image[${i}]`, response.filePath);
                                    data.append(`thumb`, response.thumb);
                                    data.append(`compressed`, response.compressed);
                                } else {
                                    $.unblockUI();
                                    errorMsg('Image upload failed');
                                    return;
                                }
                            }
                        }

                        await submitFormData(url, data);
                    } catch (error) {
                        $.unblockUI();
                        errorMsg('An error occurred during the image upload');
                    }
                }
            });


            async function uploadImageInChunks(file, index) {
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
                    chunkData.append('ImageUploadPath', `image`);//`image[${index}]`

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
                            return {success: true,
                                filePath: response.filePath,
                                thumb: response.thumbnailPath,
                                compressed: response.compressedPath};
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
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});
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
                    {{--setTimeout(function () {--}}
                    {{--    window.location.href = "{{route('topas-galleries.index', )}}";--}}
                    {{--}, 1000);--}}
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });

        // Function to preview the selected image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Find the nearest image element in the same row and display it
                    $(input).closest('.rowTemplate').find('img').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]); // Convert the file to a URL
            }
        }
    </script>
@endsection

