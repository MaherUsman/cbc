@extends('layouts.admin.index')
@section('css')
    <!-- Light Gallery -->
    <link href="{{asset('vendor/lightgallery/dist/css/lightgallery.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/lightgallery/dist/css/lg-thumbnail.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/lightgallery/dist/css/lg-zoom.css')}}" rel="stylesheet">
@endsection
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
    </style>

    @include('layouts.admin.includes.breadcrumbs' , ['breadcrumbs' => [['name' =>  __('aboutUsGallery.name') , 'route' => null]],
'pageTitle' => __('aboutUsGallery.pageTitle')
])

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills mb-3">
                {{--<li class="nav-item"><a href="{{route('about-us-galleries.index')}}#list-view" data-bs-toggle="tab"
                                        class="nav-link me-1 show active">{{ __('aboutUsGallery.list_view') }}</a></li>--}}
                {{--<li class="nav-item"><a href="{{route('about-us-galleries.gridView')}}#grid-view" --}}{{--data-bs-toggle="tab"--}}{{--
                    class="nav-link">{{ __('aboutUsGallery.grid_view') }}</a></li>--}}
            </ul>
        </div>
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('aboutUsGallery.list_aboutUsGallery') }}</h4>
                            <a href="{{ route('about-us-galleries.create') }}"
                               class="btn btn-primary">{{ __('aboutUsGallery.add_aboutUsGallery') }}</a>
                        </div>
                        <div class="card-body pb-1">
                            <div id="lightgallery" class="row">
                                @foreach($aboutUsGalleries as $gallery)
                                    <a href="{{asset($gallery->image)}}" data-src="{{asset($gallery->image)}}"
                                       class="lg-item col-lg-3 col-md-6 mb-4">
                                        <img src="{{asset($gallery->image)}}" class="rounded" alt=""
                                             style="width:100%;">
                                    </a>
                                @endforeach
                            </div>
                        </div>
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
    <script src="{{asset('vendor/lightgallery/dist/lightgallery.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/plugins/thumbnail/lg-thumbnail.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/plugins/zoom/lg-zoom.min.js')}}"></script>

    <script>
        $(document).ready(function () {
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
                                window.location.href = "{{route('about-us-galleries.index')}}";
                            }, 1000);
                        } else if (response.result == 'success') {
                            $.unblockUI();
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.href = "{{route('about-us-galleries.index')}}";
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

