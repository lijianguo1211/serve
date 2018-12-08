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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace'=>'Home','prefix'=>'home'],function(){
    Route::get('test','IdCordController@test');
    Route::get('tests','IndexController@test');
    Route::get('index','IndexController@index')->middleware('apiLog');
});

Route::group(['namespace'=>'Api','prefix'=>'api','middleware'=>'apiLog'],function(){
   Route::post('login','UserController@login');//登录
   Route::post('logout','UserController@logout');//退出
   Route::post('refresh','UserController@refresh');//刷新
   Route::post('me','UserController@me');
});