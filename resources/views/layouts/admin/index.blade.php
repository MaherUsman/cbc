<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title>HoubaraFund (CBC)</title>

    <!-- Meta -->
@include('layouts.admin.includes.meta')

<!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}">
    <link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/toastr/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/switchery/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/tagify/dist/tagify.css') }}">

    <style>
        .blockUI.blockMsg.blockPage h1 {
            color: #ffffff !important;
        }
    </style>
    @yield("css")
</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">
@if(\Illuminate\Support\Facades\Auth::check())
    <!--**********************************
        Nav header start
    ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img src="{{asset('assets/images/cbc.png')}}" alt="" width="50px" height="50px">
{{--                <svg class="brand-title" xmlns="http://www.w3.org/2000/svg" width="122" height="19" viewBox="0 0 122 19" fill="none">--}}
{{--                    <path d="M5.3 4.3V7.175H10.925V10.9H5.3V14.075H11.675V18H0.4V0.374999H11.675V4.3H5.3ZM25.8564 0.374999C27.7064 0.374999 29.3231 0.749999 30.7064 1.5C32.1064 2.23333 33.1814 3.26667 33.9314 4.6C34.6814 5.93333 35.0564 7.45833 35.0564 9.175C35.0564 10.875 34.6731 12.3917 33.9064 13.725C33.1564 15.0583 32.0814 16.1083 30.6814 16.875C29.2981 17.625 27.6898 18 25.8564 18H18.8814V0.374999H25.8564ZM25.4814 13.675C26.9148 13.675 28.0398 13.2833 28.8564 12.5C29.6731 11.7167 30.0814 10.6083 30.0814 9.175C30.0814 7.725 29.6731 6.60833 28.8564 5.825C28.0398 5.025 26.9148 4.625 25.4814 4.625H23.7814V13.675H25.4814ZM46.8504 0.374999V10.6C46.8504 11.55 47.0671 12.2833 47.5004 12.8C47.9504 13.3167 48.6254 13.575 49.5254 13.575C50.4254 13.575 51.1004 13.3167 51.5504 12.8C52.0171 12.2667 52.2504 11.5333 52.2504 10.6V0.374999H57.1504V10.6C57.1504 12.2167 56.8087 13.6 56.1254 14.75C55.4421 15.8833 54.5087 16.7417 53.3254 17.325C52.1587 17.8917 50.8587 18.175 49.4254 18.175C47.9921 18.175 46.7087 17.8917 45.5754 17.325C44.4587 16.7417 43.5754 15.8833 42.9254 14.75C42.2921 13.6167 41.9754 12.2333 41.9754 10.6V0.374999H46.8504ZM85.2084 0.374999V18H80.3084V8.275L76.9834 18H72.8834L69.5334 8.2V18H64.6334V0.374999H70.5584L74.9834 11.825L79.3084 0.374999H85.2084ZM97.6828 0.374999V18H92.7828V0.374999H97.6828ZM121.583 18H116.683L110.158 8.15V18H105.258V0.374999H110.158L116.683 10.35V0.374999H121.583V18Z" fill="black"/>--}}
{{--                    <text x="10" y="15" font-size="14" font-family="Arial" fill="black">CBC</text>--}}
{{--                </svg>--}}
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
@endif
<!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Chat box start
    ***********************************-->
{{--@include('layouts.admin.includes.chat')--}}
<!--**********************************
        Chat box End
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    {{--    @if(\Illuminate\Support\Facades\Auth::check())--}}
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                    </div>
                    @include('layouts.admin.navbar')
                </div>
            </nav>
        </div>
    </div>
{{--    @endif--}}
<!--**********************************
        Header end ti-comment-alt
    ***********************************-->
{{--    @if(\Illuminate\Support\Facades\Auth::check())--}}
<!--**********************************
        Sidebar start
    ***********************************-->
@include('layouts.admin.sidebar')
<!--**********************************
        Sidebar end
    ***********************************-->
{{--@endif--}}
<!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {{--            @include('layouts.admin.includes.responsemessages')--}}
            @yield("content")
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
@include('layouts.admin.footer')


<!--**********************************
        Footer end
    ***********************************-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dynamicForm">
                        <!-- Dynamic content will be inserted here -->
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
@include('layouts.admin.includes.scripts.js-scripts')
@yield('script')
@include('layouts.admin.includes.scripts.custom-js')


</body>
</html>
