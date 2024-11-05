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
        <div class="col-lg-12">
            <div class="row tab-content" id="galleryContainer">
                @include('admin.animalGallery.gallery_items', ['animalGalleries' => $animalGalleries])
            </div>
            <!-- Load More Button -->
            @if($animalGalleries->hasMorePages())
                <div class="d-flex justify-content-center mt-3">
                    <button id="loadMore" class="btn btn-primary" data-url="{{ $animalGalleries->nextPageUrl() }}">
                        Load More
                    </button>
                </div>
            @endif
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

            $('#loadMore').on('click', function() {
                let url = $(this).data('url');
                if (url) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        beforeSend: function() {
                            $('#loadMore').prop('disabled', true).text('Loading...');
                        },
                        success: function(response) {
                            if (response.html) {
                                $('#galleryContainer').append(response.html);
                                $('#loadMore').data('url', response.nextPageUrl).prop('disabled', false).text('Load More');

                                // Hide the button if no more pages
                                if (!response.nextPageUrl) {
                                    $('#loadMore').remove();
                                }
                            }
                        },
                        error: function() {
                            alert('Could not load more items.');
                            $('#loadMore').prop('disabled', false).text('Load More');
                        }
                    });
                }
            });
        });
    </script>
@endsection

