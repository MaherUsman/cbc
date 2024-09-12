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
<div class="fix-wrapper">

    @yield('content')
</div>
<!-- Required vendors -->
@include('layouts.admin.includes.scripts.js-scripts')

<!-- On Page Scripts -->
{{--@stack('scripts-js')--}}
@yield('script')
{{--@include('layouts.admin.includes.scripts.custom-js')--}}


</body>
</html>
