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

Route::get('/', function () {
	$Columns = DB::table('entities')->select('Name', 'Type')->get();
    return view('CustomFieldsForm',compact('Columns'));
});

Route::post('AddCulomn','HomeController@AddCulomn');
Route::get('/Show','HomeController@store');
Route::get('/add','HomeController@BackToAdd');
Route::post('/Record','HomeController@NewRocord');

Route::post('/edit','HomeController@Edit');

Route::post('/delete','HomeController@delete');