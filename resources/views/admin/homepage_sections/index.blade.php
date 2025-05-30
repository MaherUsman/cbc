@extends('layouts.admin.index')
@section('css')
    <!-- Light Gallery -->
    <link href="{{ asset('vendor/lightgallery/dist/css/lightgallery.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lightgallery/dist/css/lg-thumbnail.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lightgallery/dist/css/lg-zoom.css') }}" rel="stylesheet">
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

    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [
            ['name' => __('homepageSections.name'), 'route' => null]
        ],
        'pageTitle' => __('homepageSections.name')
    ])

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                {{-- You can add nav pills here if needed --}}
            </ul>
        </div>

        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4 class="card-title">{{ __('homepageSections.list_title') }}</h4> --}}
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#homepageSectionModal">
                                {{ __('homepageSections.add_section') }}
                            </button>
                        </div>
                        <div class="card-body pb-1">
                            <div id="lightgallery" class="row">
                                @isset($homepageSection)
                                    <div class="col-lg-3 col-md-6 mb-4">
                                        <div class="gallery-img-wrapper position-relative w-100 h-100">
                                            <a href="{{ asset($homepageSection->background_image) }}"
                                               data-src="{{ asset($homepageSection->background_image) }}"
                                               class="lg-item">
                                                <img src="{{ asset($homepageSection->background_image) }}" class="rounded" alt=""
                                                     style="width:100%;">
                                            </a>
                                            <div class="gallery-overlay rounded">
                                                <div class="overlay-icons-wrapper w-100 d-flex flex-column align-items-end">
                                                    <div class="overlay-icon mt-2">
                                                        <a href="#" data-url="{{ route('homepage-sections.destroy', $homepageSection) }}" title="Delete"
                                                           class="deleteRecord" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="img-title mt-3">
                                                    <p>{{ $homepageSection->title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-center text-muted">{{ __('homepageSections.no_section') }}</p>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="homepageSectionModal" tabindex="-1" aria-labelledby="homepageSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="formValidation" action="{{ route('homepage-sections.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="POST" id="formMethod">
                    <input type="hidden" name="section_id" value="" id="sectionId">

                    <div class="modal-header">
                        <h5 class="modal-title" id="homepageSectionModalLabel">Create/Edit Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- Title --}}
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('homepageSections.admin.create.title') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="sectionTitle" value="{{ old('title') }}" class="form-control"
                                           placeholder="{{ __('homepageSections.admin.create.title') }}"
                                           data-rule-required="true"
                                           data-msg-required="{{ __('homepageSections.admin.create.title_message') }}">
                                </div>
                            </div>

                            {{-- Background Image --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('homepageSections.admin.create.background_image') }}</label>
                                    <input type="file" name="background_image" id="backgroundImage" class="form-control" accept="image/*" onchange="previewImage(this)">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
{{--                                    <label class="form-label">Current/Preview Image</label>--}}
                                    <div class="image-preview-container">
                                        <img src="#" alt="Image Preview" id="imagePreview" class="img-thumbnail"
                                             style="display:none; max-width:200px; height:auto;">
                                        <div id="currentImageContainer" style="display:none;">
                                            <img src="#" alt="Current Image" id="currentImage" class="img-thumbnail"
                                                 style="max-width:200px; height:auto;">
                                            <div class="text-center mt-2">
                                                <small class="text-muted">Current Image</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary light" data-bs-dismiss="modal">{{ __('homepageSections.cancel') }}</button>
                        <button type="submit" class="btn btn-primary submit">{{ __('homepageSections.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.admin.modal.delete_modal')
    @include('layouts.admin.modal.message_modal')

    <div id="loader" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">{{ __('common.loading') }}</span>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('vendor/lightgallery/dist/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js') }}"></script>

    <script>
        // Function to preview the selected image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Hide current image and show preview
                    $('#currentImageContainer').hide();
                    $('#imagePreview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        // Reset modal when opening for new section
        $('#homepageSectionModal').on('hidden.bs.modal', function () {
            $('#formValidation')[0].reset();
            $('#sectionId').val('');
            $('#formMethod').val('POST');
            $('#formValidation').attr('action', '{{ route("homepage-sections.store") }}');
            $('#homepageSectionModalLabel').text('{{ __("Create/Edit Modal") }}');
            $('#imagePreview').hide();
            $('#currentImageContainer').hide();
            // Clear file input
            $('#backgroundImage').val('');
        });

        // Handle new section button click
        $('.btn[data-bs-target="#homepageSectionModal"]').on('click', function() {
            // Reset form for new section
            $('#formValidation')[0].reset();
            $('#sectionId').val('');
            $('#formMethod').val('POST');
            $('#formValidation').attr('action', '{{ route("homepage-sections.store") }}');
            $('#homepageSectionModalLabel').text('{{ __("Create/Edit Modal") }}');
            $('#imagePreview').hide();
            $('#currentImageContainer').hide();
            $('#backgroundImage').val('');
        });

        $(document).ready(function () {
            // Initialize Light Gallery
            if (document.getElementById('lightgallery')) {
                lightGallery(document.getElementById('lightgallery'), {
                    thumbnail: true,
                    zoom: true
                });
            }

            // Delete record functionality
            // Delete record functionality with proper event handling to prevent lightbox
            $(document).on('click', '.deleteRecord', function (e) {
                // Prevent all default behaviors and event bubbling
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();

                var url = $(this).data('url');
                $('#delete_form').attr('action', url);
                $('#delete_modal').modal('show');

                // Return false as additional prevention
                return false;
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
                        if (xhr.status == 204 || (response.result && response.result === 'success')) {
                            $.unblockUI();
                            $('#delete_modal').modal('hide'); // Hide modal before reload
                            successMsg(response.message || '{{ __("common.deleted_successfully") }}');
                            setTimeout(function () {
                                window.location.reload(true); // Force reload from server
                            }, 1000);
                        } else if (response.result === 'error') {
                            $.unblockUI();
                            errorMsg(response.message);
                        }
                    },
                    error: function (data, status) {
                        $.unblockUI();
                        $('#delete_modal').modal('hide'); // Hide modal on error too
                        errorMsg(data.responseJSON?.message || '{{ __("common.error_occurred") }}');
                    }
                });
            });
            // Form validation and submission
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
                    var data = new FormData();

                    // Get form data
                    data.append('title', $('#sectionTitle').val());
                    // data.append('button_text', $('#buttonText').val());
                    // data.append('button_link', $('#buttonLink').val());

                    if ($('#sectionId').val()) {
                        data.append('section_id', $('#sectionId').val());
                        data.append('_method', 'PUT');
                    }

                    // Handle image upload
                    var imageFile = $('#backgroundImage')[0].files[0];
                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                data.append('background_image', response.filePath);
                                data.append('thumb', response.thumb);
                                data.append('compressed', response.compressed);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                                return;
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the image upload');
                            return;
                        }
                    }

                    // Submit form data
                    await submitFormData(url, data);
                }
            });

            // Chunked image upload function
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
                    chunkData.append('ImageUploadPath', 'homepage_background');

                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                    try {
                        let response = await $.ajax({
                            type: 'POST',
                            url: '{{ route("uploadImageChunk") }}',
                            data: chunkData,
                            processData: false,
                            contentType: false,
                        });

                        currentChunk++;
                        if (currentChunk === totalChunks) {
                            return {
                                success: true,
                                filePath: response.filePath,
                                thumb: response.thumbnailPath,
                                compressed: response.compressedPath
                            };
                        }
                    } catch (error) {
                        return {success: false, error: error};
                    }
                }
            }

            // Submit form data function
            async function submitFormData(url, data) {
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
                    successMsg(response.message || '{{ __("common.saved_successfully") }}');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON?.message || '{{ __("common.error_occurred") }}');
                }
            }
        });
    </script>
@endsection
