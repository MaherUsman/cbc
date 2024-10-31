@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('animals.admin.breadcrumbs.name'), 'route' => 'animals.index'],
        ['name' => __('animals.admin.breadcrumbs.create'), 'route' => 'animals.create']],
        'pageTitle' => __('animals.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('animals.admin.create.create')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('animals.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row {{--bg-blue-light pt-2 rounded--}}">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.title_message')}}"
                                           name="title" value="{{old('title')}}" class="form-control"
                                           placeholder="{{__('animals.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.category_id')}}</label>
                                    <select class="form-control" name="category_id" data-rule-required="true"
                                            data-msg-required="{{__('animals.admin.create.category_id_message')}}">
                                        <option value="">Select Category</option>
                                        @foreach($animalCategories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.slug')}}</label>
                                    <input type="text" data-rule-required="false"
                                           data-msg-required="{{__('animals.admin.create.slug_message')}}"
                                           name="slug" value="{{old('slug')}}" class="form-control"
                                           placeholder="{{__('animals.admin.create.slug')}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.create.details')}}<span
                                            class="text-danger">*</span></label>
                                    <textarea name="details" id="ckeditor" data-rule-required="true"
                                              data-msg-required="{{__('animals.admin.create.details_message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.image')}}<span
                                            class="text-danger">* (1170 x 877)</span></label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.image_message')}}">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.home_image')}}<span
                                            class="text-danger">*(252 x 452)</span></label>
                                    <input type="file" id="homeImageUpload" name="home_image" class="form-control imageUpload"
                                           accept="image/*" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.home_image_message')}}">
                                </div>
                                <div class="mb-3">
                                    <img src="#" id="homeImagePreview" alt="Image Preview" class="img-thumbnail imagePreview"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.banner_image')}}<span
                                            class="text-danger">*(1894 x 496)</span></label>
                                    <input type="file" name="banner_image" class="form-control imageUpload" id="bannerImageUpload"
                                           accept="image/*" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.banner_image_message')}}">
                                </div>
                                <div class="mb-3">
                                    <img src="#" id="bannerImagePreview" alt="Image Preview" class="img-thumbnail imagePreview"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.create.show_on_top_bar')}}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="show_on_top_bar" data-rule-required="false"
                                            data-msg-required="{{__('animals.admin.create.is_amazing_message')}}">
                                        <option value="" disabled>Select</option>
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">{{__('animals.admin.create.is_amazing')}}<span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <select class="form-control" name="is_amazing" data-rule-required="true"--}}
{{--                                            data-msg-required="{{__('animals.admin.create.is_amazing_message')}}">--}}
{{--                                        <option value="">Select</option>--}}
{{--                                        <option value="yes">Yes</option>--}}
{{--                                        <option value="no">No</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label class="form-label">{{__('animals.admin.create.display_order')}}<span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input type="text" data-rule-required="true"--}}
{{--                                           data-msg-required="{{__('animals.admin.create.display_order_message')}}"--}}
{{--                                           name="display_order" value="{{old('display_order')}}" class="form-control"--}}
{{--                                           placeholder="{{__('animals.admin.create.display_order')}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.create.is_amazing')}}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="is_amazing" name="is_amazing" data-rule-required="true"
                                            data-msg-required="{{__('animals.admin.create.is_amazing_message')}}">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6" id="displayOrderContainer" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.create.display_order')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="number" data-rule-required="true" data-msg-required="{{__('animals.admin.create.display_order_message')}}"
                                           name="display_order" id="display_order" value="{{old('display_order')}}" class="form-control"
                                           placeholder="{{__('animals.admin.create.display_order')}}">
                                </div>
                            </div>
                        </div>
                        <hr class="p-2">
                        <div class="row"><h1>Properties</h1></div>
                        <div class="row rowTemplateProps">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.title_message')}}"
                                           name="prop_title[]" class="form-control" value="Mass"
                                           placeholder="{{__('animals.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.details')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.details_message')}}"
                                           name="prop_details[]" class="form-control"
                                           placeholder="{{__('animals.admin.create.details')}}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger removeRowProps mt-4">-</button>
                            </div>
                        </div>
                        <div class="row rowTemplateProps">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.title_message')}}"
                                           name="prop_title[]" class="form-control" value="Speed"
                                           placeholder="{{__('animals.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.details')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.details_message')}}"
                                           name="prop_details[]" class="form-control"
                                           placeholder="{{__('animals.admin.create.details')}}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger removeRowProps mt-4">-</button>
                            </div>
                        </div>
                        <div class="row rowTemplateProps">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.title_message')}}"
                                           name="prop_title[]" class="form-control" value="Lifespan"
                                           placeholder="{{__('animals.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.details')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.details_message')}}"
                                           name="prop_details[]" class="form-control"
                                           placeholder="{{__('animals.admin.create.details')}}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger removeRowProps mt-4">-</button>
                            </div>
                        </div>
                        <div class="row rowTemplateProps">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.title_message')}}"
                                           name="prop_title[]" class="form-control" value="Diet"
                                           placeholder="{{__('animals.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.details')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.details_message')}}"
                                           name="prop_details[]" class="form-control"
                                           placeholder="{{__('animals.admin.create.details')}}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary addRowProps mt-4">+</button>
                            </div>
                        </div>
                        <hr class="p-2">
                        <div class="row"><h1>Gallery</h1></div>
                        <div class="row rowTemplate">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('aboutUsGallery.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('aboutUsGallery.admin.create.title_message')}}"
                                           name="gal_title[]" class="form-control"
                                           placeholder="{{__('aboutUsGallery.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label">{{__('aboutUsGallery.admin.create.image')}}<span
                                            class="text-danger">*(370 x 452)</span></label>
                                    <input type="file" name="gal_image[]" class="form-control" accept="image/*"
                                           data-rule-required="true" onchange="previewImage(this)"
                                           data-msg-required="{{__('aboutUsGallery.admin.create.image_message')}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <img src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary addRow mt-4">+</button>
                            </div>
                        </div>
                        <a href="{{route('animals.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('animals.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('animals.admin.create.submit')}}
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

        document.getElementById('homeImageUpload').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('homeImagePreview').style.display = 'block';
                    document.getElementById('homeImagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('homeImagePreview').style.display = 'none';
            }
        });

        $(document).ready(function () {
            // Hide display order field initially
            $('#displayOrderContainer').hide();

            // Show or hide display_order based on is_amazing selection
            $('#is_amazing').on('change', function () {
                if ($(this).val() === 'yes') {
                    $('#displayOrderContainer').show();
                    $('#display_order').attr('data-rule-required', 'true');
                } else {
                    $('#displayOrderContainer').hide();
                    $('#display_order').removeAttr('data-rule-required');
                }
            });

            // Ensure that display_order input is an integer
            $('#display_order').on('input', function () {
                var value = $(this).val();
                if (!/^\d*$/.test(value)) {
                    $(this).val(value.replace(/[^0-9]/g, ''));
                }
            });
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
                    var formData = new FormData($(form)[0]);
                    var imageFile = $('#imageUpload')[0].files[0];

                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                formData.set(imageColName, response.filePath);
                                formData.set(imageColName+'_thumbnail', response.thumbnailPath);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the image upload');
                        }
                    }

                    var homeImageColName = $('#homeImageUpload').attr('name');
                    var homeImageFile = $('#homeImageUpload')[0].files[0];

                    if (homeImageFile) {
                        try {
                            let response = await uploadImageInChunks(homeImageFile);
                            if (response.success) {
                                formData.set(homeImageColName, response.filePath);
                                formData.set(homeImageColName+'_thumbnail', response.thumbnailPath);

                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the bannerImage upload');
                        }
                    }

                    var bannerImageColName = $('#bannerImageUpload').attr('name');
                    var bannerImageFile = $('#bannerImageUpload')[0].files[0];

                    if (bannerImageFile) {
                        try {
                            let response = await uploadImageInChunks(bannerImageFile);
                            if (response.success) {
                                // console.log('adil here', response);
                                // console.log('adil here yesss', response.thumbnailPath);
                                formData.set(bannerImageColName, response.filePath);
                                // alert(response.thumbnailPath);
                                formData.set(bannerImageColName+'_thumbnail', response.thumbnailPath);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the banner Image upload');
                        }
                    }

                    formData.delete('gal_image[]');
                    var imageInputs = $('input[name="gal_image[]"]');
                    try {
                        for (let i = 0; i < imageInputs.length; i++) {
                            let imageFile = imageInputs[i].files[0]; // Get file from each input

                            if (imageFile) {
                                let response = await uploadImageInChunks(imageFile, i);
                                if (response.success) {
                                    formData.append(`gal_image[${i}]`, response.filePath);
                                    formData.append(`gal_image[${i}]_thumbnail`, response.thumbnailPath);
                                } else {
                                    $.unblockUI();
                                    errorMsg('Image upload failed');
                                    return;
                                }
                            }
                        }
                        //await submitFormData(url, formData);
                    } catch (error) {
                        $.unblockUI();
                        errorMsg('An error occurred during the image upload');
                    }
                    await submitFormData(url, formData);

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
                            return {success: true, filePath: response.filePath, thumbnailPath: response.thumbnailPath};
                        }
                    } catch (error) {
                        return {success: false, error: error};
                    }
                }
            }

            async function submitFormData(url, formData) {
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
                        data: formData,
                        processData: false,
                        contentType: false,
                    });
                    $.unblockUI();
                    successMsg(response.message);
                    setTimeout(function () {
                        window.location.href = "{{route('animals.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });

        $(document).ready(function () {
            // Function to validate if current row has both title and image filled
            function validateRow($row) {
                let titleFilled = $row.find('input[name="prop_title[]"]').val().trim() !== '';
                let detailsFilled = $row.find('input[name="prop_details[]"]').val().trim() !== '';
                return titleFilled && detailsFilled;
            }

            // Add Row functionality
            function addRow() {
                // Clone the first row, remove its content
                let $newRow = $('.rowTemplateProps').first().clone();
                $newRow.find('input').val('');

                // Add "Add Row" button to new row
                $newRow.find('.removeRowProps').removeClass('btn-danger removeRowProps').addClass('btn-primary addRowProps').text('+');

                // Append new row after the last one
                $('.rowTemplateProps').last().after($newRow);

                return $newRow;
            }

            // Handle Add Row Button Click
            $(document).on('click', '.addRowProps', function () {
                let $currentRow = $(this).closest('.rowTemplateProps');

                // Validate current row before adding new one
                if (validateRow($currentRow)) {
                    // Change current "Add Row" button to "Remove"
                    $(this).removeClass('btn-primary addRowProps').addClass('btn-danger removeRowProps').text('-');

                    // Add the new row
                    addRow();
                } else {
                    alert('Please fill both title and details fields before adding a new row.');
                }
            });

            // Handle Remove Row Button Click
            $(document).on('click', '.removeRowProps', function () {
                $(this).closest('.rowTemplateProps').remove();
            });
        });

        $(document).ready(function () {
            // Function to validate if current row has both title and image filled
            function validateRow($row) {
                let titleFilled = $row.find('input[name="gal_title[]"]').val().trim() !== '';
                let imageFilled = $row.find('input[name="gal_image[]"]').val() !== '';
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
                    alert('Please fill image field before adding a new row.');
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
                    // Find the nearest image element in the same row and display it
                    $(input).closest('.rowTemplate').find('img').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]); // Convert the file to a URL
            }
        }

    </script>
@endsection
