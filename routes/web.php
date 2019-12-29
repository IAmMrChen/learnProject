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

/** 后台部分 start **/
Route::get('/get_admin_info', "Info\InfoController@getAdminInfo");  // 获取当天的开奖信息
Route::post('/change_time', "Info\InfoController@changeTime");  // 修改时间
/** 后台部分 end **/

/** 前台部分 start **/

// 页面部分
Route::get('/index', "Info\InfoController@index");

// 接口部分
Route::get('/get_web_info', "Info\InfoController@getWebInfo");  // 获取开奖信息
/** 前台部分 end **/

// 测试使用
Route::get('/test', "Info\InfoController@test");  //
Route::get('/get', "Info\InfoController@get");  //
