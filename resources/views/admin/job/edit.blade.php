@extends('layouts.admin.index')
@section('css')

@endsection
@section('content')
    @include('layouts.admin.includes.breadcrumbs', [
        'breadcrumbs' => [['name' => __('jobs.admin.breadcrumbs.name'), 'route' =>'jobs.index'],
        ['name' => __('jobs.admin.breadcrumbs.edit'), 'route' => null]],
        'pageTitle' => __('jobs.admin.breadcrumbs.edit')
    ])
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    {{--                    <h6 class="card-title">{{__('jobs.admin.edit.edit')}}</h6>--}}
                    <form method="POST" id="formValidation" action="{{route('jobs.update',['job'=>$job])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('jobs.admin.edit.title')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true"
                                           data-msg-required="{{__('jobs.admin.edit.title_message')}}"
                                           name="title" value="{{$job->title}}" class="form-control"
                                           placeholder="{{__('jobs.admin.edit.title')}}">
                                </div>
                            </div>
                            {{--<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">{{__('jobs.admin.create.status')}}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status" data-rule-required="true"
                                            data-msg-required="{{__('jobs.admin.create.status_message')}}">
                                        <option value="">Select</option>
                                        <option value="1" {{$job->status?"selected":""}} >Yes</option>
                                        <option value="0" {{$job->status?"":"selected"}} >No</option>
                                    </select>
                                </div>
                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label"
                                    >{{__('jobs.admin.edit.details')}}</label>
                                    <textarea name="details" id="ckeditor">{{$job->details}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('jobs.admin.edit.closing_date')}}<span
                                            class="text-danger">*</span> </label>
                                    <input type="text" data-rule-required="true" id="closing_date"
                                           data-msg-required="{{__('jobs.admin.edit.closing_date_message')}}"
                                           name="closing_date" value="{{$job->closing_date->format('Y/m/d')}}" class="form-control"
                                           placeholder="{{__('jobs.admin.edit.closing_date')}}">
                                </div>
                            </div>
                        </div>
                        <a href="{{route('jobs.index')}}" class="btn btn-danger light btn-sl-sm" type="button">
                            {{__('jobs.admin.form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary submit">
                            {{__('jobs.admin.edit.submit')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{asset("vendor/jqueryui/js/jquery-ui.min.js")}}"></script>
    <link rel="stylesheet" href="{{asset("vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css")}}">
    <script>

        $(document).ready(function () {
            $("#closing_date").datepicker({
                dateFormat: "D, d M, yy",    // Set the format of the date "yy-mm-dd",
                // dateFormat: "yy-mm-dd",    // Set the format of the date "yy-mm-dd",
                changeMonth: true,         // Allow changing months
                changeYear: true,          // Allow changing years
                {{--yearRange: "{{date('Y')}}:2030",    // Set a range of years--}}
                minDate: new Date(),          // Set the minimum selectable date (e.g., today)
                //maxDate: "+1M +10D"        // Set the maximum selectable date (e.g., 1 month and 10 days from today)
            });

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
                    await submitFormData(url, data);
                }
            });

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
                        window.location.href = "{{route('jobs.index')}}";
                    }, 1000);
                } catch (xhr) {
                    $.unblockUI();
                    errorMsg(xhr.responseJSON.message || 'An error occurred');
                }
            }
        });
    </script>
@endsection
