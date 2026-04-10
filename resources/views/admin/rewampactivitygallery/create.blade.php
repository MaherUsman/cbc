@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('activityGallery.admin.create.create'), 'route' => 'toba-galleries.index'],
        ['name' => __('activityGallery.admin.create.create'), 'route' => 'toba-galleries.create']],
        'pageTitle' => __('activityGallery.admin.create.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('tobaGallery.admin.breadcrumbs.name')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('toba-galleries.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row rowTemplate">
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">{{__('tobaGallery.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('tobaGallery.admin.create.title_message')}}"
                                           name="title[]" class="form-control"
                                           placeholder="{{__('tobaGallery.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-2">
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
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">{{__('tobaGallery.admin.create.image')}}<span
                                            class="text-danger">(370 x 422)*</span></label>
                                    <input type="file" name="image[]" class="form-control" accept="image/*"
                                           data-rule-required="true" onchange="previewImage(this)"
                                           data-msg-required="{{__('tobaGallery.admin.create.image_message')}}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label class="form-label">Banner Image<span class="text-danger">(1920 x 350)</span></label>
                                    <input type="file" name="banner_image[]" class="form-control" accept="image/*"
                                           onchange="previewBannerImageFile(this)">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <img src="#" alt="Image Preview" class="img-thumbnail img-preview"
                                         style="display:none; max-width:100px; height:auto;">
                                    <img src="#" alt="Banner Preview" class="banner-preview img-thumbnail"
                                         style="display:none; max-width:150px; height:auto;">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary addRow">+</button>
                            </div>
                        </div>

                        <a href="{{route('toba-galleries.index')}}" class="btn btn-danger light btn-sl-sm"
                           type="button">
                            {{__('tobaGallery.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('tobaGallery.admin.create.submit')}}
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function () {
            // Function to validate if current row has both title and image filled
            function validateRow($row) {
                let titleFilled = $row.find('input[name="title[]"]').val().trim() !== '';
                let imageFilled = $row.find('input[name="image[]"]').val() !== '';
                return titleFilled && imageFilled;
            }

            // Add Row functionality
            function addRow() {
                // Clone the first row, remove its content
                let $newRow = $('.rowTemplate').first().clone();
                $newRow.find('input').val('');
                $newRow.find('input[type="file"]').val('');
                $newRow.find('img').hide();

                // Add "Add Row" button to new row
                $newRow.find('.removeRow').removeClass('btn-danger removeRow').addClass('btn-primary addRow').text('+');

                // Append new row after the last one
                $('.rowTemplate').last().after($newRow);

                return $newRow;
            }

            // Handle Add Row Button Click
            $(document).on('click', '.addRow', function () {
                let $currentRow = $(this).closest('.rowTemplate');

                // Validate current row before adding new one
                if (validateRow($currentRow)) {
                    // Change current "Add Row" button to "Remove"
                    $(this).removeClass('btn-primary addRow').addClass('btn-danger removeRow').text('-');

                    // Add the new row
                    addRow();
                } else {
                    alert('Please fill both title and image fields before adding a new row.');
                }
            });

            // Handle Remove Row Button Click
            $(document).on('click', '.removeRow', function () {
                $(this).closest('.rowTemplate').remove();
            });
        });

        // Function to preview the selected image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Find the nearest thumb element in the same row and display it
                    $(input).closest('.rowTemplate').find('.img-preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]); // Convert the file to a URL
            }
        }
        
        function previewBannerImageFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Find the nearest banner preview in the same row
                    $(input).closest('.rowTemplate').find('.banner-preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
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
                    
                    var titleInputs = $('input[name="title[]"]');
                    var imageInputs = $('input[name="image[]"]');
                    var navbarInputs = $('select[name="show_on_navbar[]"]');
                    var bannerInputs = $('input[name="banner_image[]"]');
                    
                    titleInputs.each(function (index, element) {
                        data.append('title[]', $(element).val());
                    });
                    navbarInputs.each(function (index, element) {
                        data.append('show_on_navbar[]', $(element).val());
                    });
                    bannerInputs.each(function (index, element) {
                        if (element.files.length > 0) {
                            data.append('banner_image['+index+']', element.files[0]);
                        }
                    });

                    try {
                        for (let i = 0; i < imageInputs.length; i++) {
                            let imageFile = imageInputs[i].files[0]; // Get file from each input

                            if (imageFile) {
                                let response = await uploadImageInChunks(imageFile, i);
                                if (response.success) {
                                    data.append(`image[${i}]`, response.filePath);
                                    data.append(`thumb`, response.thumbnailPath);
                                    data.append(`compressed`, response.compressedPath);
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
                        window.location.href = "{{route('toba-galleries.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });


    </script>
@endsection
