<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Authentication
Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);

//Check user for login
Route::group(['middleware' => ['auth']], function()
{
	Route::get('/', function () {
	    return view('admin.index');
	});

	Route::resource('user', 'UserController');
	Route::resource('remark', 'RemarkController');
	Route::resource('/', 'RemarkController@lineChart');
	Route::resource('jsoncomsite', 'RemarkController@lineChart');
	Route::resource('site', 'SiteController');
	Route::resource('antena', 'AntenaController');
	Route::resource('completesite', 'SiteController@completeSite');
	Route::get('export-comsite', 'ExportFileController@doExport');
	Route::get('download-remark', 'RemarkController@reportRemark');

	//autocomplete
	Route::get('remark/autocomplete/bsc', 'RemarkController@autocompleteBSC');
	Route::get('remark/{id}/autocomplete/bsc', 'RemarkController@autocompleteBSC');
	Route::get('remark/autocomplete/cell', 'RemarkController@autocompleteCELL');
	Route::get('remark/{id}/autocomplete/cell', 'RemarkController@autocompleteCELL');
	Route::get('site/autocomplete/bsc', 'SiteController@autocompleteBSC');
	Route::get('site/{id}/autocomplete/bsc', 'SiteController@autocompleteBSC');
	Route::get('site/autocomplete/site', 'SiteController@autocompleteSITE');
	Route::get('site/{id}/autocomplete/site', 'SiteController@autocompleteSITE');
	Route::get('antena/autocomplete/bsc', 'AntenaController@autocompleteBSC');
	Route::get('antena/{id}/autocomplete/bsc', 'AntenaController@autocompleteBSC');
	Route::get('antena/autocomplete/site', 'AntenaController@autocompleteSITE');
	Route::get('antena/{id}/autocomplete/site', 'AntenaController@autocompleteSITE');
	Route::get('antena/autocomplete/cell', 'AntenaController@autocompleteCELL');
	Route::get('antena/{id}/autocomplete/cell', 'AntenaController@autocompleteCELL');

	//import dan upload excel
	Route::get('import/remark', 'RemarkController@importExcel');
	Route::post('upload/remark', 'RemarkController@uploadExcel');
	Route::get('import/site', 'SiteController@importExcel');
	Route::post('upload/site', 'SiteController@uploadExcel');
	Route::get('import/antena', 'AntenaController@importExcel');
	Route::post('upload/antena', 'AntenaController@uploadExcel');

	//download sample excel
	Route::get('dlfile/remark', 'RemarkController@downloadSample');
	Route::get('dlfile/site', 'SiteController@downloadSample');
	Route::get('dlfile/antena', 'AntenaController@downloadSample');

});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');