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

Route::get('/', 'UserController@index');
Route::post('menu', 'UserController@menu');
Route::post('pembayaran', 'UserController@pembayaran');

// admin
Route::group([ 'prefix' => 'adm' , 'middleware' => ['admin']],function(){
	Route::get('/','AdminController@index');
	Route::get('history','AdminController@history');
	Route::get('siswa','SiswaController@index');
	Route::get('siswa/tambah','SiswaController@tambah');
	Route::get('siswa/edit/{id}','SiswaController@edit');
	Route::post('siswa/tambah/process','SiswaController@tambahAction');
	Route::post('siswa/edit/process','SiswaController@editAction');
	Route::get('topup','AdminController@topup');
	Route::post('topup/process','AdminController@topupProcess');
	Route::post('biaya/ganti','AdminController@biayaGanti');
});

// Auth::routes();

Route::post('/login/process', 'AdminController@loginProcess');
Route::get('/login', function(){
	return view('admin.login');
});
