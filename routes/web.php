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
Route::get('/listofuser','HomeController@user')->name('userlist');
Route::delete('/listofuser/{id}','HomeController@destroy')->name('deluser');
Route::resource('category','CategoryController');
Route::resource('hotel','HotelController');
Route::resource('tour','TourController');
