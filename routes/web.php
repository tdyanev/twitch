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

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/lang/{locale}', 'HomeController@lang')->name('lang');
Route::get('/panel', 'AuthController@panel')->name('panel');
Route::post('/save', 'AuthController@save')->name('save');