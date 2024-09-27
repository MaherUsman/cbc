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

    @include('layouts.admin.includes.breadcrumbs' , ['breadcrumbs' => [['name' =>  __('animalGalleries.name') , 'route' => null]],
'pageTitle' => $animal->title.' '.__('animalGalleries.pageTitle')
])

    <div class="row">
{{--        <div class="col-lg-12">--}}
{{--            <ul class="nav nav-pills mb-3">--}}
{{--                <li class="nav-item"><a href="{{route('animal-galleries.index',$animal)}}#list-view" data-bs-toggle="tab"--}}
{{--                                        class="nav-link me-1 show active">{{ __('animalGalleries.list_view') }}</a></li>--}}
{{--                <li class="nav-item"><a href="{{route('animal-galleries.gridView',$animal)}}#grid-view" --}}{{--data-bs-toggle="tab"--}}
{{--                    class="nav-link">{{ __('animalGalleries.grid_view') }}</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $animal->title.' '.__('animalGalleries.pageTitle') }}</h4>
                            <a href="{{ route('animal-galleries.create',$animal) }}"
                               class="btn btn-primary">{{ __('animalGalleries.add').$animal->title.__('animalGalleries.gallery') }}</a>
                        </div>
                        <div class="card-body pb-1">
                            <div id="lightgallery" class="row">
                                @foreach($animal->animalGalleries()->orderBy('display_order','asc')->get() as $gallery)
                                    <div class="col-lg-3 col-md-6 mb-4">
                                        <div class="gallery-img-wrapper position-relative w-100 h-100">
                                            <a
                                                href="{{asset($gallery->image)}}"
                                                data-src="{{asset($gallery->image)}}"
                                                class="lg-item"
                                            >
                                                <img
                                                    src="{{asset($gallery->image)}}"
                                                    class="rounded" alt=""
                                                    style="width:100%;"
                                                >
                                            </a>
                                            <div class="gallery-overlay rounded">
                                                <div class="overlay-icons-wrapper w-100 d-flex flex-column align-items-end">
                                                    <div class="overlay-icon mt-2">
                                                        <a href="{{route('animal-galleries.edit', $gallery)}}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>
                                                    <div class="overlay-icon mt-2">
                                                        <a href="#" data-url="{{ route('animal-galleries.destroy', $gallery) }}" title="Delete"
                                                           class="deleteRecord" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="img-title mt-3">
                                                    <p>{{$gallery->title}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
{{--                                    <a href="{{asset($gallery->image)}}" data-src="{{asset($gallery->image)}}"--}}
{{--                                       class="lg-item col-lg-3 col-md-6 mb-4">--}}
{{--                                        <img src="{{asset($gallery->image)}}" class="rounded" alt=""--}}
{{--                                             style="width:100%;">--}}
{{--                                    </a>--}}
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
                                window.location.href = "{{route('animal-galleries.index',$animal)}}";
                            }, 1000);
                        } else if (response.result == 'success') {
                            $.unblockUI();
                            successMsg(response.message);
                            setTimeout(function () {
                                window.location.href = "{{route('animal-galleries.index',$animal)}}";
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

