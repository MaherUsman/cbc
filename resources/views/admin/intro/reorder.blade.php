@extends('layouts.admin.index')
@section('content')

    <style>
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            word-wrap: break-word;
            /*background-color: rgba(44, 44, 44, 1);*/
            background-clip: border-box;
            /*border: var(--bs-card-border-width) solid rgba(225, 43, 42, 1);*/
            border: var(--bs-card-border-width) solid #1B3764;
            border-radius: var(--bs-card-border-radius);
        }
        .card-img{
            text-align: center;
        }
        .card-img img{
            height: 230px;
            object-fit: cover;
        }
        .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
            border: none !important;
            background-color: transparent !important;
            font-weight: normal;
            color: #454545;
        }
        .card-img-icon a{
            /*color: rgba(225, 43, 42, 1) !important;*/
            color: #ffffff !important;
            display: inline-block;
            -webkit-transform: translateY(30px);
            transform: translateY(30px);
            -webkit-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
            opacity: 0;
            visibility: hidden;
            margin: 0 2px;
            /*background-color: black;*/
            background-color: #1B3764;
            padding: 10PX;
            border-radius: 50PX;
        }
        .card-img:hover .card-img-icon a{
            -webkit-transform: translateY(0);
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
        .card-img-icon a:hover {
            /*color: rgb(190, 30, 30) !important;*/
            color: #ffffff !important;
        }
        .card-img-icon{
            padding-left: 0;
            list-style-type: none;
            position: absolute;
            left: 0;
            right: 0;
            bottom: 25px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 0;
        }
    </style>

    @include('layouts.admin.includes.breadcrumbs' , ['breadcrumbs' => [['name' =>  __('sliders.name') , 'route' => null]],
'pageTitle' => __('sliders.reOrder')
])

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                <li class="nav-item"><a href="{{route('sliders.index')}}#list-view" {{--data-bs-toggle="tab"--}}
                                        class="nav-link">{{ __('common.list_view') }}</a></li>
                <li class="nav-item"><a href="{{route('sliders.gridView')}}#grid-view" data-bs-toggle="tab"
                                        class="nav-link me-1 show active">{{ __('common.grid_view') }}</a></li>
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="grid-view" class="tab-pane fade active show col-lg-12">
                    <div class="row" id="sortable">
                        @foreach($sliders as $slider)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12" id="{{$slider->id}}">
                            <div class="card card-img">
                                <img src="{{asset($slider->image?:'no_image.jpg')}}" class="card-img-top img-fluid" alt="...">
                                <div class="card-img-icon">
                                    <a title="Edit" href="{{route('sliders.edit',$slider)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"
                                             style="color: #ffffff;">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                    <a data-url="{{ route('sliders.destroy', $slider) }}"
                                       title="Delete" class="deleteRecord"
                                       href="javascript:void(0)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"
                                             style="color: #ffffff;">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            {{--<div class="card card-profile" style="background-image: {{asset($slider->image)}}">
                                <div class="card-header justify-content-end pb-0 border-0">
                                    <div class="dropdown">
                                        <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                                            <span class="dropdown-dots fs--1"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right border py-0">
                                            <div class="py-2">
                                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                <a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="text-center">
                                        <div class="profile-photo">
                                            <img src="{{asset($slider->image)}}" width="100" class="img-fluid rounded-circle" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.admin.modal.delete_modal')
    @include('layouts.admin.modal.message_modal')
    <div id="loader" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('vendor/jqueryui/js/jquery-ui.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            // $("#sortable").sortable();

            $("#sortable").sortable({
                update: function (event, ui) {
                    var order = $(this).sortable('toArray');
                    console.log(order);
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
                        url: '{{route("sliders.updateOrder")}}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            order: order
                        },
                        success: function (response, status) {
                            if (response.result === 'success') {
                                $.unblockUI();
                                successMsg(response.message);
                            } else if (response.result === 'error') {
                                $.unblockUI();
                                errorMsg(response.message);
                            }
                        },
                        error: function (data, status) {
                            if (data.status === 422) {
                                $.unblockUI();
                                errorMsg(data.responseJSON.message);
                            } else {
                                $.unblockUI();
                                errorMsg(data.responseJSON.message);
                            }
                        }
                    });
                }
            });

            $("#sortable").disableSelection();

            $(document).on('click', '.messageDetails', function () {
                var details = $(this).data('details');
                $('#messageText').html(details);
                $('#message_modal').modal('show');
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
                                window.location.href = "{{route('sliders.index')}}";
                            }, 1000);
                        } else if (response.result == 'success') {
                            $.unblockUI();
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.href = "{{route('sliders.index')}}";
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

