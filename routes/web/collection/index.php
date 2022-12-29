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
Route::get('collection/aplikasi/detail/{id}', 'Collection\CollectionController@show')->name('collection.aplikasi.custom_detail');
Route::group(['prefix' => 'collection', 'as' => 'collection.', 'middleware' => 'role:sales lepas|sales developer'], function () {
	Route::get('/dashboard', 'Collection\DashboardController@index')->name('dashboard');

	Route::get('/aplikasi/dataTables', 'Collection\CollectionController@getDatatble')->name('aplikasi.dataTables');
	Route::resource('/aplikasi', Collection\CollectionController::class);

	Route::get('/list_collection', 'Collection\CollectionController@listCollection');
	Route::post('/mapping-name', 'Collection\CollectionController@storeMappingName');
	Route::group(['prefix' => 'flpp'], function () {
		Route::post('/kelengkapan-berkas', 'Collection\CollectionController@storeKelengkapanBerkas');
		Route::post('/tambahan-form-subsidi', 'Collection\CollectionController@storeTambahanKelengkapanBerkas');
	});
	Route::post('/developer-file', 'Collection\CollectionController@storeDeveloperFile');

	Route::get('/developer/dataTables', 'Collection\DeveloperController@getDatatble')->name('developer.dataTables');
	Route::resource('/developer', Collection\DeveloperController::class);
	Route::get('/project/dataTables', 'Collection\ProjectController@getDatatble')->name('project.dataTables');
	Route::resource('/project', Collection\ProjectController::class);

    Route::post('/collection_export_tabulasi', 'Collection\CollectionController@exportTabulasiSales')->name('export.collection_tabulasi');
   

	


});
