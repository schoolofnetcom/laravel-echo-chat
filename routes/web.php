<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'chat', 'as' => 'chat.', 'middleware' => 'auth'], function (){
    Route::get('rooms', 'RoomsController@index')->name('rooms.list');
    Route::get('rooms/{id}', 'RoomsController@show')->name('rooms.show');
    Route::post('rooms/{id}/message', 'RoomsController@createMessage')->name('rooms.create_message');
});

