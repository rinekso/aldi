<?php

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

Route::get('/', 'UserController@index')->middleware('auth');

Route::get('bayar/{menu}', 'UserController@menu')->middleware('auth');
Route::post('bayar/{menu}/proses', 'UserController@bayar')->middleware('auth');
Route::get('menu', 'UserController@menu')->middleware('auth');
Route::get('pdf/cetak', 'UserController@cetakPdf')->middleware('auth');
Route::get('pdf', 'UserController@pdf')->middleware('auth');
Route::post('pembayaran', 'UserController@pembayaran')->middleware('auth');

Route::get('example/download','SiswaController@exportExample');

// admin
Route::group([ 'prefix' => 'adm' , 'middleware' => ['admin']],function(){
	Route::get('/','AdminController@index');
	Route::get('logout','AdminController@logout');
	Route::get('history','AdminController@history');


	Route::get('siswa','SiswaController@index');
	Route::get('siswa/tambah','SiswaController@tambah');
	Route::get('siswa/naik','SiswaController@naik');
	Route::post('siswa/tambah/excel','SiswaController@tambahExcel');
	Route::get('siswa/edit/{id}','SiswaController@edit');
	Route::get('siswa/delete/{id}','SiswaController@delete');
	Route::get('siswa/mutasi/{id}','AdminController@mutasi');
	Route::post('siswa/tambah/process','SiswaController@tambahAction');
	Route::post('siswa/edit/process','SiswaController@editAction');
	
	Route::get('jenis','AdminController@jenis');
	Route::post('pembayaran/tambah','AdminController@pembayaranTambah');
	Route::get('pembayaran/edit/{id}','AdminController@pembayaranEditTampilan');
	Route::post('pembayaran/edit','AdminController@pembayaranEdit');
	Route::get('pembayaran/delete/{id}','AdminController@pembayaranDelete');

	Route::get('jenjang','AdminController@jenjang');
	Route::post('jenjang/tambah','AdminController@jenjangTambah');
	Route::get('jenjang/edit/{id}','AdminController@jenjangEditTampilan');
	Route::post('jenjang/edit','AdminController@jenjangEdit');
	Route::get('jenjang/delete/{id}','AdminController@jenjangDelete');

	Route::get('ajaran','AdminController@ajaran');
	Route::post('ajaran/tambah','AdminController@ajaranTambah');
	Route::get('ajaran/edit/{id}','AdminController@ajaranEditTampilan');
	Route::post('ajaran/edit','AdminController@ajaranEdit');
	Route::get('ajaran/delete/{id}','AdminController@ajaranDelete');
	
	Route::get('topup','AdminController@topup');
	Route::post('topup/process','AdminController@topupProcess');
	Route::post('biaya/ganti','AdminController@biayaGanti');
	
	Route::get('periode','AdminController@periode');
	Route::post('periode/ganti','AdminController@periodeGanti');
	Route::post('periode/tambah','AdminController@periodeTambah');
	Route::get('periode/delete/{id}','AdminController@periodeDelete');
	Route::get('periode/{id}','AdminController@detailPeriode');
	
	Route::get('laporan','AdminController@laporan');
	Route::post('laporan/pembayaran','AdminController@laporanPembayaran');
	Route::post('laporan/topup','AdminController@laporanTopup');

});

// Auth::routes();

Route::post('/login/process', 'AdminController@loginProcess');
Route::get('/login/adm', 'AdminController@toLogin');
Route::get('log/code/{code}','AdminController@logCode');
Route::get('logout','AdminController@logoutUser');
Route::post('/login/user', 'AdminController@loginUser');
Route::get('/login', 'SiswaController@toIndex');
