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

    Route::patch('/status/{status}/pin', 'StatusController@pin');
    Route::post('/status/{status}/reply', 'StatusController@reply');

    Route::post('/status/{status}/like', 'LikeController@like');
    Route::post('/status/{status}/unlike', 'LikeController@unlike');

    Route::get('/tag', 'TagController@index');
    Route::get('/tag/{tag}', 'TagController@show');

    Route::get('/user/{user}', 'UserController@show');
    Route::get('/user/{user}/edit', 'UserController@edit');
    Route::patch('/user/{user}', 'UserController@update');
    Route::post('/user/{user}/follow', 'UserController@follow');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();
