@extends('layouts.admin.index')

@section('css')
    <!-- Light Gallery -->
    <link href="{{ asset('vendor/lightgallery/dist/css/lightgallery.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lightgallery/dist/css/lg-thumbnail.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lightgallery/dist/css/lg-zoom.css') }}" rel="stylesheet">
@endsection

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

        .gallery-img-wrapper .gallery-overlay {
            display: none;
        }

        .gallery-img-wrapper:hover .gallery-overlay {
            display: block;
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
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#homepageSectionModal">
                                {{ isset($homepageSection) ? __('homepageSections.edit_section') : __('homepageSections.add_section') }}
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
                                                        <a href="#" class="deleteSection" title="Delete"
                                                           data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="fas fa-trash"></i>
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
                <form id="homepageSectionForm" method="POST" action="{{ route('homepage-sections.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="homepageSectionModalLabel">
                            @if($homepageSection)
                                {{ __('homepageSections.edit_section') }}
                            @else
                                {{ __('homepageSections.add_section') }}
                            @endif
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            {{-- Title --}}
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('homepageSections.title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="title"
                                           id="sectionTitle"
                                           value="{{ $homepageSection->title ?? old('title') }}"
                                           class="form-control"
                                           placeholder="{{ __('homepageSections.title_placeholder') }}"
                                           required>
                                </div>
                            </div>

                            {{-- Background Image Upload --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('homepageSections.background_image') }}</label>
                                    <input type="file"
                                           name="background_image"
                                           id="backgroundImage"
                                           class="form-control"
                                           accept="image/*"
                                           onchange="previewImage(this)"
                                           @if(!$homepageSection) required @endif>
                                    <small class="text-muted">{{ __('homepageSections.image_help') }}</small>
                                </div>

                            </div>


                            {{-- Image Preview --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('homepageSections.preview') }}</label>
                                    <div class="image-preview-container" style="min-height: 250px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ddd; border-radius: 0.375rem;">
                                        @if($homepageSection && $homepageSection->background_image)
                                            <img src="{{ asset($homepageSection->background_image) }}"
                                                 alt="Current Image"
                                                 id="currentImage"
                                                 class="img-thumbnail"
                                                 style="max-width: 100%; max-height: 250px; object-fit: contain; display: block;"
                                            >
                                        @endif

                                        <img src="#"
                                             alt="Image Preview"
                                             id="imagePreview"
                                             class="img-thumbnail"
                                             style="display: none; max-width: 100%; max-height: 250px; object-fit: contain;"
                                        >

                                        @if(!$homepageSection || !$homepageSection->background_image)
{{--                                            <span class="text-muted" id="noImageText">{{ __('homepageSections.no_image_selected') }}</span>--}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('common.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('common.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.admin.modal.delete_modal')
    @include('layouts.admin.modal.message_modal')

@endsection

@section('script')
    <script src="{{ asset('vendor/lightgallery/dist/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script>
    <script src="{{ asset('vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js') }}"></script>

    <script>
        // Preview uploaded image
        function previewImage(input) {
            const current = document.getElementById('currentImage');
            const preview = document.getElementById('imagePreview');
            const noImageText = document.getElementById('noImageText');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Remove current image from DOM if it exists
                    if (current) {
                        current.remove();
                    }

                    // Hide "no image" text if it exists
                    if (noImageText) {
                        noImageText.style.display = 'none';
                    }

                    // Show new preview with consistent styling
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.style.maxWidth = '100%';
                    preview.style.maxHeight = '250px';
                    preview.style.objectFit = 'contain';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                // If no file selected, hide preview and show current image if it exists
                if (preview) {
                    preview.style.display = 'none';
                }

                if (current) {
                    current.style.display = 'block';
                } else if (noImageText) {
                    noImageText.style.display = 'block';
                }
            }
        }

        $(document).ready(function () {
            // Initialize Light Gallery
            if (document.getElementById('lightgallery')) {
                lightGallery(document.getElementById('lightgallery'), {
                    selector: '.lg-item',
                    thumbnail: true,
                    zoom: true
                });
            }

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Edit section (open modal)
            $(document).on('click', '.editSection', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('#homepageSectionModal').modal('show');
            });

            // Delete section
            $(document).on('click', '.deleteSection', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $('#delete_form').attr('action', '{{ route("homepage-sections.destroy") }}');
                $('#delete_modal').modal('show');
            });

            // Handle delete confirmation
            $('#deleteRecordBtn').click(function () {
                var form = $('#delete_form');
                $.ajax({
                    type: 'DELETE',
                    url: form.attr('action'),
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
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
                    },
                    success: function (response) {
                        $.unblockUI();
                        $('#delete_modal').modal('hide');
                        if (response.result === 'success') {
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            errorMsg(response.message);
                        }
                    },
                    error: function (xhr) {
                        $.unblockUI();
                        $('#delete_modal').modal('hide');
                        errorMsg(xhr.responseJSON?.message || 'An error occurred');
                    }
                });
            });

            // Form validation and submission
            $('#homepageSectionForm').validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 255
                    },
                    @if(!$homepageSection)
                    background_image: {
                        required: true
                    }
                    @endif
                },
                messages: {
                    title: {
                        required: 'The title field is required.',
                        maxlength: 'The title may not be greater than 255 characters.'
                    },
                    @if(!$homepageSection)
                    background_image: {
                        required: 'The background image is required.'
                    }
                    @endif
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.mb-3').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form, event) {
                    event.preventDefault();
                    submitForm(form);
                }
            });

            function submitForm(form) {
                var formData = new FormData(form);
                var url = $(form).attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
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
                    },
                    success: function (response) {
                        $.unblockUI();
                        $('#homepageSectionModal').modal('hide');

                        if (response.result === 'success') {
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            errorMsg(response.message);
                        }
                    },
                    error: function (xhr) {
                        $.unblockUI();
                        var message = xhr.responseJSON?.message || 'An error occurred';
                        if (xhr.responseJSON?.errors) {
                            message = Object.values(xhr.responseJSON.errors).join('<br>');
                        }
                        errorMsg(message);
                    }
                });
            }

            // Reset form when modal is closed
            $('#homepageSectionModal').on('hidden.bs.modal', function () {
                $('#homepageSectionForm')[0].reset();
                $('#imagePreview').hide();
                $('#currentImage').show();
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });
        });
    </script>
@endsection
