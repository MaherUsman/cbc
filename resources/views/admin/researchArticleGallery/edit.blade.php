@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [

            ['name' => __('researchArticleGalleries.admin.breadcrumbs.edit'), 'route' => 'researchArticleGalleries.edit', 'params' => $researchArticleGallery->researchArticle]
        ],
        'pageTitle' => __('researchArticleGalleries.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('researchArticleGalleries.admin.edit.edit')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('researchArticleGalleries.update',$researchArticleGallery)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row rowTemplate">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label class="form-label">{{__('researchArticleGalleries.admin.create.title')}}{{--<span
                                            class="text-danger">*</span> --}}</label>
                                    <input type="text" data-rule-required="false"
                                           data-msg-required="{{__('researchArticleGalleries.admin.create.title_message')}}"
                                           name="title" class="form-control" value="{{$researchArticleGallery->title}}"
                                           placeholder="{{__('researchArticleGalleries.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label">{{__('researchArticleGalleries.admin.create.image')}}<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="image" id="imageUpload" class="form-control" accept="image/*"
                                           data-rule-required="false" onchange="previewImage(this)"
                                           data-msg-required="{{__('researchArticleGalleries.admin.create.image_message')}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <img src="{{asset($researchArticleGallery->image)}}" alt="Image Preview" class="img-thumbnail"
                                         style="display:block; max-width:200px; height:auto;">
                                </div>
                            </div>
                        </div>

                        <a href="{{route('researchArticleGalleries.index', $researchArticleGallery->researchArticle)}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('researchArticleGalleries.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('researchArticleGalleries.admin.create.submit')}}
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
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
                                data.set(`thumb`, response.thumb);
                                data.set(`compressed`, response.compressed);
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
                        window.location.href = "{{route('researchArticleGalleries.index', $researchArticleGallery->researchArticle)}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });


    </script>
@endsection
