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

Route::get('/jucator', 'JucatorController@index')->name('jucator.index');
Route::post('/jucator', 'JucatorController@salvare')->middleware('auth');
Route::get('/jucator/adaugare', 'JucatorController@adaugare')->middleware('auth');
Route::post('/jucator/filtrare', 'JucatorController@filtrare');
Route::get('/jucator/cauta', 'JucatorController@cauta')->name('jucator.cauta');
Route::patch('/jucator/{jucator_ID}', 'JucatorController@actualizare')->middleware('auth');
Route::get('/jucator/{jucator_ID}/modificare', 'JucatorController@modificare')->middleware('auth');
Route::get('/jucator/{jucator_ID}/stergere', 'JucatorController@stergere')->middleware('auth');
Route::get('/jucator/piton', 'JucatorController@piton');

Route::get('/echipa', 'EchipaController@index')->name('echipa.index');
Route::post('/echipa', 'EchipaController@salvare')->middleware('auth');
Route::get('/echipa/adaugare', 'EchipaController@adaugare')->middleware('auth');
Route::post('/echipa/filtrare', 'EchipaController@filtrare');
Route::get('/echipa/mea', 'EchipaController@afisare_echipa_mea');
Route::get('/echipa/cauta', 'EchipaController@cauta')->name('echipa.cauta');
Route::patch('/echipa/{echipa_ID}', 'EchipaController@actualizare')->middleware('auth');
Route::get('/echipa/{echipa_ID}/jucatori', 'EchipaController@getJucatori');
Route::get('/echipa/{echipa_ID}/modificare', 'EchipaController@modificare')->middleware('auth');
Route::get('/echipa/{echipa_ID}/stergere', 'EchipaController@stergere')->middleware('auth');

Route::get('/nationala', 'NationalaController@index')->name('nationala.index');
Route::post('/nationala', 'NationalaController@salvare')->middleware('auth');
Route::get('/nationala/adaugare', 'NationalaController@adaugare')->middleware('auth');
Route::post('/nationala/filtrare', 'NationalaController@filtrare');
Route::get('/nationala/cauta', 'NationalaController@cauta')->name('nationala.cauta');
Route::patch('/nationala/{nationala_ID}', 'NationalaController@actualizare')->middleware('auth');
Route::get('/nationala/{nationala_ID}/jucatori', 'NationalaController@getJucatori');
Route::get('/nationala/{nationala_ID}/modificare', 'NationalaController@modificare')->middleware('auth');
Route::get('/nationala/{nationala_ID}/stergere', 'NationalaController@stergere')->middleware('auth');

Route::get('/meci', 'MeciController@index')->name('meci.index');
Route::post('/meci', 'MeciController@salvare')->middleware('auth');
Route::get('/meci/adaugare', 'MeciController@adaugare')->middleware('auth');
Route::post('/meci/filtrare', 'MeciController@filtrare');
// Route::get('/meci/cauta', 'MeciController@cauta')->name('nationala.cauta');
Route::patch('/meci/{meci_ID}', 'MeciController@actualizare')->middleware('auth');
Route::get('/meci/{meci_ID}/jucatori', 'MeciController@getJucatori');
Route::get('/meci/{meci_ID}/modificare', 'MeciController@modificare')->middleware('auth');
Route::get('/meci/{meci_ID}/stergere', 'MeciController@stergere')->middleware('auth');

Route::get('/tara/cauta', 'TaraController@cauta')->name('tara.cauta');
Route::get('/competitie/cauta', 'CompetitieController@cauta')->name('competitie.cauta');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
	