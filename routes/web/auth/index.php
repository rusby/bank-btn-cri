<?php

Route::prefix('auth')->group(function () {
    Route::get('/login', 'Auth\LoginController@index')->name('view.login');
    Route::get('/register', 'Auth\RegisterController@index')->name('view.register');

    Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('auth.logout');
    Route::post('/register', 'Auth\RegisterController@store')->name('auth.register');
    Route::post('/email/resend', 'Auth\LoginController@resendEmail')->name('auth.email.resend');

    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetFormCustom');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.update');
});

Auth::routes(['login' => false,'register' => false, 'reset' => false, 'verify' => true]);