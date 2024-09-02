<script src="{{ asset('vendor/global/global.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>


<!-- Chart sparkline plugin files -->
<script src="{{ asset('vendor/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/plugins-init/sparkline-init.js') }}"></script>

<!-- Chart Morris plugin files -->
<script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('vendor/morris/morris.min.js') }}"></script>

<!-- Init file -->
<script src="{{ asset('js/plugins-init/widgets-script-init.js') }}"></script>


<script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins-init/datatables.init.js')}}"></script>

<!-- Svganimation scripts -->
<script src="{{ asset('vendor/svganimation/vivus.min.js') }}"></script>
<script src="{{ asset('vendor/svganimation/svg.animation.js') }}"></script>
<script src="{{ asset('vendor/toastr/js/toastr.min.js') }}"></script>
{{--<script src="{{ asset('js/plugins-init/toastr-init.js') }}"></script>--}}
<script src="{{ asset('vendor/switchery/switchery.min.js') }}"></script>

<!-- Demo scripts -->
<script src="{{ asset('js/dashboard/dashboard.js') }}"></script>

<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/dlabnav-init.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/styleSwitcher.js') }}"></script>
<script src="{{ asset('vendor/jqueryvalidator/jquery-validator.min.js') }}"></script>
<script src="{{ asset('vendor/jqueryvalidator/additional-methods.min.js') }}"></script>
<script src="{{ asset('vendor/tagify/dist/tagify.js') }}"></script>

<script src="{{asset('js/blockUI/jquery.blockUI.js')}}"></script>

<script>

    $.blockUI.defaults.baseZ = 2000;

    function successMsg(_msg) {
        toastr.success('', _msg, {
            positionClass: "toast-top-right",
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1
        });
    }

    function errorMsg(_msg) {
        toastr.error("", _msg, {
            positionClass: "toast-top-right",
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1
        })
    }

    function warningMsg(_msg) {
        toastr.warning("", _msg, {
            positionClass: "toast-top-right",
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1
        })
    }

    function infoMsg(_msg) {
        toastr.info("", _msg, {
            positionClass: "toast-top-right",
            timeOut: 5e3,
            closeButton: !0,
            debug: !1,
            newestOnTop: !0,
            progressBar: !0,
            preventDuplicates: !0,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            tapToDismiss: !1
        })
    }

    @foreach ($errors->all() as $error)
    errorMsg({{$error}})
    @endforeach

    @if(Session::has('success'))
    successMsg('{{Session::get("success")}}');
    @endif

    @if(Session::has('error'))
    errorMsg("{{Session::get('error')}}");
    @endif

    $(document).ready(function () {
        // Get the active menu item
        var activeMenuItem = $('.nav-item.active');

        if (activeMenuItem.length > 0) {
            var scrollPosition = activeMenuItem.offset().top - $('.sidebar-body').offset().top - 15;
            $('.sidebar-body').animate({
                scrollTop: scrollPosition
            }, 800);
        }
    });

</script>
