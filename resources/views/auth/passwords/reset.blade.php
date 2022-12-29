@extends('layouts.auth')

@section('content')
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="mb-4">Reset password <a href="{{ route('/') }}"><span
                                class="brand-name">{{ env("APP_NAME") }}</span></a></h1>

                    @error('email')
                    <div class="alert alert-danger" id="exception">
                        <strong class="m-0">{{ $message }}</strong>
                    </div>
                    @enderror
                    <form id="resetForm" class="text-left" action="{{ route('auth.password.update') }}" method="POST">
                        @csrf
                        <div class="form">
                            <input type="hidden" name="token" id="token" value="{{ $token }}">
                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input readonly id="email" name="email" type="text" class="form-control"
                                    placeholder="email" value="{{ $email }}">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password" name="password" type="password" class="form-control"
                                    placeholder="Password" required autofocus>
                            </div>
                            <div id="confirm-password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="form-control" placeholder="Password Confirmation" required>
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
                                    <button class="btn btn-primary">Update password</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <p class="terms-conditions mt-3">© 2020 All Rights Reserved. <a
                            href="{{ route('/') }}">{{ env("APP_NAME") }}</a> is a
                        product of BRI.
                        <a href="javascript:void(0);">Cookie Preferences</a>, <a href="javascript:void(0);">Privacy</a>,
                        and <a href="javascript:void(0);">Terms</a>.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
            <div class="img-content">
            </div>
        </div>
    </div>
</div>
@endsection