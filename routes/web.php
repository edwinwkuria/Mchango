<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::resource('/fundraiser','FundraiserController');
Route::post('/B2Cconfirmation','MpesaC2bController@B2Cconfirmation');
Route::post('/B2Cvalidation','MpesaC2bController@B2Cvalidation');
Route::post('/C2BWithdraw','MpesaB2cController@Withdraw');
Route::get('/registerapi','MpesaC2bController@registerUrl');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
