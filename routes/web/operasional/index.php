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

Route::group(['prefix' => 'operasional', 'as' => 'operasional.', 'middleware' => 'role:operasional|Kantor Pusat|Kantor Wilayah|Kantor Cabang|Kantor Cabang Pembantu|Kantor Cabang Khusus|operasional verifikator|sales lepas|sales developer'], function () {
	Route::post('/data-diri/{collection_id}', 'Operasional\OperasionalController@storeDataDiri');
	Route::post('/data-analisa-finansial/{collection_id}', 'Operasional\OperasionalController@storeAnalisaFinansial');
	Route::post('/data-agunan/{collection_id}', 'Operasional\OperasionalController@storeAgunan');
	Route::post('/data-uji-flpp/{collection_id}', 'Operasional\OperasionalController@storeUjiFlpp');
});
Route::post('operasional/collection/cust_delete/{id}', 'Operasional\CollectionController@custDelete')->name('operasional.collection.cust_delete');

Route::group(['prefix' => 'operasional', 'as' => 'operasional.', 'middleware' => 'role:operasional|Kantor Pusat|Kantor Wilayah|Kantor Cabang|Kantor Cabang Pembantu|Kantor Cabang Khusus|operasional verifikator|superadmin'], function () {
	Route::get('/dashboard', 'Operasional\DashboardOperasionalController@index')->name('dashboard');
	Route::get('/collection/dataTables', 'Operasional\CollectionController@getDatatble')->name('collection.dataTables');
// 	Route::post('/collection/cust_delete/{id}', 'Operasional\CollectionController@custDelete')->name('collection.cust_delete');
	Route::resource('/collection', Operasional\CollectionController::class);	
	
	Route::get('/user/dataTables', 'Operasional\UserController@getDatatble')->name('user.dataTables');
	Route::resource('/user', Operasional\UserController::class);

	Route::group(['prefix' => 'verification', 'as' => 'verification.'], function () {
		Route::get('/project/dataTables', 'Operasional\Verification\ProjectController@getDatatble')->name('project.dataTables');
		Route::resource('/project', Operasional\Verification\ProjectController::class);
	});

	Route::group(['prefix' => 'validasi', 'as' => 'validasi.'], function () {
		Route::get('/dataTables', 'Operasional\ValidasiController@getDatatble')->name('dataTables');
		Route::get('/kirim_data', 'Operasional\ValidasiController@kirimData')->name('kirim_data');
		Route::resource('/', Operasional\ValidasiController::class);
	});

	// BTN COLLECTION
	// BTN B2B
	Route::get('/get_token', 'BTN\B2BController@getDataToken')->name('get_token');
	Route::get('operasional/b2btab', 'BTN\B2BController@b2btab')->name('b2btab');
	Route::get('operasional/financetypetab', 'BTN\B2BController@financetypetab')->name('financetypetab');
	Route::get('operasional/loantypetab', 'BTN\B2BController@loantypetab')->name('loantypetab');
	Route::get('operasional/employmenttypetab', 'BTN\B2BController@employmenttypetab')->name('employmenttypetab');
	Route::get('operasional/searchdatatab', 'BTN\B2BController@searchdatatab')->name('searchdatatab');
	Route::get('operasional/housingloanapplicationtab', 'BTN\B2BController@housingloanapplicationtab')->name('housingloanapplicationtab');
	Route::get('operasional/smeloantypeapplicationtab', 'BTN\B2BController@smeloantypeapplicationtab')->name('smeloantypeapplicationtab');

	Route::get('operasional/financeType', 'BTN\B2BController@financeType')->name('financeType');
	Route::get('operasional/loanType', 'BTN\B2BController@loanType')->name('loanType');
	Route::get('operasional/employmentType', 'BTN\B2BController@employmentType')->name('employmentType');
	Route::get('operasional/searchProvince', 'BTN\B2BController@searchProvince')->name('searchProvince');

	Route::get('operasional/searchCity', 'BTN\B2BController@searchCity')->name('searchCity');
	Route::get('operasional/searchDistrict', 'BTN\B2BController@searchDistrict')->name('searchDistrict');
	Route::get('operasional/searchSubDistrict', 'BTN\B2BController@searchSubDistrict')->name('searchSubDistrict');
	Route::get('operasional/searchPostCodeLocation', 'BTN\B2BController@searchPostCodeLocation')->name('searchPostCodeLocation');
	Route::get('operasional/searchBranchOffice', 'BTN\B2BController@searchBranchOffice')->name('searchBranchOffice');
	
	Route::post('operasional/housingLoanInsertApplicationNonstock', 'BTN\B2BController@housingLoanInsertApplicationNonstock')->name('housingLoanInsertApplicationNonstock');
	Route::get('operasional/housingLoanApplicationList', 'BTN\B2BController@housingLoanApplicationList')->name('housingLoanApplicationList');
	Route::post('operasional/smeLoanInsertApplication', 'BTN\B2BController@smeLoanInsertApplication')->name('smeLoanInsertApplication');

	//BTN Property
		
	Route::get('operasional/propertytab', 'BTN\PropertyController@propertytab')->name('propertytab');
	Route::get('operasional/retrievehousingtab', 'BTN\PropertyController@retrievehousingtab')->name('retrievehousingtab');
	Route::get('operasional/retrievehousetypetab', 'BTN\PropertyController@retrievehousetypetab')->name('retrievehousetypetab');
	Route::get('operasional/retrievehouselottab', 'BTN\PropertyController@retrievehouselottab')->name('retrievehouselottab');
	Route::get('operasional/retrievehousenearbytab', 'BTN\PropertyController@retrievehousenearbytab')->name('retrievehousenearbytab');
	Route::get('operasional/searchdatapropertiestab', 'BTN\PropertyController@searchdatapropertiestab')->name('searchdatapropertiestab');


	Route::get('operasional/propertySearch', 'BTN\PropertyController@propertySearch')->name('propertySearch');
	Route::get('operasional/retrieveHousing', 'BTN\PropertyController@retrieveHousing')->name('retrieveHousing');
	Route::get('operasional/retrieveHousingById', 'BTN\PropertyController@retrieveHousingById')->name('retrieveHousingById');
	Route::get('operasional/retrieveHouseType', 'BTN\PropertyController@retrieveHouseType')->name('retrieveHouseType');
	Route::get('operasional/retrieveHouseTypeById', 'BTN\PropertyController@retrieveHouseTypeById')->name('retrieveHouseTypeById');
	Route::get('operasional/retrieveHouseLot', 'BTN\PropertyController@retrieveHouseLot')->name('retrieveHouseLot');
	Route::get('operasional/retrieveHouseLotById', 'BTN\PropertyController@retrieveHouseLotById')->name('retrieveHouseLotById');
	Route::get('operasional/retrieveDeveloperById', 'BTN\PropertyController@retrieveDeveloperById')->name('retrieveDeveloperById');
	Route::get('operasional/retrieveNearbyHousing', 'BTN\PropertyController@retrieveNearbyHousing')->name('retrieveNearbyHousing');

	// BTN Submission
	Route::get('operasional/initialEntry', 'BTN\SubmissionController@initialEntry')->name('initialEntry');
	Route::get('operasional/submissiontab', 'BTN\SubmissionController@submissiontab')->name('submissiontab');
	Route::get('operasional/personalInformation', 'BTN\SubmissionController@personalInformation')->name('personalInformation');
	Route::get('operasional/spouseInformation', 'BTN\SubmissionController@spouseInformation')->name('spouseInformation');
	Route::get('operasional/jobInformation', 'BTN\SubmissionController@jobInformation')->name('jobInformation');
	Route::get('operasional/loanApplication', 'BTN\SubmissionController@loanApplication')->name('loanApplication');
	Route::get('operasional/uploadDocument', 'BTN\SubmissionController@uploadDocument')->name('uploadDocument');
	Route::get('operasional/removeDocument', 'BTN\SubmissionController@removeDocument')->name('removeDocument');
	Route::get('operasional/confirmDocument', 'BTN\SubmissionController@confirmDocument')->name('confirmDocument');
	Route::get('operasional/submitFinal', 'BTN\SubmissionController@submitFinal')->name('submitFinal');
	Route::get('operasional/entryDetail', 'BTN\SubmissionController@entryDetail')->name('entryDetail');
	Route::get('operasional/entryTracking', 'BTN\SubmissionController@entryTracking')->name('entryTracking');
	
	// BTN Simulation
	Route::get('operasional/simulationtab', 'BTN\SimulationController@simulationtab')->name('simulationtab');
	Route::get('operasional/simulationHousingLoanConventional', 'BTN\SimulationController@simulationHousingLoanConventional')->name('simulationHousingLoanConventional');
	Route::get('operasional/simulationHousingLoanSharia', 'BTN\SimulationController@simulationHousingLoanSharia')->name('simulationHousingLoanSharia');

	// Route::post('/bt2b/FynanceType', 'Collection\CollectionController@FynanceType')->name('FynanceType');

});
Route::group(['prefix' => 'operasional', 'as' => 'operasional.'], function () {
	Route::get('collection-download', 'FileController@getZip');
});
