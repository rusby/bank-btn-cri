@extends('layouts.auth')

@section('content')
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content mt-5">
                        <h2 class="">Pendaftaran Marketing <br /></h2>
                        <p class="signup-link mt-3 mb-5" style="font-size: 16px !important;">Sudah memiliki akun marketing ?
                            <a class="text-success" href="{{ route('view.login') }}"
                                style="color: #2571cf !important">Log in</a>
                        </p>
                        <form class="text-left" method="POST" id="register" action="{{ route('auth.register') }}"
                            enctype="multipart/form-data">
                            <div class="form">
                                <div id="name-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Name">
                                </div>

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="username" type="text" class="form-control"
                                        placeholder="Username">
                                </div>
                                <div id="email-field" class="field-wrapper input">
                                    <i class="text-success" data-feather="mail"></i>
                                    <input id="email" name="email" type="text" value="" placeholder="Email">
                                </div>
                                <div id="nohp-field" class="field-wrapper input">
                                    <i class="text-success" data-feather="phone"></i>
                                    <input name="no_hp" type="number" value="" placeholder="No Handphone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13">
                                </div>
                                <div id="role-field" class="field-wrapper input">
                                    <select name="role_id" class="form-control">
                                        <option value="">Pilih Jenis Marketing</option>
                                        @foreach ($roles as $r)
                                            <option value="{{ $r }}">{{ $r }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="div-nama_developer" class="field-wrapper input" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="nama_developer" name="nama_developer" type="text" class="form-control"
                                        placeholder="Nama Developer">
                                </div>
                                <div class="field-wrapper input">
                                    <svg style="color: rgb(16, 150, 72)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <input id="nama_perumahan" name="nama_perumahan" type="text" class="form-control"
                                        placeholder="Nama Perumahan">
                                </div>
                                <div class="mb-4" id="div-kartu_nama" style="display: none">
                                    <label class="label">Pilih file Kartu Nama</label>
                                    <input type="file" class="form-control" name="kartu_nama">
                                </div>
                                <div class="mb-4" id="div-ktp">
                                    <label class="label">Pilih file KTP</label>
                                    <input type="file" class="form-control" name="ktp">
                                </div>


                                <div class="alert alert-success" role="alert">
                                    <strong>Password kombinasi, angka, dan huruf. Minimal 1 huruf besar & maksimal 8
                                        karakter.</strong>
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" value="" placeholder="Password">
                                </div>

                                <div id="confirm-password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="#109648" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control" placeholder="Password Confirmation">
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
                                        <button id="registerBtn" type="submit" class="btn btn-success"
                                            value="">Daftar!</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions mt-5">© {{ date('Y') }} All Rights Reserved. <a
                                class="text-success" href="{{ route('/') }}">{{ env('APP_NAME') }}</a> is a product
                            of PT CRI. <a class="text-success" href="javascript:void(0);">Cookie Preferences</a>, <a
                                class="text-success" href="javascript:void(0);">Privacy</a>, and <a class="text-success"
                                href="javascript:void(0);">Terms</a>.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image" style="background-image: url('../logo/logo.png');">
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/inputmask/jquery.inputmask.bundle.js') }}"></script>

    <script type="text/javascript">
        $('#register').submit(function(e) {
            e.preventDefault();

            if ($('#div-kartu_nama').css('display') != 'none') {
                if ($("[name=kartu_nama]")[0].files.length == 0) {
                    Snackbar.show({
                        text: 'Kartu nama belum diupload, Silakan upload Kartu nama terlebih dahulu',
                        pos: 'top-left',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                    return
                }

                let ext = $("[name=kartu_nama]")[0].files[0].name.split('.')[1]
                if ($.inArray(ext, ['jpg', 'png', 'jpeg', 'bmp']) == -1) {
                    Snackbar.show({
                        text: 'Kartu nama harus berformat jpg, png, atau bmp',
                        pos: 'top-left',
                        actionTextColor: '#fff',
                        backgroundColor: '#e7515a'
                    });
                    return
                }
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form_data = new FormData($(this)[0]);
            form_data.append('ktp', $('[name=ktp]').prop('files')[0]);
            if ($('#div-kartu_nama').css('display') != 'none') {
                form_data.append('kartu_nama', $('[name=kartu_nama]').prop('files')[0]);
            }

            $.ajax({
                type: 'post',
                url: $(this).attr("action"),
                data: form_data,
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('#registerBtn').html(
                        '<div class="spinner-border text-white mr-2 align-self-center loader-sm ">Loading...</div>Loading'
                    );
                    $('#registerBtn').prop('disabled', true);
                },
                success: function(data) {
                    console.log(data)
                    if (data.status == "ok") {
                        Snackbar.show({
                            text: data.messages,
                            pos: 'top-left',
                            actionTextColor: '#fff',
                            backgroundColor: '#8dbf42'
                        });
                        setTimeout(function() {
                            window.location.href = "/auth/login";
                        }, 1400);
                    }
                },
                error: function(data) {
                    var data = data.responseJSON;
                    console.log(data.responseText)
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
                    $('#registerBtn').html('Daftar!');
                    $('#registerBtn').prop('disabled', false);
                }
            });
        });

        $('[name=role_id]').change(function() {
            let val = $(this).val()
            if (val == "sales developer") {
                $('#div-kartu_nama').show(400)
                $('#div-nama_developer').show(400)
            } else {
                $('#div-kartu_nama').hide(400)
                $('[name=kartu_nama]').val(null)
                $('[name=nama_developer]').val(null)
            }
        })
        $('body').on('click', '#toggle-password', function() {
            if ($(this).is(':checked')) {
                $('#password, #password_confirmation').attr('type', 'text')
            } else {
                $('#password, #password_confirmation').attr('type', 'password')
            }
        })
    </script>
@endsection