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
use App\Message;

Route::get('/', function () {
    return view('welcome', [
        "messages"=>Message::where('user_id', Auth::user()->id)->get(),
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('message','MessageController');
