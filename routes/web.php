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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/data-init', 'DataController@initForm')->name('init-form');
Route::post('/data-init', 'DataController@init')->name('init');
Route::get('/data-export', 'DataController@export');
Route::resource('/data', 'DataController');
