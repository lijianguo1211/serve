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
    Route::get('trait','SonController@index');
    Route::get('trait1','SonController@edit');
    Route::get('trait2','IndexController@edit');
    Route::get('trait3','IndexController@save');
    Route::get('trait4','IndexController@save1');
    Route::get('trait5','IndexController@sayHello');
    Route::get('trait6','IndexController@sayHello1');
    Route::get('trait7','IndexController@sayHelloWorld');
    Route::get('trait8','IndexController@sayXiaoLiZi');
    Route::get('trait9','IndexController@sayStatic');
    Route::get('trait10','IndexController@sayTime');
    Route::get('trait11','IndexController@sayAttributes');
});

Route::group(['namespace'=>'Api','prefix'=>'api','middleware'=>'apiLog'],function(){
   Route::post('login','UserController@login');//登录
   Route::post('logout','UserController@logout');//退出
   Route::post('refresh','UserController@refresh');//刷新
   Route::post('me','UserController@me');
});

Route::group(['namespace'=>'Test','prefix'=>'test'],function(){
    Route::get('index','IndexController@index');
});