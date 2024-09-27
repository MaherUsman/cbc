@extends('layouts.admin.index')
@section('css')
@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('contactUs.admin.breadcrumbs.name'), 'route' => 'contact-uses.index'],
        ['name' => __('contactUs.admin.breadcrumbs.create'), 'route' => 'contact-uses.create']],
        'pageTitle' => __('contactUs.admin.breadcrumbs.create')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('contactUs.admin.create.create')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('contact-uses.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('contactUs.admin.create.full_name')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('contactUs.admin.create.full_name_message')}}"
                                           name="full_name" value="{{old('full_name')}}" class="form-control"
                                           placeholder="{{__('contactUs.admin.create.full_name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('contactUs.admin.create.email')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="email" data-rule-required="true"
                                           data-msg-required="{{__('contactUs.admin.create.email_message')}}"
                                           name="email" value="{{old('email')}}" class="form-control"
                                           placeholder="{{__('contactUs.admin.create.email')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('contactUs.admin.create.phone_number')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('contactUs.admin.create.phone_number_message')}}"
                                           name="phone_number" value="{{old('phone_number')}}" class="form-control"
                                           placeholder="{{__('contactUs.admin.create.phone_number')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('contactUs.admin.create.subject')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('contactUs.admin.create.subject_message')}}"
                                           name="subject" value="{{old('subject')}}" class="form-control"
                                           placeholder="{{__('contactUs.admin.create.subject')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="Message">Message<span
                                            class="text-danger">*</span></label>
                                    <textarea id="Message" placeholder="Message" name="details"
                                              class="form-control" rows="5" required="" data-rule-required="true"
                                              data-msg-required="{{__('contactUs.admin.create.details_message')}}"></textarea>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('contact-uses.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('contactUs.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('contactUs.admin.create.submit')}}
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
                    var data = new FormData($(form)[0]);

                    var imageUploadElement = $('#imageUpload')[0];
                    if (imageUploadElement) {
                        var imageFile = imageUploadElement.files[0];
                        if (imageFile) {
                            var imageColName = $('#imageUpload').attr('name');
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
                        window.location.href = "{{route('contact-uses.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });

    </script>
@endsection
