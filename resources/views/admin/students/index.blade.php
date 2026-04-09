@extends('layouts.admin.index')
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => 'Students', 'route' => 'students.index']],
        'pageTitle' => 'Students'
    ])

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Our Veterinarian Page Text</h4>
                </div>
                <div class="card-body">
                    <form id="descriptionForm" action="{{ route('students.updateDescription') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label"><b>Page Title</b></label>
                            <input type="text" name="student_page_title" class="form-control" value="{{\App\Models\Settings::first()->student_page_title ?? 'Our Veterinarian'}}" placeholder="Enter Page Title">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label"><b>Description Text</b></label>
                            <textarea name="student_page_description" id="PageDetails" rows="4" class="form-control">{{\App\Models\Settings::first()->student_page_description ?? ''}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label"><b>Banner Image</b></label>
                            <input type="file" name="student_page_banner" class="form-control" accept="image/*">
                            @if(\App\Models\Settings::first() && \App\Models\Settings::first()->student_page_banner)
                                <img src="{{ asset(\App\Models\Settings::first()->student_page_banner) }}" alt="Banner Preview" style="max-height: 150px; margin-top: 10px; border-radius: 5px;">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Save Description</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Students</h4>
                            <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! $dataTable->table() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.admin.modal.delete_modal')
    <div id="loader" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: '#PageDetails',
                skin: 'oxide',
                images_upload_url: '{{route("ckeditor.upload")}}',
                file_picker_types: 'image media',
                images_upload_handler: function (blobInfo) {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            url: '{{route("ckeditor.upload")}}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if (response.location) {
                                    resolve(response.location);
                                } else {
                                    reject('Invalid response from server');
                                }
                            },
                            error: function (xhr) {
                                reject('Image upload failed: ' + xhr.status);
                            }
                        });
                    });
                },
                min_height: 350,
                plugins: [
                    'advlist', 'autoresize', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
                    'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'table'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media',
            });

            $('#descriptionForm').on('submit', function(e){
                e.preventDefault();
                tinymce.triggerSave();
                var url = $(this).attr('action');
                var data = new FormData(this);

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

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $.unblockUI();
                        if (response.result === 'success') {
                            successMsg(response.message);
                        } else {
                            errorMsg('Error updating description');
                        }
                    },
                    error: function(err) {
                        $.unblockUI();
                        errorMsg('An error occurred');
                    }
                });
            });

            $(document).on('click', '.deleteRecord', function () {
                var url = $(this).data('url');
                $('#delete_form').attr('action', url);
                $('#delete_modal').modal('show');
            });
            $('#deleteRecordBtn').click(function () {
                var url = $('#delete_form').attr('action');
                var data = $('#delete_form').serialize();
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
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function (response, status, xhr) {
                        if (xhr.status == 204) {
                            $.unblockUI();
                            successMsg('Deleted Successfully!');
                            setTimeout(function () {
                                window.location.href = "{{route('students.index')}}";
                            }, 1000);
                        } else if (response.result == 'success') {
                            $.unblockUI();
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.href = "{{route('students.index')}}";
                            }, 1000);
                        } else if (response.result == 'error') {
                            $.unblockUI();
                            errorMsg(response.message);
                        }
                    },
                    error: function (data, status) {
                        if (data.status == 422) {
                            $.unblockUI();
                            errorMsg(data.responseJSON.message);
                        } else {
                            $.unblockUI();
                            errorMsg(data.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
