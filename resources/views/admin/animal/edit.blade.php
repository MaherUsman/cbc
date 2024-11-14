@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('animals.admin.breadcrumbs.name'), 'route' => 'animals.index'],
        ['name' => __('animals.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('animals.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('animals.admin.edit.edit')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('animals.update',['animal'=>$animal])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row {{--bg-blue-light pt-2 rounded--}}">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.edit.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.edit.title_message')}}"
                                           name="title" value="{{$animal->title}}" class="form-control"
                                           placeholder="{{__('animals.admin.edit.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.edit.category_id')}}</label>
                                    <select class="form-control" name="category_id" data-rule-required="true"
                                            data-msg-required="{{__('animals.admin.edit.category_id_message')}}">
                                        <option value="">Select Category</option>
                                        @foreach($animalCategories as $category)
                                            <option value="{{$category->id}}" @if($animal->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.edit.slug')}}</label>
                                    <input type="text" data-rule-required="false"
                                           data-msg-required="{{__('animals.admin.edit.slug_message')}}"
                                           name="slug" value="{{$animal->slug}}" class="form-control"
                                           placeholder="{{__('animals.admin.edit.slug')}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.edit.details')}}<span
                                            class="text-danger">*</span></label>
                                    <textarea name="details" id="ckeditor" data-rule-required="true"
                                              data-msg-required="{{__('animals.admin.edit.details_message')}}">{{$animal->details}}</textarea>
                                </div>
                            </div>
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label class="form-label">{{__('animals.admin.edit.image')}}<span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input type="file" name="image" class="form-control" id="imageUpload"--}}
{{--                                           accept="image/*"--}}
{{--                                           data-msg-required="{{__('animals.admin.edit.image_message')}}">--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <img id="imagePreview" src="{{asset($animal->image?:'no_image.jpg')}}"--}}
{{--                                         alt="Image Preview" class="img-thumbnail"--}}
{{--                                         style="{{$animal->image?'':'display:none;'}} max-width:200px; height:auto;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.home_image')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="homeImageUpload" name="home_image" class="form-control imageUpload"
                                           accept="image/*"
                                           data-msg-required="{{__('animals.admin.create.home_image_message')}}">
                                </div>
                                <div class="mb-3">
                                    <img src="{{asset($animal->home_image?:'no_image.jpg')}}" id="homeImagePreview" alt="Image Preview" class="img-thumbnail imagePreview"
                                         style="{{$animal->home_image?'':'display:none;'}} max-width:200px; height:auto;">
                                </div>
                            </div>
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label class="form-label">{{__('animals.admin.create.banner_image')}}<span--}}
{{--                                            class="text-danger">*</span></label>--}}
{{--                                    <input type="file" name="banner_image" id="bannerImageUpload" class="form-control imageUpload"--}}
{{--                                           accept="image/*"--}}
{{--                                           data-msg-required="{{__('animals.admin.create.banner_image_message')}}">--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <img src="{{asset($animal->banner_image?:'no_image.jpg')}}" id="bannerImagePreview" alt="Image Preview" class="img-thumbnail imagePreview"--}}
{{--                                         style="{{$animal->banner_image?'':'display:none;'}} max-width:200px; height:auto;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Show In Top Bar Animal List<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="show_on_top_bar">
                                        <option value="" disabled>Select</option>
                                        <option value="1" {{ $animal->show_on_top_bar == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $animal->show_on_top_bar == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.create.is_amazing')}}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="is_amazing" name="is_amazing" data-rule-required="true"
                                            data-msg-required="{{__('animals.admin.create.is_amazing_message')}}">
                                        <option value="">Select</option>
                                        <option value="yes" {{ $animal->is_amazing == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ $animal->is_amazing == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6" id="displayOrderContainer" @if($animal->is_amazing == 'no') style="display:none;" @else style="display:block;" @endif>
                                <div class="form-group">
                                    <label class="form-label">{{__('animals.admin.create.display_order')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="number" data-rule-required="true" data-msg-required="{{__('animals.admin.create.display_order_message')}}"
                                           name="display_order" id="display_order" value="{{$animal->display_order}}" class="form-control"
                                           placeholder="{{__('animals.admin.create.display_order')}}">
                                </div>
                            </div>
                        </div>
{{--                        @dd($animal->animalProps)--}}
                        <hr class="p-2">
                        <div class="row"><h1>Properties</h1></div>
                        @foreach($animal->animalProps as $animalprops)
                        <div class="row rowTemplateProps align-items-center">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.edit.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.edit.title_message')}}"
                                           name="prop_title[]" class="form-control" value="{{$animalprops->title}}"
                                           placeholder="{{__('animals.admin.edit.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.edit.details')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.edit.details_message')}}"
                                           name="prop_details[]" class="form-control" value="{{$animalprops->details}}"
                                           placeholder="{{__('animals.admin.edit.details')}}">
                                </div>
                            </div>
                            <div class="col-sm-1 mt-2">
                                <button type="button" class="btn btn-danger removeRowProps">-</button>
                            </div>
                        </div>
                        @endforeach

                        <div class="row rowTemplateProps align-items-center">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('animals.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('animals.admin.create.title_message')}}"
                                           name="prop_title[]" class="form-control"
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
                            <div class="col-sm-1 mt-2">
                                <button type="button" class="btn btn-primary addRowProps">+</button>
                            </div>
                        </div>
                        <hr class="p-2">
                        <div class="row">
                            <h1>Sliders</h1>
                        </div>
                        <div class="row">
                            @foreach($animal->animalSliders as $animalslider)
                                <div class="col-sm-3 image-container">
                                    <div class="mb-3 position-relative">
                                        <img id="imagePreview" src="{{ asset($animalslider->image ?: 'no_image.jpg') }}"
                                             alt="Image Preview" class="img-thumbnail"
                                             style="{{ $animalslider->image ? '' : 'display:none;' }} max-width:200px; height:auto;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-image"
                                                data-id="{{ $animalslider->id }}" style="margin: 5px;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row rowTemplate"></div>
                        <div class="col-sm-1">
                            <button type="button" class="btn btn-primary addRow mt-4">+</button>
                        </div>
{{--                        <a href="{{route('animal-galleries.index', $animal)}}" class="btn btn-primary">Update Gallery</a>--}}
                        <hr class="p-2">
                        <a href="{{route('animals.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('animals.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('animals.admin.edit.submit')}}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        // document.getElementById('imageUpload').addEventListener('change', function (event) {
        //     const [file] = event.target.files;
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function (e) {
        //             document.getElementById('imagePreview').style.display = 'block';
        //             document.getElementById('imagePreview').src = e.target.result;
        //         };
        //         reader.readAsDataURL(file);
        //     } else {
        //         document.getElementById('imagePreview').style.display = 'none';
        //     }
        // });
        //
        // document.getElementById('bannerImageUpload').addEventListener('change', function (event) {
        //     const [file] = event.target.files;
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function (e) {
        //             document.getElementById('bannerImagePreview').style.display = 'block';
        //             document.getElementById('bannerImagePreview').src = e.target.result;
        //         };
        //         reader.readAsDataURL(file);
        //     } else {
        //         document.getElementById('bannerImagePreview').style.display = 'none';
        //     }
        // });

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
            // $('#displayOrderContainer').hide();

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
                    // var imageColName = $('#imageUpload').attr('name');
                    var formData = new FormData($(form)[0]);
                    // var imageFile = $('#imageUpload')[0].files[0];

                    // if (imageFile) {
                    //     try {
                    //         let response = await uploadImageInChunks(imageFile);
                    //         if (response.success) {
                    //             formData.set(imageColName, response.compressedPath);
                    //             formData.set(imageColName+"_thumbnail", response.thumbnailPath);
                    //         } else {
                    //             $.unblockUI();
                    //             errorMsg('Image upload failed');
                    //         }
                    //     } catch (error) {
                    //         $.unblockUI();
                    //         errorMsg('An error occurred during the image upload');
                    //     }
                    // }

                    var homeImageColName = $('#homeImageUpload').attr('name');
                    var homeImageFile = $('#homeImageUpload')[0].files[0];

                    if (homeImageFile) {
                        try {
                            let response = await uploadImageInChunks(homeImageFile);
                            if (response.success) {
                                formData.set(homeImageColName, response.compressedPath);
                                formData.set(homeImageColName+"_thumbnail", response.thumbnailPath);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during the bannerImage upload');
                        }
                    }

                    // var bannerImageColName = $('#bannerImageUpload').attr('name');
                    // var bannerImageFile = $('#bannerImageUpload')[0].files[0];
                    //
                    // if (bannerImageFile) {
                    //     try {
                    //         let response = await uploadImageInChunks(bannerImageFile);
                    //         if (response.success) {
                    //             formData.set(bannerImageColName, response.compressedPath);
                    //             formData.set(bannerImageColName+"_thumbnail", response.thumbnailPath);
                    //             console.log(bannerImageColName+"_thumbnail" , 'dsfdsfd')
                    //         } else {
                    //             $.unblockUI();
                    //             errorMsg('Image upload failed');
                    //         }
                    //     } catch (error) {
                    //         $.unblockUI();
                    //         errorMsg('An error occurred during the banner Image upload');
                    //     }
                    // }

                    formData.delete('slider_image[]');
                    var imageInputs = $('input[name="slider_image[]"]');
                    try {
                        for (let i = 0; i < imageInputs.length; i++) {
                            let imageFile = imageInputs[i].files[0]; // Get file from each input

                            if (imageFile) {
                                let response = await uploadImageInChunks(imageFile, i);
                                if (response.success) {
                                    formData.append(`slider_image[${i}]`, response.filePath);
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
                            return {success: true, filePath: response.filePath , compressedPath: response.compressedPath , thumbnailPath: response.thumbnailPath};
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

        // $(document).ready(function () {
        //     // Function to validate if the current row has the image field filled
        //     function validateRow($row) {
        //         return $row.find('input[name="slider_image[]"]').val() !== '';
        //     }
        //
        //     // Add Row functionality
        //     function addRow() {
        //         // Define the new row structure
        //         let $newRow = $(
        //             `<div class="col-sm-3">
        //             <div class="mb-3">
        //                 <label class="form-label">Image <span class="text-danger">*(370 x 452)</span></label>
        //                 <input type="file" name="slider_image[]" class="form-control" accept="image/*" data-rule-required="true"
        //                        onchange="previewImage(this)" data-msg-required="Please upload an image.">
        //             </div>
        //         </div>
        //         <div class="col-sm-3">
        //             <div class="mb-3">
        //                 <img src="#" alt="Image Preview" class="img-thumbnail" style="display:none; max-width:200px; height:auto;">
        //             </div>
        //         </div>
        //         <div class="col-sm-1">
        //             <button type="button" class="btn btn-danger removeRow mt-4">-</button>
        //         </div>`
        //         );
        //
        //         // Append the new row after the last rowTemplate
        //         $('.rowTemplate').last().after($newRow);
        //     }
        //
        //     // Handle Add Row Button Click
        //     $(document).on('click', '.addRow', function () {
        //         let $currentRow = $(this).closest('.rowTemplate');
        //
        //         // Validate current row before adding a new one
        //         if (validateRow($currentRow)) {
        //             // Change current "Add Row" button to "Remove"
        //             // $(this).removeClass('btn-primary addRow').addClass('btn-danger removeRow').text('-');
        //
        //             // Add the new row
        //             addRow();
        //         } else {
        //             alert('Please fill the image field before adding a new row.');
        //         }
        //     });
        //
        //     // Handle Remove Row Button Click
        //     $(document).on('click', '.removeRow', function () {
        //         $(this).closest('.rowTemplate').remove();
        //     });
        //
        //     // Preview Image Function
        //     function previewImage(input) {
        //         if (input.files && input.files[0]) {
        //             const reader = new FileReader();
        //             reader.onload = function (e) {
        //                 $(input).closest('.rowTemplate').find('img').attr('src', e.target.result).show();
        //             };
        //             reader.readAsDataURL(input.files[0]);
        //         }
        //     }
        //
        //     // Dynamically bind preview image function
        //     $(document).on('change', 'input[name="slider_image[]"]', function () {
        //         previewImage(this);
        //     });
        // });

        $(document).ready(function () {
            // Function to validate if the last row has the image field filled
            function validateLastRow() {
                let lastRow = $('.rowTemplate .image-input-row').last();
                let imageFilled = lastRow.find('input[name="slider_image[]"]').val() !== '';
                return imageFilled;
            }

            // Function to add a new row
            function addRow() {
                let newRowHtml = `
            <div class="row image-input-row align-items-center">
                <div class="col-sm-3">
                    <div class="mb-3">
                        <label class="form-label">Image <span class="text-danger">*(370 x 452)</span></label>
                        <input type="file" name="slider_image[]" class="form-control" accept="image/*" data-rule-required="true"
                               onchange="previewImage(this)" data-msg-required="Please upload an image.">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="mb-3">
                        <img src="#" alt="Image Preview" class="img-thumbnail" style="display:none; max-width:200px; height:auto;">
                    </div>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-danger removeRow mt-4">-</button>
                </div>
            </div>`;

                // Append the new row to the rowTemplate container
                $('.rowTemplate').append(newRowHtml);
            }

            // Handle Add Row button click
            $(document).on('click', '.addRow', function () {
                // Check if the last row's image input is filled
                if (!validateLastRow()) {
                    alert('Please upload an image before adding a new row.');
                    return;
                }

                // Add the new row if validation passed
                addRow();
            });

            // Handle Remove Row button click
            $(document).on('click', '.removeRow', function () {
                $(this).closest('.image-input-row').remove();
            });

            // Dynamically bind preview image function
            $(document).on('change', 'input[name="slider_image[]"]', function () {
                previewImage(this);
            });
        });




        // Function to preview the selected image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Find the nearest image element in the same row and display it
                    $(input).closest('.image-input-row').find('img').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]); // Convert the file to a URL
            }
        }

        $(document).ready(function() {
            // Handle Delete Image Button Click
            $(document).on('click', '.delete-image', function() {
                let imageId = $(this).data('id'); // Get the image ID from data attribute
                let imageContainer = $(this).closest('.image-container'); // Select the image container to remove if deletion is successful

                // Confirm deletion with the user
                if (!confirm('Are you sure you want to delete this image?')) {
                    return;
                }

                // Perform AJAX request to delete image
                $.ajax({
                    url: "{{route('delete.animal.slider.image')}}", // URL of the route that handles deletion
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Add CSRF token for security
                        id: imageId
                    },
                    success: function(response) {
                        if (response.success) {
                            imageContainer.remove(); // Remove image from DOM
                            alert('Image deleted successfully.');
                        } else {
                            alert('Failed to delete image.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while deleting the image.');
                    }
                });
            });
        });


    </script>
@endsection
