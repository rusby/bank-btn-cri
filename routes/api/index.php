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


// Route::group(['middleware' => ['auth:sanctum'] ], function () {
// 	// B2B
// });
Route::get('financeType', 'BTN\B2BController@financeType')->name('financeType');
Route::get('loanType', 'BTN\B2BController@loanType')->name('loanType');
Route::get('employmentType', 'BTN\B2BController@employmentType')->name('employmentType');
Route::get('searchProvince', 'BTN\B2BController@searchProvince')->name('searchProvince');

Route::get('searchCity', 'BTN\B2BController@searchCity')->name('searchCity');
Route::get('searchDistrict', 'BTN\B2BController@searchDistrict')->name('searchDistrict');
Route::get('searchSubDistrict', 'BTN\B2BController@searchSubDistrict')->name('searchSubDistrict');
Route::get('searchPostCodeLocation', 'BTN\B2BController@searchPostCodeLocation')->name('searchPostCodeLocation');
Route::get('searchBranchOffice', 'BTN\B2BController@searchBranchOffice')->name('searchBranchOffice');

Route::post('housingLoanInsertApplicationNonstock', 'BTN\B2BController@housingLoanInsertApplicationNonstock')->name('housingLoanInsertApplicationNonstock');
Route::get('housingLoanApplicationList', 'BTN\B2BController@housingLoanApplicationList')->name('housingLoanApplicationList');
Route::post('smeLoanInsertApplication', 'BTN\B2BController@smeLoanInsertApplication')->name('smeLoanInsertApplication');

Route::get('propertySearch', 'BTN\PropertyController@propertySearch')->name('propertySearch');
Route::get('retrieveHousing', 'BTN\PropertyController@retrieveHousing')->name('retrieveHousing');
Route::get('retrieveHousingById', 'BTN\PropertyController@retrieveHousingById')->name('retrieveHousingById');
Route::get('retrieveHouseType', 'BTN\PropertyController@retrieveHouseType')->name('retrieveHouseType');
Route::get('retrieveHouseTypeById', 'BTN\PropertyController@retrieveHouseTypeById')->name('retrieveHouseTypeById');
Route::get('retrieveHouseLot', 'BTN\PropertyController@retrieveHouseLot')->name('retrieveHouseLot');
Route::get('retrieveHouseLotById', 'BTN\PropertyController@retrieveHouseLotById')->name('retrieveHouseLotById');
Route::get('retrieveDeveloperById', 'BTN\PropertyController@retrieveDeveloperById')->name('retrieveDeveloperById');
Route::get('retrieveNearbyHousing', 'BTN\PropertyController@retrieveNearbyHousing')->name('retrieveNearbyHousing');


// BTN Submission
Route::get('initialEntry', 'BTN\SubmissionController@initialEntry')->name('initialEntry');
Route::get('submissiontab', 'BTN\SubmissionController@submissiontab')->name('submissiontab');
Route::get('personalInformation', 'BTN\SubmissionController@personalInformation')->name('personalInformation');
Route::get('spouseInformation', 'BTN\SubmissionController@spouseInformation')->name('spouseInformation');
Route::get('jobInformation', 'BTN\SubmissionController@jobInformation')->name('jobInformation');
Route::get('loanApplication', 'BTN\SubmissionController@loanApplication')->name('loanApplication');
Route::get('uploadDocument', 'BTN\SubmissionController@uploadDocument')->name('uploadDocument');
Route::get('removeDocument', 'BTN\SubmissionController@removeDocument')->name('removeDocument');
Route::get('confirmDocument', 'BTN\SubmissionController@confirmDocument')->name('confirmDocument');
Route::get('submitFinal', 'BTN\SubmissionController@submitFinal')->name('submitFinal');
Route::get('entryDetail', 'BTN\SubmissionController@entryDetail')->name('entryDetail');
Route::get('entryTracking', 'BTN\SubmissionController@entryTracking')->name('entryTracking');

// BTN Simulation
Route::get('simulationHousingLoanConventional', 'BTN\SimulationController@simulationHousingLoanConventional')->name('simulationHousingLoanConventional');
Route::get('simulationHousingLoanSharia', 'BTN\SimulationController@simulationHousingLoanSharia')->name('simulationHousingLoanSharia');

