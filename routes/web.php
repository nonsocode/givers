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

	Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function() {
		Route::get('/', 'OfficeController@index')->name('dashboard');
		Route::get('refferals', 'OfficeController@refferals');
		Route::get('tickets', 'TicketsController@index');
		Route::get('support-tickets', 'TicketsController@index')->name('tickets');
		Route::get('support-tickets/{ticket}', 'TicketsController@show')->name('ticket.view');
		Route::get('profile', "ProfileController@index")->name('profile');
		Route::get('bonuses', "BonusController@index")->name('bonuses.index');
	});
// });
Route::group(['prefix'=>'json','middleware' =>['auth']],function(){
	Route::resource('phs','JSON\ProvideHelpController');
	Route::resource('ghs','JSON\GetHelpController');
});