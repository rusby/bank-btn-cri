<?php
Route::post('/upload-file', 'Api\CollectionController@store');
Route::post('/store-collection', 'Api\CollectionController@storeCollection');

Route::group(['prefix' => 'collection', 'middleware' => ['auth:sanctum'] ], function () {
	Route::post('/mapping-name', 'Api\CollectionController@storeMappingName');
	Route::group(['prefix' => 'flpp'], function () {
		Route::post('/kelengkapan-berkas', 'Api\CollectionController@storeKelengkapanBerkas');
		Route::post('/tambahan-form-subsidi', 'Api\CollectionController@storeTambahanKelengkapanBerkas');
	});
	Route::post('/developer-file', 'Api\CollectionController@storeDeveloperFile');	
});

Route::group(['prefix' => 'auth'], function () {
	Route::post('/register', 'Api\AuthController@register');
	Route::post('/login', 'Api\AuthController@login');

	Route::group(['middleware' => ['auth:sanctum']], function () {
		Route::post('/profile', 'Api\AuthController@getProfile');

    	// API route for logout user
		Route::post('/logout', 'Api\AuthController@logout');
	});
});
Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::get('/total_collection', 'Api\DebiturController@totalCollection');
	Route::get('/collection', 'Api\DebiturController@listCollection');
	Route::get('/report_excel', 'Api\DebiturController@exportExcel');
});

Route::group(['prefix' => 'operasional', 'middleware' => ['auth:sanctum'] ], function () {
	Route::post('/data-diri/{collection_id}', 'Api\OperasionalController@storeDataDiri');
	Route::post('/data-analisa-finansial/{collection_id}', 'Api\OperasionalController@storeAnalisaFinansial');
	Route::post('/data-agunan/{collection_id}', 'Api\OperasionalController@storeAgunan');
	Route::post('/data-uji-flpp/{collection_id}', 'Api\OperasionalController@storeUjiFlpp');
});

Route::get('/status', 'Api\DebiturController@getStatus');
Route::get('/status/history', 'Api\DebiturController@getStatusHistory');
Route::get('download-dokumen/{type}', 'Api\DebiturController@getDokumen');

Route::get('/general/provinsi', 'Api\general\Provinsi@main')->name('api.get.provinsi');
Route::get('/general/kota', 'Api\general\Kota@main')->name('api.get.kota');
Route::get('/general/kantor_cabang', 'Api\general\Kota@kantorCabang')->name('api.get.kantorCabang');
Route::get('/general/custom_kantor_cabang', 'Api\general\Kota@getKancaCustom');
Route::get('/general/kecamatan', 'Api\general\Kecamatan@main')->name('api.get.kecamatan');
Route::get('/general/kelurahan', 'Api\general\Kelurahan@main')->name('api.get.kelurahan');
Route::get('/general/kodepos', 'Api\general\Kodepos@main')->name('api.get.kodepos');
