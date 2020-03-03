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

// Route::get('/', function () {
    // return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'BingoController@index')->name('index');
Route::get('signup', 'BingoController@signup')->name('signup');
Route::post('regist', 'BingoController@regist')->name('regist');
Route::get('issue/{issuer_id}', 'BingoController@issue')->name('bingo.issue');
// Route::get('card', 'BingoController@card')->name('bingo.card');
Route::get('card/{encrypt_card_id}', 'BingoController@card')->name('bingo.card');
Route::post('card/select_num', 'BingoController@select_num')->name('bingo.self_select');

Route::group(['middleware' => 'auth'], function() {
	Route::get('issuer', 'IssuerController@index')->name('issuer.index');
	Route::get('issuer/number', 'IssuerController@number')->name('issuer.number');
	Route::post('issuer/delete_card', 'IssuerController@delete_card')->name('bingo.delete');
	Route::post('issuer/select_num', 'IssuerController@select_num')->name('bingo.select');
	Route::get('issuer/account', 'IssuerController@account')->name('issuer.account');
	Route::post('issuer/account/update/{issuer_id}', 'IssuerController@account_update')->name('issuer.account.update');
	Route::post('issuer/account/delete/{issuer_id}', 'IssuerController@account_delete')->name('issuer.account.delete');
});