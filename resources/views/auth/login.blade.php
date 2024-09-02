@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="card mb-0 h-auto">
                    <div class="card-body">
                        <div class="text-center mb-2">
                            <a href="{{route('admin.dashboard')}}">
                                <img width="100" height="100" src="{{asset('images/logon.png')}}" fill="none">
                            </a>
                        </div>
                        <h4 class="text-center mb-4">Sign in your account</h4>
                        <form method="POST" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="mb-4 position-relative">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password" required autocomplete="current-password">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-row d-flex flex-wrap justify-content-between mt-4 mb-2">
                                <div class="form-group">
                                    <div class="form-check custom-checkbox ms-1">
                                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                        <label class="form-check-label" for="remember_me">Remember my preference</label>
                                    </div>
                                </div>
                                <div class="form-group ms-2">
                                    @if (Route::has('password.request'))
                                        <a class="btn-link" href="{{ route('password.request') }}">Forgot Password?</a>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary btn-block loginBtn">Sign Me In</button>
                            </div>
                        </form>
{{--                        <div class="new-account mt-3">--}}
{{--                            <p>Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up</a></p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $("#passwordLogin").keydown(function (e) {
                if (e.keyCode == 13) {
                    $('.loginBtn').click();
                }
            });

            $('.loginBtn').click(function (e) {
                var data = $('#loginForm').serialize();
                $.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff !important'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{route("login")}}',
                    data: data,
                    success: function (response, status) {
                        if (response.result == 'success') {
                            $.unblockUI();
                            successMsg(response.message);
                            if (response.data == 'same_page') {
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                setTimeout(function () {
                                    window.location.href = response.data.url;
                                }, 1000);
                            }
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
