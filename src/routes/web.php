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

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/info', function(){phpinfo();});



Route::get('/manage/shift', 'ShiftController@index');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@attend');

Route::get('/logout', 'HomeController@logout');

Route::get('/list', "API\WorkTimeAPIController@timelist");

Route::get("shift","API\WorkTimeAPIController@currentDayShift");
Route::get("attend/{type}","API\WorkTimeAPIController@registAttend");


Route::get("manage/report_format","ManageController@reportFormat");

Route::get("/api/report_format/get","API\ReportFormatAPIController@getReportFormat");

Route::get("/api/report_format/save","API\ReportFormatAPIController@SaveReportFormat");







//
//Route::get('/vue', function () {
//    return view('welcome');
//});
