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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('status', 'StatusController');

    Route::get('/profile/{profile}', 'ProfileController@show');
    Route::get('/profile/{profile}/edit', 'ProfileController@edit');
    Route::patch('/profile/{profile}', 'ProfileController@update');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
