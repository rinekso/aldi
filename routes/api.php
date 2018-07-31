<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'article'],function(){
    Route::get('all','ArticleController@getAllJson');
    Route::get('page/{limit}','ArticleController@getPageJson');
    Route::get('limit/{limit}','ArticleController@getLimitJson');
    Route::get('detail/{id}','ArticleController@getDetailJson');
    Route::get('search/{input}','ArticleController@search');
});
Route::group(['prefix'=>'gallery'],function(){
    Route::get('detail/{id}','GalleryController@getDetailJson');
});
Route::group(['prefix'=>'account'],function(){
    Route::get('detail/{id}','UserController@getDetailJson');
});
