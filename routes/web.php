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

Route::get('/login','UserController@login');
Route::get('/logout','UserController@logout');
Route::post('/login','UserController@loginAction');

//Article route
Route::group(['middleware' => 'auth'],function(){
    Route::get('/', 'UserController@index');
    Route::group(['prefix'=>'article'],function(){
        Route::get('/','ArticleController@index');
        Route::post('input','ArticleController@input');
        Route::get('delete/{id}','ArticleController@delete');
    });
    Route::group(['prefix'=>'gallery'],function(){
        Route::get('/','GalleryController@index');
        Route::post('input','GalleryController@input');
        Route::get('delete/{id}','GalleryController@delete');
    });
    Route::group(['prefix'=>'account'],function(){
        Route::get('/','UserController@account');
        Route::post('input','UserController@input');
        Route::get('delete/{id}','UserController@delete');
    });
});

