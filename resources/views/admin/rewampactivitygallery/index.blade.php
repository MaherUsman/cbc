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

    @include('layouts.admin.includes.breadcrumbs' , ['breadcrumbs' => [['name' =>  'Activity Gallery' , 'route' => null]],
'pageTitle' => 'Activity Gallery'
])

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                {{--<li class="nav-item"><a href="{{route('toba-galleries.index')}}#list-view" data-bs-toggle="tab"
                                        class="nav-link me-1 show active">{{ __('tobaGallery.list_view') }}</a></li>--}}
                {{--<li class="nav-item"><a href="{{route('toba-galleries.gridView')}}#grid-view" --}}{{--data-bs-toggle="tab"--}}{{--
                    class="nav-link">{{ __('tobaGallery.grid_view') }}</a></li>--}}
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            {{--                            <h4 class="card-title">{{ __('tobaGallery.list_tobaGallery') }}</h4>--}}
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Activity Gallery</button>
                            {{--                            <a href="{{ route('toba-galleries.create') }}"--}}
                            {{--                               class="btn btn-primary">{{ __('tobaGallery.add_tobaGallery') }}</a>--}}
                        </div>
                        <div class="card-body pb-1">
                            <div id="lightgallery" class="row">
                                @foreach($tobaGalleries as $gallery)
                                    <div class="col-lg-3 col-md-6 mb-4">
                                        <div class="gallery-img-wrapper position-relative w-100 h-100">
                                            <a
                                                href="{{asset($gallery->image)}}"
                                                data-src="{{asset($gallery->image)}}"
                                                class="lg-item"
                                            >
                                                <img
                                                    src="{{asset($gallery->image)}}"
                                                    class="rounded" alt=""
                                                    style="width:100%;"
                                                >
                                            </a>
                                            <div class="gallery-overlay rounded">
                                                <div class="overlay-icons-wrapper w-100 d-flex flex-column align-items-end">
                                                    <div class="overlay-icon">
                                                        <a href="{{route('rewap_activity_sub_gallery.index', $gallery->id)}}" title="Add Child Gallery Images" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div class="overlay-icon mt-2">
                                                        <a href="{{route('rewap_activity_gallery.edit', $gallery)}}" title="Edit Gallery Image" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>
                                                    <div class="overlay-icon mt-2">
                                                        <a href="#" data-url="{{ route('rewap_activity_gallery.destroy', $gallery) }}" title="Delete"
                                                           class="deleteRecord" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="img-title mt-3">
                                                    <p>{{$gallery->title}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="basicModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" id="formValidation" action="{{route('rewap_activity_gallery.store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('activityGallery.admin.create.create')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row rowTemplate">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label">{{__('tobaGallery.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('tobaGallery.admin.create.title_message')}}"
                                           name="title[]" class="form-control"
                                           placeholder="{{__('tobaGallery.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('tobaGallery.admin.create.show_on_navbar') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="show_on_navbar[]" id="show_on_navbar" class="form-control" data-rule-required="true"
                                            data-msg-required="{{ __('tobaGallery.admin.create.show_on_navbar_message') }}">
                                        <option value="1">{{ __('Yes') }}</option>
                                        <option value="0">{{ __('No') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label">{{__('tobaGallery.admin.create.image')}}<span
                                            class="text-danger">(368 × 422)*</span></label>
                                    <input type="file" name="image[]" class="form-control" accept="image/*"
                                           data-rule-required="true" onchange="previewImage(this)"
                                           data-msg-required="{{__('tobaGallery.admin.create.image_message')}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <img src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit">{{__('tobaGallery.admin.create.submit')}}</button>
                    </div>
                </form>
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

            $(document).on('click', '.deleteRecord', function () {
                var url = $(this).data('url');
                $('#delete_form').attr('action', url);
                $('#delete_modal').modal('show');
            });
            $('#deleteRecordBtn').click(function () {
                var url = $('#delete_form').attr('action');
                var data = $('#delete_form').serialize();
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
                    success: function (response, status, xhr) {
                        if (xhr.status == 204) {
                            $.unblockUI();
                            successMsg('Deleted Successfully!');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else if (response.result == 'success') {
                            $.unblockUI();
                            successMsg(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else if (response.result == 'error') {
                            $.unblockUI();
                            errorMsg(response.message);
                        }
                    },
                    error: function (data, status) {
                        if (data.status == 422) {
                            $.unblockUI();
                            errorMsg(data.responseJSON.message);
                        } else {
                            $.unblockUI();
                            errorMsg(data.responseJSON.message);
                        }
                    }
                });
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

                    const showOnNavbarVal = $('#show_on_navbar').val();  // "0" or "1"
                    data.append('show_on_navbar', showOnNavbarVal);

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
                    setTimeout(function () {
                        location.reload()
                    }, 1000);
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

