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

Route::get('/', 'PagesController@index');
Auth::routes();
Route::get('user/activation/{token}', 'Auth\RegisterController@activateUser')->name('user.activate');
Route::get('user/activation/resend/token', 'Auth\RegisterController@resendForm')->name('user.activate.resend');
Route::post('user/activation/resend', 'Auth\RegisterController@resendToken')->name('resendToken');



Route::group(['prefix' => config('dashboard.name'),'middleware'=>'auth'], function() {

    Route::get('/', 'DashboardController@index')->name(config('routes.prefix').'dashboard');
    Route::get('provide-help/create', 'ProvideHelpController@create')->name('provide-help.create');
    Route::post('provide-help/store', 'ProvideHelpController@store')->name('provide-help.store');
    Route::delete('provide-help/{ph}', 'ProvideHelpController@delete')->name('provide-help.delete');

    Route::get('get-help/create', 'GetHelpController@create')->name('get-help.create');
    Route::delete('get-help/{gh}', 'GetHelpController@delete');

    Route::get('/earnings', "EarningsController@index")->name(config('view.dashboard').'earnings.index');

    Route::get('/tickets', 'TicketsController@index')->name(config('routes.prefix').'tickets.index');
	Route::get('/tickets/create', 'TicketsController@create')->name(config('routes.prefix').'tickets.create');
	Route::post('/tickets/store', 'TicketsController@store')->name(config('routes.prefix').'tickets.store');
	Route::get('/ticket/{ticket}', 'TicketsController@show')->name(config('routes.prefix').'ticket.view');
	Route::patch('/ticket/{ticket}', 'TicketsController@closeTicket')->name(config('routes.prefix').'ticket.close');
	Route::post('/ticket/{ticket}/new-message', 'TicketsController@newTicketMessage')->name('newTicketMessage');

	Route::get('/referrals', 'ReferralsController@index')->name(config('routes.prefix').'referrals.index');

	Route::get('/profile', "ProfileController@index")->name(config('routes.prefix').'profile.index');
	Route::patch('/profile/password', "ProfileController@password")->name(config('routes.prefix').'profile.password');

	Route::get('/bonuses', "BonusController@index")->name(config('routes.prefix').'bonuses.index');

	Route::get('transactions/{trn}', 'TransactionsController@show')->name('transaction');
	Route::put('transactions/pher_confirm/{trn}', 'TransactionsController@pherConfirm')->name('transaction.pher_confirm');

});
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function() {
	Route::get('/', 'OfficeController@index')->name('dashboard');

	// Route::get('tickets', function (){return view('office.tickets.index');});
	// Route::get('support-tickets', 'TicketsController@index')->name('tickets');
	// Route::get('support-tickets/create', 'TicketsController@create')->name('tickets.create');
	// Route::post('support-tickets/store', 'TicketsController@store')->name('tickets.store');
	// Route::get('support-tickets/{ticket}', 'TicketsController@show')->name('ticket.view');
	// Route::patch('support-tickets/{ticket}', 'TicketsController@closeTicket')->name('ticket.close');
	// Route::post('support-tickets/{ticket}/new-message', 'TicketsController@newTicketMessage')->name('newTicketMessage');

	Route::get('profile', "ProfileController@index")->name('profile');
	Route::get('bonuses', "BonusController@index")->name('bonuses.index');
});


Route::group(['prefix'=>'json','middleware' =>['auth']],function(){
	Route::resource('phs','JSON\ProvideHelpController');
	Route::resource('ghs','JSON\GetHelpController');
});