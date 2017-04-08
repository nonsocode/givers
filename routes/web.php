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

// Route::group(['domain' => 'givers.app'], function() {
	Auth::routes();

	Route::get('/', 'PagesController@index');
	Route::get('/home', 'PagesController@index')->middleware(['auth']);

	Route::group(['prefix' => 'dashboard'], function() {
		Route::get('/', 'OfficeController@index');
		Route::get('refferals', 'OfficeController@refferals');
	});
// });
Route::group(['prefix'=>'json','middleware' =>['auth']],function(){
	Route::resource('phs','JSON\ProvideHelpController');
	Route::resource('ghs','JSON\GetHelpController');
});