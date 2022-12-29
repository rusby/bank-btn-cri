<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'role:superadmin|admin bri|admin cri|operasional'], function () {
    Route::get('/user/dataTables', 'Admin\UserController@getDatatble')->name('user.dataTables');
    Route::post('/user/cust_delete/{id}', 'Admin\UserController@custDelete')->name('user.cust_delete');
	Route::resource('/user', Admin\UserController::class);
});