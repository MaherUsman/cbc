@extends('layouts.admin.index')
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('users.admin.breadcrumbs.name'), 'route' =>'user.index'],
        ['name' => __('users.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('users.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{__('users.admin.edit.edit')}}</h6>
                    <form method="POST" id="formValidation" action="{{route('user.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.first_name')}}<span class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('users.admin.edit.first_name_message')}}"
                                           name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control"
                                           placeholder="{{__('users.admin.edit.first_name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.last_name')}}<span class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('users.admin.edit.last_name_message')}}"
                                           name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control"
                                           placeholder="{{__('users.admin.edit.last_name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.email')}}<span class="text-danger">*</span></label>
                                    <input type="text" name="email"
                                           value="{{ old('email', $user->email) }}"
                                           data-rule-required="true"
                                           data-rule-email="true"
                                           data-msg-email="{{__('users.admin.edit.email_validation')}}"
                                           data-msg-required="{{__('users.admin.edit.email_required')}}"
                                           class="form-control" placeholder="{{__('users.admin.edit.email')}}">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.username')}}<span class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('users.admin.edit.username_message')}}"
                                           name="username" value="{{ old('username', $user->username) }}" class="form-control"
                                           placeholder="{{__('users.admin.edit.username')}}">
                                </div>
                            </div>
                        </div><!-- Row -->
                        <div class="row">
                            {{--<div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.address')}}</label>
                                    <input type="text" value="{{ old('address', $user->address) }}" name="address" class="form-control"
                                           placeholder="{{__('users.admin.edit.address')}}">
                                </div>
                            </div><!-- Col -->--}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.phone')}}</label>
                                    <input type="text"
                                           value="{{ old('phone', $user->phone) }}"
                                           data-rule-required="true"
                                           data-msg-required="{{__('users.admin.edit.phone_required')}}"
                                           name="phone" class="form-control"
                                           placeholder="{{__('users.admin.edit.phone')}}">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.password')}}</label>
                                    <input type="password" name="password" id="password"
                                           data-rule-minlength="8"
                                           class="form-control" placeholder="{{__('users.admin.edit.password')}}">
                                    <small class="form-text text-muted">{{__('users.admin.edit.leave_blank')}}</small>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.confirm_password')}}</label>
                                    <input type="password" name="password_confirmation"
                                           data-rule-minlength="8"
                                           data-rule-equalTo="#password"
                                           data-msg-equalTo="{{__('users.admin.edit.password_match')}}"
                                           class="form-control"
                                           placeholder="{{__('users.admin.edit.confirm_password')}}">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.role')}}<span class="text-danger">*</span></label>
                                    <select name="role" class="form-control" data-rule-required="true"
                                            data-msg-required="{{__('users.admin.edit.role_required')}}">
                                        <option value="">{{__('users.admin.edit.select_role')}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ old('role', $user->roles->first()->name?:'') == $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('users.admin.edit.image')}}</label>
                                    <input type="file" name="pic" class="form-control" id="imageUpload" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    @if(isset($user->pic))
                                        <img id="imagePreview" src="{{ asset($user->pic) }}" alt="Image Preview" class="img-thumbnail"
                                             style="display:block; max-width:200px; height:auto;">
                                    @else
                                        <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                             style="display:none; max-width:200px; height:auto;">
                                    @endif
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <a href="{{route('user.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('users.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('users.admin.edit.submit')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
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

                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" } });

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
                            return { success: true, filePath: response.filePath };
                        }
                    } catch (error) {
                        return { success: false, error: error };
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
                        window.location.href = "{{route('user.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });
    </script>
@endsection
