<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


// Authentication
Route::post('/authenticate', 'AuthenticationController@authenticate');

// Owners

Route::get('/owners/me/', 'OwnersController@me');
Route::get('/owners/me/paymentReceipts', 'OwnersController@receipts');