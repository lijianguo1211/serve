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

Route::get('/', 'IndexController@index');


Route::get('testMd', 'IndexController@test');
Route::get('testHash', 'IndexController@testHash');



Route::get('confirm', 'Auth\ConfirmController@confirm')->name('confirm');
Route::get('send-confirm-mail', 'Auth\ConfirmController@sendMail')->name('send-confirm-mail');

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');


Route::get('details/{id}', 'IndexController@details')->where('id', '[0-9]+');
Route::get('image', 'ImgController@index');
Route::post('ajaxComment/{id}', 'IndexController@ajaxComment')->where('id', '[0-9]+');
Route::post('ajaxGetComment/{id}', 'IndexController@ajaxGetComment')->where('id', '[0-9]+');



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
    Route::get('downloadExcel','IndexController@downloadExcel');
    Route::get('index1','UserController@index');

    Route::get('redis','RedisNumController@index');
    Route::get('testredis','RedisNumController@test');
});

//Route::group(['namespace'=>'Api','prefix'=>'api','middleware'=>'apiLog'],function(){
Route::group(['namespace'=>'Api','prefix'=>'api'],function(){
   //Route::post('login','UserController@login');//登录
   Route::post('logout','UserController@logout');//退出
   Route::post('refresh','UserController@refresh');//刷新
   Route::post('me','UserController@me');
   Route::get('test','CreateImageController@test');
   Route::get('createImage','CreateImageController@createImage');

   Route::get('createDocument','ElasticsearchController@createDocument');
   Route::get('getDocument','ElasticsearchController@getDocument');
   Route::get('existsDocument','ElasticsearchController@existsDocument');
   Route::get('searchDocument','ElasticsearchController@searchDocument');
   Route::get('deleteDocument','ElasticsearchController@deleteDocument');
   Route::get('deleteIndex','ElasticsearchController@deleteIndex');
   Route::get('createIndex','ElasticsearchController@createIndex');
   Route::get('getIndex','ElasticsearchController@getIndex');
   Route::get('updateIndex','ElasticsearchController@updateIndex');
   Route::get('bulkDocument','ElasticsearchController@bulkDocument');
   Route::get('getNamespace','ElasticsearchController@getNamespace');
});

Route::group(['namespace'=>'Test','prefix'=>'test'],function(){
    Route::get('index','IndexController@index');
    Route::get('testSql','IndexController@testSql');
    Route::get('testJson','IndexController@testJson');
    Route::get('time','IndexController@time');
});

Route::group(['namespace'=>'Monitor','prefix'=>'monitor'],function(){
    Route::get('addUser','UserController@addUser');
});
Route::group(['namespace'=>'Arrays','prefix'=>'arrays'],function(){
    Route::get('index','NewArrayController@index');
    Route::get('joinForeach','NewArrayController@joinForeach');
    Route::get('foreachJoin','NewArrayController@foreachJoin');
});

Route::group(['namespace'=>'Observer','prefix'=>'observer'],function(){
    Route::get('index','Location@index');
    Route::get('then','SessionClass@then');
    Route::get('test','SessionClass@index');
});

Route::group(['namespace'=>'Swool','prefix'=>'swool'],function(){
    Route::get('index','IndexController@index');
    Route::get('indexSql','PsqlController@index');
    Route::get('downloadExcel','PsqlController@downloadExcel');
    Route::any('/');
});


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/','UserController@index');//后台登录
    //Route::post('doLogin','UserController@login');//登录提交
    Route::get('testEmail','UserController@testEmail');//显示发送邮件模板
    Route::post('passwordRetrieve','UserController@passwordRetrieve');//发送邮件
    Route::get('index','IndexController@index');//首页
    Route::get('list','UserController@list');//管理员列表
    Route::get('adduser','UserController@add');//添加管理员显示
    Route::post('add_admin','UserController@add_admin');//提交管理员

    Route::resource('type','TypeController');//添加文章分类
    Route::get('type_del/{id}','TypeController@del')->where('id','[0-9]+');//删除文章分类

    /*
     * 添加文章
     */
    Route::get('blog/creates','BlogController@create');
    Route::post('blog/insert','BlogController@insert');
    Route::get('blog/index','BlogController@index');
    Route::post('blog/upload_image','BlogController@upload_image');

    /**
     * 添加热点图片
     */
    Route::get('image/creates','ImgController@create');
    Route::post('image/inserts','ImgController@add');
    Route::get('image/index','ImgController@index');
    Route::post('image/upload','ImgController@upload');

    /**
     * header
     */
    Route::get('header/creates','HeaderController@create');
    Route::post('header/insert','HeaderController@insert');
    Route::get('header/index','HeaderController@index');
    Route::get('header/show/{id}','HeaderController@show')->where('id','[0-9]+');
    Route::get('header/edit/{id}','HeaderController@edit')->where('id','[0-9]+');
    Route::get('header/edits/{id}','HeaderController@submitEdit')->where('id','[0-9]+');
    Route::get('header/del/{id}','HeaderController@del')->where('id','[0-9]+');

    /**
     * right
     */
    Route::get('right_top/creates','RightTopsController@create');
    Route::post('right_top/inserts','RightTopsController@insert');
    Route::get('right_top/index','RightTopsController@index');
    Route::get('right_top/show/{id}','RightTopsController@show')->where('id','[0-9]+');
    Route::get('right_top/edit/{id}','RightTopsController@edit')->where('id','[0-9]+');
    Route::post('right_top/edits/{id}','RightTopsController@submitEdit')->where('id','[0-9]+');
    Route::get('right_top/del/{id}','RightTopsController@del')->where('id','[0-9]+');

    Route::get('role_index_list','RoleController@index_list');
    Route::get('role_index_list_ajax','RoleController@index_list_ajax');
    Route::any('role_index','RoleController@role_index');//角色列表
    Route::post('role_index_ajax','RoleController@role_index_ajax');
    Route::any('role_user','RoleController@role_user');

    Route::get('access_index','RoleController@access_index');
    Route::post('access_index_ajax','RoleController@access_index');
    Route::get('accessList','RoleController@accessList');
    Route::get('accessListAjax','RoleController@accessListAjax');

    Route::get('test','TestController@testRedis');
    Route::get('mail','TestController@mail');
    Route::get('mail1','TestController@saveEmail');
    Route::get('test2','TestController@test2');
    Route::get('indexSave','TestController@index');
    Route::get('test3','TestController@index1');
    Route::get('test4','TestController@index2');
    Route::get('test5','TestController@index3');

    //后台登录
    //Route::get('indexLogin','AdminController@index');//视图显示
    Route::post('registerAdmin','AdminController@registerAdmin');//登录提交
    Route::get('logout','AdminController@logout');//退出登录
    Route::get('logoImg','AdminController@logoImg');//用户设置自己的图像

});
