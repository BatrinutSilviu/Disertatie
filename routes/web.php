<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function() {
	return view('content');
});

Route::get('/jucator', 'JucatorController@index');
Route::post('/jucator', 'JucatorController@salvare')->middleware('auth');

Route::get('/jucator/adaugare', 'JucatorController@adaugare')->middleware('auth');
Route::patch('/jucator/{jucator_ID}', 'JucatorController@actualizare')->middleware('auth');
Route::get('/jucator/{jucator_ID}/modificare', 'JucatorController@modificare')->middleware('auth');
Route::get('/jucator/{jucator_ID}/stergere', 'JucatorController@stergere')->middleware('auth');
//Route::delete('/jucator/{jucator_ID}', 'JucatorController@stergere');

Route::get('/echipa', 'EchipaController@index');
Route::post('/echipa', 'EchipaController@salvare')->middleware('auth');
Route::get('/echipa/adaugare', 'EchipaController@adaugare')->middleware('auth');
Route::patch('/echipa/{echipa_ID}', 'EchipaController@actualizare')->middleware('auth');
Route::get('/echipa/{echipa_ID}/jucatori', 'EchipaController@getJucatori');
Route::get('/echipa/{echipa_ID}/modificare', 'EchipaController@modificare')->middleware('auth');
Route::get('/echipa/{echipa_ID}/stergere', 'EchipaController@stergere')->middleware('auth');
//Route::delete('/echipa/{echipa_ID}', 'EchipaController@stergere');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


// Route::get('/jucator/cautare', 'JucatorController@cautare');

//Route::get('/live_search', 'JucatorController@index');
//Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
