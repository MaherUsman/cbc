@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('aboutUses.admin.breadcrumbs.name'), 'route' => 'about-uses.index'],
        ['name' => __('aboutUses.admin.breadcrumbs.create'), 'route' => 'about-uses.create']],
        'pageTitle' => __('aboutUses.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('aboutUses.admin.create.create')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('about-uses.store')}}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">{{__('aboutUses.admin.create.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('aboutUses.admin.create.title_message')}}"
                                           name="title" value="{{old('title')}}" class="form-control"
                                           placeholder="{{__('aboutUses.admin.create.title')}}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">{{__('aboutUses.admin.create.p1')}}</label>
                                    <textarea name="p1" id="PageDetails" {{--id="ckeditor"--}} rows="4" class="form-control" data-rule-required="true"
                                           data-msg-required="{{__('aboutUses.admin.create.p1_message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">{{__('aboutUses.admin.create.p2')}}</label>
                                    <textarea name="p2" id="para2" rows="4" class="form-control" data-rule-required="true"
                                           data-msg-required="{{__('aboutUses.admin.create.p2_message')}}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">{{__('aboutUses.admin.create.image')}}<span
                                            class="text-danger">(550 x 386)*</span></label>
                                    <input type="file" name="image" class="form-control" id="imageUpload"
                                           accept="image/*" data-rule-required="true"
                                           data-msg-required="{{__('aboutUses.admin.create.image_message')}}">
                                </div>
                                <div class="mb-3">
                                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                         style="display:none; max-width:200px; height:auto;">
                                </div>
                            </div>
                        </div>

                        <a href="{{route('admin.dashboard')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('aboutUses.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('aboutUses.admin.create.submit')}}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
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

            /* Init TinyMC*/
            tinymce.init({
                selector: '#PageDetails',
                skin: 'oxide',
                images_upload_url: '{{route('ckeditor.upload')}}', //add api link here
                file_picker_types: 'image media', // Allow selecting images and videos
                images_upload_handler: function (blobInfo) {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            url: '{{route('ckeditor.upload')}}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<h4>Uploading... Please wait.</h4>',
                                    css: {
                                        border: 'none',
                                        padding: '15px',
                                        backgroundColor: '#000',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: 0.7,
                                        color: '#fff'
                                    }
                                });
                            },
                            success: function (response) {
                                $.unblockUI();
                                if (response.location) {
                                    resolve(response.location);
                                } else if (response.error && response.error.message) {
                                    reject(response.error.message);
                                } else {
                                    reject('Invalid response from server');
                                }
                            },
                            error: function (xhr) {
                                $.unblockUI();
                                var body = xhr.responseJSON;
                                var msg = null;
                                if (body) {
                                    if (body.error && body.error.message) {
                                        msg = body.error.message;
                                    } else if (body.message) {
                                        msg = body.message;
                                    }
                                }
                                reject(msg || ('Image upload failed: ' + xhr.status));
                            }
                        });
                    });
                },
                min_height: 350,
                default_text_color: 'red',
                plugins: [
                    'advlist', /*'media',*/ 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                    'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'table'
                ],
                toolbar1: 'dropcaps | undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                content_style: `
          body {
              color: #ffffff;  /* Set your desired text color */
          }
          .dropcaps::first-letter {
            font-size: 3em;
            font-weight: bold;
            float: left;
            margin-right: 5px;
            line-height: 1;
          }
      `,

                // ✅ Force TinyMCE to store absolute URLs instead of relative
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,

                // ✅ Block UI Before Upload Starts
                setup: function (editor) {
                    editor.ui.registry.addToggleButton('dropcaps', {
                        text: 'Drop Caps',
                        tooltip: 'Apply Drop Caps',
                        onAction: function () {
                            // Toggle the dropcaps class on the current paragraph
                            let content = editor.selection.getNode();
                            console.log(content);
                            if (content.classList.contains('dropcaps')) {
                                content.classList.remove('dropcaps');
                            } else {
                                content.classList.add('dropcaps');
                            }
                        },
                        onSetup: function (buttonApi) {
                            // Set button state when selection changes
                            editor.selection.selectorChanged('p.dropcaps', function (state) {
                                buttonApi.setActive(state);
                            });
                        }
                    });

                    editor.on('BeforeUpload', function () {
                        $.blockUI({
                            message: '<h4>Uploading... Please wait.</h4>',
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: 0.7,
                                color: '#fff'
                            }
                        });
                    });

                    editor.on('UploadComplete', function () {
                        $.unblockUI();
                    });

                    editor.on('UploadFail', function () {
                        $.unblockUI();
                        alert('Upload failed! Please try again.');
                    });
                },
            });

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
                    var data = new FormData($(form)[0]);
                    var imageFile = $('#imageUpload')[0].files[0];

                    if (imageFile) {
                        try {
                            let response = await uploadImageInChunks(imageFile);
                            if (response.success) {
                                data.set(imageColName, response.filePath);
                                await submitFormData(url, data);
                            } else {
                                $.unblockUI();
                                errorMsg('Image upload failed');
                            }
                        } catch (error) {
                            $.unblockUI();
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
                        window.location.href = "{{route('about-uses.COE')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });

    </script>
@endsection
