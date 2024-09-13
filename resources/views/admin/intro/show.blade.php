@extends('layouts.admin.index')
@section('css')
    <style>
        text-size-adjust: 100%;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        --blue: #007bff;
        --indigo: #6610f2;
        --purple: #6f42c1;
        --pink: #e83e8c;
        --red: #dc3545;
        --orange: #fd7e14;
        --yellow: #ffc107;
        --green: #28a745;
        --teal: #20c997;
        --cyan: #17a2b8;
        --white: #fff;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --secondary: #6c757d;
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #343a40;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        --primary: #ECAC20;
        --seconadry: #38291C;
        --tertiary: #939D00;
        text-align: left;
        font-size: 16px;
        color: rgb(113, 116, 122);
        line-height: 32px;
        font-weight: 400;
        font-family: Rubik, sans-serif;
        -webkit-font-smoothing: antialiased;
        cursor: default !important;
        box-sizing: border-box;
        margin: 0px;
        padding: 0px;
        border: none;
        outline: none;
        display: block;
        position: relative;
    </style>
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('intros.admin.breadcrumbs.name'), 'route' =>'intros.COE'],
        ['name' => __('intros.admin.breadcrumbs.show'), 'route' => null]],
        'pageTitle' => __('intros.admin.breadcrumbs.show')
    ])

    <section class="info-section">
        <div class="bg-layer"></div>
        <div class="auto-container">
            <div class="inner-container">
                <div class="row clearfix">
                    <div class="col-lg-3">
                        <div class="highness-img">
                            <img src="{{asset($intro->image)}}" width="270" height="400" class="st-hover">
                        </div>

                    </div>
                    <div class="col-lg-9">
                        <div class="sec-title mb-2">
                            <h2 class="">{{strtoupper($intro->title)}}</h2>
                        </div>

                        <p class="highness-text">
                            {!! $intro->details !!}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
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

        $(document).ready(function () {
            var imageColName = 'pic';

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
                    var data = new FormData($(form)[0]);
                    var imageFile = $('#imageUpload')[0].files[0];

                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                data.set(imageColName, response.filePath);
                                await submitFormData(url, data);
                            } else {
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            errorMsg('An error occurred during the image upload');
                        }
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
                            url: '/upload-chunk',
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
                        window.location.href = "{{route('intros.COE')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });
    </script>
@endsection
