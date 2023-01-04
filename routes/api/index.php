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

Route::get('financeType', 'Api\BTN\B2BController@financeType')->name('financeType');
Route::get('loanType', 'Api\BTN\B2BController@loanType')->name('loanType');
Route::get('employmentType', 'Api\BTN\B2BController@employmentType')->name('employmentType');
Route::get('searchProvince', 'Api\BTN\B2BController@searchProvince')->name('searchProvince');

Route::get('searchCity', 'Api\BTN\B2BController@searchCity')->name('searchCity');
Route::get('searchDistrict', 'Api\BTN\B2BController@searchDistrict')->name('searchDistrict');
Route::get('searchSubDistrict', 'Api\BTN\B2BController@searchSubDistrict')->name('searchSubDistrict');
Route::get('searchPostCodeLocation', 'Api\BTN\B2BController@searchPostCodeLocation')->name('searchPostCodeLocation');
Route::get('searchBranchOffice', 'Api\BTN\B2BController@searchBranchOffice')->name('searchBranchOffice');

Route::post('housingLoanInsertApplicationNonstock', 'Api\BTN\B2BController@housingLoanInsertApplicationNonstock')->name('housingLoanInsertApplicationNonstock');
Route::get('housingLoanApplicationList', 'Api\BTN\B2BController@housingLoanApplicationList')->name('housingLoanApplicationList');
Route::post('smeLoanInsertApplication', 'Api\BTN\B2BController@smeLoanInsertApplication')->name('smeLoanInsertApplication');

Route::get('propertySearch', 'Api\BTN\PropertyController@propertySearch')->name('propertySearch');
Route::get('retrieveHousing', 'Api\BTN\PropertyController@retrieveHousing')->name('retrieveHousing');
Route::get('retrieveHousingById', 'Api\BTN\PropertyController@retrieveHousingById')->name('retrieveHousingById');
Route::get('retrieveHouseType', 'Api\BTN\PropertyController@retrieveHouseType')->name('retrieveHouseType');
Route::get('retrieveHouseTypeById', 'Api\BTN\PropertyController@retrieveHouseTypeById')->name('retrieveHouseTypeById');
Route::get('retrieveHouseLot', 'Api\BTN\PropertyController@retrieveHouseLot')->name('retrieveHouseLot');
Route::get('retrieveHouseLotById', 'Api\BTN\PropertyController@retrieveHouseLotById')->name('retrieveHouseLotById');
Route::get('retrieveDeveloperById', 'Api\BTN\PropertyController@retrieveDeveloperById')->name('retrieveDeveloperById');
Route::get('retrieveNearbyHousing', 'Api\BTN\PropertyController@retrieveNearbyHousing')->name('retrieveNearbyHousing');


// BTN Submission
Route::post('initial-entry', 'Api\BTN\SubmissionController@initialEntry')->name('initialEntry');
Route::post('personal-information', 'Api\BTN\SubmissionController@personalInformation')->name('personalInformation');
Route::post('spouse-information', 'Api\BTN\SubmissionController@spouseInformation')->name('spouseInformation');
Route::post('job-information', 'Api\BTN\SubmissionController@jobInformation')->name('jobInformation');
Route::post('loan-application', 'Api\BTN\SubmissionController@loanApplication')->name('loanApplication');
Route::post('upload-document', 'Api\BTN\SubmissionController@uploadDocument')->name('uploadDocument');
Route::get('removeDocument', 'BTN\SubmissionController@removeDocument')->name('removeDocument');
Route::post('confirm-document', 'BTN\SubmissionController@confirmDocument')->name('confirmDocument');
Route::get('submitFinal', 'BTN\SubmissionController@submitFinal')->name('submitFinal');
Route::get('entryDetail', 'BTN\SubmissionController@entryDetail')->name('entryDetail');
Route::get('entryTracking', 'BTN\SubmissionController@entryTracking')->name('entryTracking');
Route::get('initialEntry', 'Api\BTN\SubmissionController@initialEntry')->name('initialEntry');
Route::get('submissiontab', 'Api\BTN\SubmissionController@submissiontab')->name('submissiontab');
Route::get('personalInformation', 'Api\BTN\SubmissionController@personalInformation')->name('personalInformation');
Route::get('spouseInformation', 'Api\BTN\SubmissionController@spouseInformation')->name('spouseInformation');
Route::get('jobInformation', 'Api\BTN\SubmissionController@jobInformation')->name('jobInformation');
Route::get('loanApplication', 'Api\BTN\SubmissionController@loanApplication')->name('loanApplication');
Route::get('uploadDocument', 'Api\BTN\SubmissionController@uploadDocument')->name('uploadDocument');
Route::get('removeDocument', 'Api\BTN\SubmissionController@removeDocument')->name('removeDocument');
Route::get('confirmDocument', 'Api\BTN\SubmissionController@confirmDocument')->name('confirmDocument');
Route::get('submitFinal', 'Api\BTN\SubmissionController@submitFinal')->name('submitFinal');
Route::get('entryDetail', 'Api\BTN\SubmissionController@entryDetail')->name('entryDetail');
Route::get('entryTracking', 'Api\BTN\SubmissionController@entryTracking')->name('entryTracking');

// BTN Simulation
Route::get('simulationHousingLoanConventional', 'Api\BTN\SimulationController@simulationHousingLoanConventional')->name('simulationHousingLoanConventional');
Route::get('simulationHousingLoanSharia', 'Api\BTN\SimulationController@simulationHousingLoanSharia')->name('simulationHousingLoanSharia');
