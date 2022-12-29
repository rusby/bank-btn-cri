@extends('layouts.auth')

@section('content')
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Log In to <a href="{{ route('/') }}"><span
                                    class="brand-name text-success"
                                    style="color: #dd45e7 !important">{{ env('APP_NAME') }}</span></a></h1>
                        <p class="signup-link mb-4" style="font-size: 16px !important;">Registrasi untuk akun marketing
                            perumahan <a class="text-success" href="{{ route('view.register') }} "
                                style="color: #2571cf !important">Klik Registrasi</a>
                        </p>

                        <div class="alert alert-danger d-none" id="emailNotif">
                            <div class="row">
                                <div class="col-md-9">
                                    <strong>Email belum terverifikasi</strong>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#resendEmailModal">Resend</button>
                                </div>
                            </div>
                        </div>

                        @if (Session::get('verified'))
                            <div class="alert alert-success" id="emailVerif">
                                <strong class="m-0">Email sudah terverifikasi</strong>
                            </div>
                        @endif

                        @if (Session::get('exception'))
                            <div class="alert alert-danger" id="exception">
                                <strong class="m-0">{{ Session::get('exception') }}</strong>
                            </div>
                        @endif

                        @if (Session::get('status'))
                            <div class="alert alert-success" id="emailVerif">
                                <strong class="m-0">{{ Session::get('status') }}</strong>
                            </div>
                        @endif

                        <form id="loginForm" class="text-left" action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <span style="color: red;font-size: 12px">*direkomendasi menggunakan google chrome pada saat mengakses website</span>
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="email" name="email" type="text" class="form-control"
                                        placeholder="Email/Username">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="Password">
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button class="btn btn-success" id="loginbtn">Log In</button>
                                    </div>

                                </div>

                                <!-- <div class="field-wrapper text-center keep-logged-in">
                                                    <div class="n-chk new-checkbox checkbox-outline-success">
                                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                                            <input type="checkbox" class="new-control-input">
                                                            <span class="new-control-indicator"></span>Keep me logged in
                                                        </label>
                                                    </div>
                                                </div> -->

                                <div class="field-wrapper">
                                    <!-- <a href="{{ url('auth/register') }}" class="forgot-pass-link text-success">Register</a> -->
                                    <a href="#" data-toggle="modal" data-target="#resendPasswordModal"
                                        class="forgot-pass-link text-success">Butuh Bantuan?</a>
                                        <a href="https://play.google.com/store/apps/details?id=com.ptcri" class="forgot-pass-link text-primary" target="_blank">Download Aplikasi CRI (Marketing)</a>
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions mt-3">© {{ date('Y') }} All Rights Reserved. <a
                                class="text-success" href="{{ route('/') }}">{{ env('APP_NAME') }}</a> is a
                            product of CRI.
                            <a class="text-success" href="javascript:void(0);">Cookie Preferences</a>, <a
                                class="text-success" href="javascript:void(0);">Privacy</a>,
                            and <a class="text-success" href="javascript:void(0);">Terms</a>.
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image" style="background-image: url('../logo/logo.png');">
                <div class="img-content">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resendEmailModal" tabindex="-1" role="dialog" aria-labelledby="resendEmailModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resendEmailModal">Resend Email Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="resendEmailForm" class="pt-2" method="POST"
                    action="{{ route('auth.email.resend') }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent border-right-0">
                                        <i class="text-success" data-feather="mail"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg border-left-0" id="resendEmail"
                                    name="email" placeholder="Email" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="resendEmailBtn" class="btn btn-success">Submit</button>
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resendPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resendPasswordModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resendPasswordModal">
                        Silakan hubungi Whatsapp berikut jika ada kendala : 
                        <a href="https://api.whatsapp.com/send?phone=6282110150021" target="_blank" class="text-primary" style="display: block;">0821 1015 0021</a>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--<form id="resetPasswordForm" class="pt-2" method="POST"-->
                <!--    action="{{ route('auth.password.reset') }}">-->
                <!--    <div class="modal-body">-->
                <!--        @csrf-->
                <!--        <div class="form-group">-->
                <!--            <label for="exampleInputEmail">Email</label>-->
                <!--            <div class="input-group">-->
                <!--                <div class="input-group-prepend">-->
                <!--                    <span class="input-group-text bg-transparent border-right-0">-->
                <!--                        <i class="text-success" data-feather="mail"></i>-->
                <!--                    </span>-->
                <!--                </div>-->
                <!--                <input type="text" class="form-control form-control-lg border-left-0" id="resendEmail"-->
                <!--                    name="email" placeholder="Email" autofocus>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="modal-footer">-->
                <!--        <button id="resetPassBtn" class="btn btn-success">Submit</button>-->
                <!--        <button class="btn btn-light" data-dismiss="modal">Cancel</button>-->
                <!--    </div>-->
                <!--</form>-->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#email').change(function() {
                $('#resendEmail').val($(this).val());
            });
        });

        $('#loginForm').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name=_token]').val()
                }
            });

            $.ajax({
                type: 'post',
                url: $(this).attr("action"),
                data: $(this).find('input, select').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#loginbtn').html(
                        '<div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>Loading'
                    );
                    $('#loginbtn').prop('disabled', true);
                },
                success: function(data) {
                    if (data.status == "ok") {
                        Snackbar.show({
                            text: data.messages,
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            actionText: 'X',
                            backgroundColor: '#8dbf42'
                        });
                        setTimeout(function() {
                            window.location.href = "/";
                        }, 1000);
                    }
                },
                error: function(data) {
                    var data = data.responseJSON;

                    if (data.status == "fail") {
                        Snackbar.show({
                            text: data.messages,
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            actionText: 'X',
                            backgroundColor: '#e7515a'
                        });
                        if (data.email === true) {
                            $('#emailNotif').removeClass('d-none');
                        }
                    }
                },
                complete: function() {
                    $('#loginbtn').html('Login');
                    $('#loginbtn').prop('disabled', false);
                }
            });
        });

        $('#resendEmailForm').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: $(this).attr("action"),
                data: $(this).find('input').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#resendEmailBtn').html(
                        '<div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>Loading'
                    );
                    $('#resendEmailBtn').prop('disabled', true);
                },
                success: function(data) {
                    if (data.status == "ok") {
                        Snackbar.show({
                            text: data.messages,
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42'
                        });
                        $('#resendEmailModal').modal('hide');
                    }
                },
                error: function(data) {
                    var data = data.responseJSON;

                    if (data.status == "fail") {
                        Snackbar.show({
                            text: data.messages,
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a'
                        });
                    }
                },
                complete: function() {
                    $('#resendEmailBtn').html('Submit');
                    $('#resendEmailBtn').prop('disabled', false);
                }
            });
        });

        $('#resetPasswordForm').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: $(this).attr("action"),
                data: $(this).find('input').serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#resetPassBtn').html(
                        '<div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>Loading'
                    );
                    $('#resetPassBtn').prop('disabled', true);
                },
                success: function(data) {
                    Snackbar.show({
                        text: "Cek email anda untuk mereset password",
                        pos: 'top-left',
                        actionTextColor: '#fff',
                        backgroundColor: '#8dbf42'
                    });

                    $('#resendPasswordModal').modal('hide');
                },
                error: function(data) {
                    var origin = data;
                    var data = data.responseJSON;
                    if (origin.status == 422) {
                        Snackbar.show({
                            text: data.message,
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            backgroundColor: '#e7515a'
                        });

                        $('#resetPassBtn').html('Submit');
                        $('#resetPassBtn').prop('disabled', false);
                    } else {
                        $('#resetPassBtn').html('Submit');
                        $('#resetPassBtn').prop('disabled', false);

                        Snackbar.show({
                            text: "Cek email anda untuk mereset password",
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42'
                        });

                        $('#resendPasswordModal').modal('hide');

                    }
                }
            });
        });
    </script>
@endsection
