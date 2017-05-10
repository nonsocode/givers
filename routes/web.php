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
Route::get('referral/{email}', 'Auth\RegisterController@referral')->name('referral.link')->middleware('guest');
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
    Route::post('get-help','GetHelpController@store')->name('get-help');

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
	Route::put('transactions/{trn}/pop', 'TransactionsController@pherConfirm')->name('transaction.pop');
	Route::post('transaction/{trn}/letter-of-happiness','TransactionsController@saveLoh')->name('transaction.happiness');

});