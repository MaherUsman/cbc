@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => '', 'route' =>null],
        ['name' => __('researchArticle.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('researchArticle.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('researchArticle.admin.edit.edit')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('researchArticle.update',['researchArticle'=>$researchArticle])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('researchArticle.admin.edit.title')}}<span
                                                    class="text-danger">*</span> </label>
                                            <input type="text" data-rule-required="true"
                                                   data-msg-required="{{__('researchArticle.admin.edit.title_message')}}"
                                                   name="title" value="{{$researchArticle->title}}" class="form-control"
                                                   placeholder="{{__('researchArticle.admin.edit.title')}}">
                                        </div>
                                    </div>
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="form-label"--}}
{{--                                            >{{__('researchArticle.admin.edit.description')}}</label>--}}
{{--                                            <textarea name="description" id="ckeditor" rows="4" class="form-control" data-rule-required="true"--}}
{{--                                           data-msg-required="{{__('researchArticle.admin.create.description_message')}}">{{$researchArticle->description}}</textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('researchArticle.admin.edit.article_pdf_file')}}</label>
                                            <input type="file" name="article_pdf_file" class="form-control" id="imageUpload"
                                                   accept=".pdf,application/pdf">
                                        </div>
                                        <div class="mb-3">
                                            <img id="imagePreview" src="{{asset($researchArticle->article_pdf_file?:'no_image.jpg')}}"
                                                 alt="Image Preview" class="img-thumbnail"
                                                 style="{{$researchArticle->banner_image?'':'display:none;'}} max-width:200px; height:auto;">
                                        </div>
                                    </div>
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label">{{__('researchArticle.admin.edit.image')}}</label>--}}
{{--                                            <input type="file" name="banner_image" class="form-control" id="imageUpload"--}}
{{--                                                   accept="image/*">--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <img id="imagePreview" src="{{asset($researchArticle->banner_image?:'no_image.jpg')}}"--}}
{{--                                                 alt="Image Preview" class="img-thumbnail"--}}
{{--                                                 style="{{$researchArticle->banner_image?'':'display:none;'}} max-width:200px; height:auto;">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>


                            <a href="{{route('researchArticle.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                                {{__('researchArticle.admin.form.cancel')}}
                            </a>
                            <button type="submit" class="btn btn-primary submit">
                                {{__('researchArticle.admin.edit.submit')}}
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

        $(document).ready(function () {
            var imageColName = 'ResearchArticlePDF';
            // var PDFColName = 'ResearchArticlePDF';

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
                    chunkData.append('uploadPath', imageColName);

                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});

                    try {
                        let response = await $.ajax({
                            type: 'POST',
                            url: '{{route("uploadFileChunk")}}',
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
                        window.location.href = "{{route('researchArticle.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });
    </script>
@endsection
