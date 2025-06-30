@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('sliders.admin.breadcrumbs.name'), 'route' => 'sliders.index'],
        ['name' => __('sliders.admin.breadcrumbs.create'), 'route' => 'sliders.create']],
        'pageTitle' => __('sliders.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
{{--                    <h6 class="card-title">{{__('sliders.admin.create.create')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('sliders.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Select Slider Type</label>
                                        <select class="form-control" id="fileType" name="file_type">
                                            <option value="1" selected>Image</option>
                                            <option value="0">Video</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row inputs-to-toggle">
                            <div class="col-sm-6">
                                <div class="mb-3">
<<<<<<< HEAD
                                    <label class="form-label">{{__('sliders.admin.create.slink')}}{{--<span class="text-danger">*</span>--}}</label>
=======
                                    <label class="form-label">{{__('sliders.admin.create.slink')}}<span class="text-danger"></span></label>
>>>>>>> bbe6664a89fd5a951a405ebf50a0b3dfec47d30f
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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.create.imageOrVideo')}}<span
                                            class="text-danger">(1894 x 906)*</span></label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*,video/*" data-rule-required="true"
                                           data-msg-required="{{__('sliders.admin.create.imageOrVideo_message')}}">
                                    <input type="hidden" name="is_image" value="1" id="is_image">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                    <video id="videoPreview" controls style="display:none; max-width:200px; height:auto;"></video>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('sliders.admin.create.image')}}<span
                                            class="text-danger">(1894 x 906)*</span></label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*" data-rule-required="true"
                                           data-msg-required="{{__('sliders.admin.create.slink_message')}}">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                        </div>--}}
                        <a href="{{route('sliders.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('sliders.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('sliders.admin.create.submit')}}
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

            // Initialize jQuery Validation
            $('#formValidation').validate({
                ignore: ":hidden", // Ignore hidden fields
                rules: {
                    slink: { maxlength: 255 },
                    details: { required: true, maxlength: 255 },
                    image: { required: true, accept: "image/*,video/*" },
                },
                messages: {
                    // slink: { required: "Slink is required", maxlength: "Maximum 255 characters" },
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
                        try {
                            let response = await uploadImageInChunks(file);
                            if (response.success) {
                                data.set('image', response.filePath);
                                await submitFormData(url, data);
                            } else {
                                $.unblockUI();
                                errorMsg('File upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
                            errorMsg('An error occurred during file upload');
                        }
                    } else {
                        await submitFormData(url, data);
                    }
                },
            });

            // Upload file in chunks
            async function uploadImageInChunks(file) {
                const chunkSize = 1024 * 1024 * 2; // 2MB chunk size
                const totalChunks = Math.ceil(file.size / chunkSize);
                let currentChunk = 0;

                while (currentChunk < totalChunks) {
                    const start = currentChunk * chunkSize;
                    const end = Math.min(start + chunkSize, file.size);
                    const chunk = file.slice(start, end);

                    const chunkData = new FormData();
                    chunkData.append('chunk', chunk);
                    chunkData.append('chunkNumber', currentChunk + 1);
                    chunkData.append('totalChunks', totalChunks);
                    chunkData.append('fileName', file.name);

                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" } });

                    try {
                        const response = await $.ajax({
                            type: 'POST',
                            url: '{{ route("uploadImageChunk") }}',
                            data: chunkData,
                            processData: false,
                            contentType: false,
                        });

                        currentChunk++;
                        if (currentChunk === totalChunks) {
                            return { success: true, filePath: response.filePath };
                        }
                    } catch (error) {
                        return { success: false, error };
                    }
                }
            }

            // Submit form data
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
                    const response = await $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        processData: false,
                        contentType: false,
                    });
                    $.unblockUI();
                    successMsg(response.message);
                    setTimeout(() => {
                        window.location.href = "{{ route('sliders.index') }}";
                    }, 1000);
                } catch (error) {
                    $.unblockUI();
                    errorMsg(error.responseJSON.message || 'An error occurred');
                }
            }
        });


    </script>
@endsection
