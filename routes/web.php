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

Route::get('/', 'HomeController@index')->name('home');

Route::resource('event', 'EventController');

Route::get('/user/events', 'EventController@userEvents')->name('user.events');

Route::get('search/date', 'SearchController@searchDate')->name('search.date');
