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

Route::post('check-title', 'AjaxController@checkTitle');

Route::get('search/date', 'SearchController@showSearchDate')->name('show.search.date');

Route::post('search/date', 'AjaxController@searchDate')->name('search.date');

Route::get('search/city', 'SearchController@showSearchCity')->name('show.search.city');

Route::post('search/city', 'SearchController@searchCity')->name('search.city');
