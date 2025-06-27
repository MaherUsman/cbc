@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('sliders.admin.breadcrumbs.name'), 'route' =>'sliders.index'],
        ['name' => __('sliders.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('sliders.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('sliders.admin.edit.edit')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('sliders.update',['slider'=>$slider])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Select Slider Type</label>
                                    <select class="form-control" id="fileType" name="file_type">
                                        <option value="1" {{ $slider->is_image ? 'selected' : '' }}>Image</option>
                                        <option value="0" {{ !$slider->is_image ? 'selected' : '' }}>Video</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row inputs-to-toggle">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.create.slink')}}<span class="text-danger"></span></label>
                                    <input type="text" name="slink" value="{{ old('slink') }}" class="form-control" placeholder="{{__('sliders.admin.create.slink')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row inputs-to-toggle">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">{{__('sliders.admin.create.details')}}<span class="text-danger">*</span></label>
                                    <textarea name="details" id="ckeditor"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- File Upload Section -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.edit.imageOrVideo')}}</label>
                                    <input type="file" name="image" class="form-control" id="imageUpload" accept="image/*,video/*">
                                    <input type="hidden" name="is_image" value="{{$slider->is_image ? 1 : 0}}" id="is_image">
                                </div>

                                <!-- Preview Section -->
                                <div class="mb-3">
                                    <!-- Image Preview -->
                                    <img id="imagePreview"
                                         src="{{ $slider->is_image ? asset($slider->image ?: 'no_image.jpg') : '#' }}"
                                         alt="Image Preview"
                                         class="img-thumbnail"
                                         style="{{ $slider->is_image ? '' : 'display:none;' }} max-width:200px; height:auto;">

                                    <img id="imagePreviews"
                                         src="{{ $slider->is_image ? asset($slider->image ?: 'no_image.jpg') : '#' }}"
                                         alt="Image Preview"
                                         class="img-thumbnail"
                                         style="{{ $slider->is_image ? '' : 'display:none;' }} max-width:200px; height:auto;">

                                    <!-- Video Preview -->
                                    <video id="videoPreview"
                                           src="{{ !$slider->is_image ? asset($slider->image ?: 'no_image.jpg') : '#' }}"
                                           controls
                                           style="{{ $slider->is_image ? 'display:none;' : '' }} max-width:200px; height:auto;"></video>

                                    <video id="videoPreviews"
                                           src="{{ !$slider->is_image ? asset($slider->image ?: 'no_image.jpg') : '#' }}"
                                           controls
                                           style="{{ $slider->is_image ? 'display:none;' : '' }} max-width:200px; height:auto;"></video>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('sliders.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
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
        document.addEventListener('DOMContentLoaded', function () {
            const fileTypeDropdown = document.getElementById('fileType');
            const inputsToToggle = document.querySelectorAll('.inputs-to-toggle');
            const fileInput = document.getElementById('imageUpload');
            const isImageInput = document.getElementById('is_image'); // Hidden input field

            // Function to toggle fields based on file type
            function toggleFields() {
                const isImage = fileTypeDropdown.value === '1'; // 1 for Image, 0 for Video

                // Show/hide fields
                inputsToToggle.forEach(input => {
                    input.style.display = isImage ? 'block' : 'none';
                });

                // Set file input accept attribute
                fileInput.accept = isImage ? 'image/*' : 'video/*';

                // Set is_image value based on selection
                isImageInput.value = isImage ? '1' : '0';

                // Reset file input and previews
                fileInput.value = '';
                document.getElementById('imagePreview').style.display = 'none';
                document.getElementById('videoPreview').style.display = 'none';
            }

            // Event listener for dropdown change
            fileTypeDropdown.addEventListener('change', toggleFields);

            // Initialize toggle on page load
            toggleFields();

            // Preview uploaded file
            fileInput.addEventListener('change', function (event) {
                const [file] = event.target.files;
                const imagePreview = document.getElementById('imagePreview');
                const videoPreview = document.getElementById('videoPreview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        if (file.type.startsWith('image/')) {
                            imagePreview.style.display = 'block';
                            videoPreview.style.display = 'none';
                            imagePreview.src = e.target.result;
                            isImageInput.value = '1'; // Set as image
                        } else if (file.type.startsWith('video/')) {
                            videoPreview.style.display = 'block';
                            imagePreview.style.display = 'none';
                            videoPreview.src = e.target.result;
                            isImageInput.value = '0'; // Set as video
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                    videoPreview.style.display = 'none';
                    isImageInput.value = fileTypeDropdown.value === '1' ? '1' : '0'; // Default value
                }
            });

            $('#formValidation').validate({

                ignore: ":hidden", // Ignore hidden fields
                rules: {
                    slink: { maxlength: 255 },
                    details: { required: true, maxlength: 255 },
                    image: { required: true, accept: "image/*,video/*" },
                },
                messages: {
                    slink: { required: "Slink is required", maxlength: "Maximum 255 characters" },
                    details: { required: "Details are required", maxlength: "Maximum 255 characters" },
                    image: { required: "Image or video is required", accept: "Invalid file type" },
                },
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

                    const url = $(form).attr('action');
                    const data = new FormData($(form)[0]);
                    const file = fileInput.files[0];

                    if (file) {
                        // try {
                            let response = await uploadImageInChunks(file);
                            if (response.success) {
                                data.set('image', response.filePath);
                                await submitFormData(url, data);
                            } else {
                                $.unblockUI();
                                errorMsg('File upload failed');
                            }
                        // } catch (error) {
                        //     $.unblockUI();
                        //     errorMsg('An error occurred during file upload');
                        // }
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
                    const start = currentChunk * chunkSize;
                    const end = Math.min(start + chunkSize, file.size);
                    const chunk = file.slice(start, end);

                    const chunkData = new FormData();
                    chunkData.append('chunk', chunk);
                    chunkData.append('chunkNumber', currentChunk + 1);
                    chunkData.append('totalChunks', totalChunks);
                    chunkData.append('fileName', file.name);

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
                            return {success: true, filePath: response.filePath };
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
                        window.location.href = "{{route('sliders.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }

            $("#fileType").change(function () {
                const selectedValue = $(this).val(); // Get the selected value

                // Example: Check if the selected value is 1 (Image) or 0 (Video)
                if (selectedValue === "1") {
                    $('#videoPreviews').hide();
                    // $('#imagePreviews').show();
                    // Perform actions when Image is selected
                } else if (selectedValue === "0") {
                    $('#imagePreviews').hide();
                    // $('#videoPreviews').show();
                    console.log("Video selected");
                    // Perform actions when Video is selected
                }
            });
        });
    </script>
@endsection
