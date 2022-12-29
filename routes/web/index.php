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
// Route::get('init', function(){
//     define('STDIN',fopen("php://stdin","r"));
//     \Artisan::call('migrate', [
//         '--force' => true
//     ]);
//     echo "sukses";
// });

Route::get('/', function(){
    if (Auth::check()) {
        $role = Auth::user()->getRoleNames()->first();
        // dd($role);
        if ($role == "Kantor Pusat") {
            return redirect(route('pusat.collection'));
        }elseif ($role == "Kantor Wilayah") {
            return redirect(route('wilayah.collection'));
        }elseif ($role == "Kantor Cabang") {
            return redirect(route('cabang.collection'));
        }elseif ($role == "Kantor Cabang Pembantu") {
            return redirect(route('cabang_pembantu.collection'));
        }elseif ($role == "Kantor Cabang Khusus") {
            return redirect(route('cabang_khusus.collection'));
        }elseif ($role == "superadmin" || $role == "admin bri" || $role == "admin cri" || $role == "operasional" || $role == "operasional verifikator") {
            return redirect(route('dashboard'));
        }elseif ($role == "sales developer" || $role == "sales lepas") {
            return redirect(route('dashboard'));
        }else{
            abort(405);
        }
    }else{
        return redirect('auth/login');
    }
})->name('/');

require 'admin/index.php';
require 'operasional/index.php';
require 'collection/index.php';
require 'auth/index.php';

Route::get('file/download/{id}', 'FileController@download')->name('file.download');
Route::get('file/open/{id}', 'FileController@open')->name('file.open');
Route::get('/kantor_pusat/collection', 'BRI\DashboardController@pusatIndex')->name('pusat.collection');
Route::get('/bri/collection/dataTable', 'BRI\DashboardController@getDatatableBRI')->name('bri.collection.dataTable');
Route::get('/kantor_wilayah/collection', 'BRI\DashboardController@pusatWilayah')->name('wilayah.collection');
Route::get('/cabang/collection', 'BRI\DashboardController@pusatCabang')->name('cabang.collection');
Route::get('/cabang_khusus/collection', 'BRI\DashboardController@pusatCabangKhusus')->name('cabang_khusus.collection');
Route::get('/cabang_pembantu/collection', 'BRI\DashboardController@pusatCabangPembantu')->name('cabang_pembantu.collection');
Route::post('/ubah_status', 'BRI\DashboardController@ubahStatus')->name('kantor.ubah_status');

Route::get('/v_detail/{id}', 'Operasional\ValidasiController@show')->name('v_detail');
Route::post('/v_post/{id}', 'Operasional\ValidasiController@customUpdate')->name('v_detail.update');
Route::get('/collection_export/{id}', 'ExcelController@exportCollection')->name('export.collection');
Route::post('/collection_export_tabulasi', 'ExcelController@exportTabulasi')->name('export.collection_tabulasi');

Route::get('import_uker', 'ExcelController@importUker');
Route::get('import_user', 'ExcelController@importUser');
Route::get('dashboard', 'DashboardController@getDashboard')->name('dashboard');
Route::get('profile/{id}/{uname}', 'ProfileController@getProfile');
Route::post('save_profile', 'ProfileController@saveProfile');

Route::get('cri/laporan', 'CRIController@laporan')->name('cri.report.index');
Route::get('cri/laporan/dataTable', 'CRIController@datatableLaporan')->name('cri.report.datatable');
Route::post('/cri/collection_export_tabulasi', 'CRIController@exportTabulasiCRI')->name('export.cri.collection_tabulasi');


// Route::get('/get_token', 'BTN\B2BController@getDataToken')->name('get_token');
// Route::get('searchBranchOffice', 'BTN\B2BController@searchBranchOffice')->name('searchBranchOffice');
// Route::get('housingLoanInsertApplicationNonstock', 'BTN\B2BController@housingLoanInsertApplicationNonstock')->name('housingLoanInsertApplicationNonstock');
// Route::get('housingLoanApplicationList', 'BTN\B2BController@housingLoanApplicationList')->name('housingLoanApplicationList');
// Route::get('smeLoanInsertApplication', 'BTN\B2BController@smeLoanInsertApplication')->name('smeLoanInsertApplication');
// Route::get('retrieveHouseLot', 'BTN\PropertyController@retrieveHouseLot')->name('retrieveHouseLot');
Route::get('retrieveHouseType', 'BTN\PropertyController@retrieveHouseType')->name('retrieveHouseType');
Route::get('retrieveHouseType', 'BTN\PropertyController@retrieveHouseType')->name('retrieveHouseType');


Route::group(['middleware' => 'role:superadmin|admin cri|operasional'], function () {
    Route::get('draft', 'DraftController@index')->name('draft.index');
});