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
use App\Confirmation;
use App\Message;
use App\User;
Auth::routes();
Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

Route::get('/', [
        'as'=>'root',
        function (Request $request) {
            if (Auth::guest()){
                return view('public', [
                ]);
            } else if (Auth::user()){
                User::check_in(Auth::user()->id);
                return view('welcome', [
                    "messages"=>Message::where('user_id', Auth::user()->id)
                      ->orderBy("created_at", "desc")
                      ->orderBy("check_in_due", "desc")->get(),
                ]);
            }

}]);
Route::get('/logout', function(Request $request){
    Auth::logout();
    return view ('errors.userNeedsConfirmation');
});
Route::get('/verify/{email}/confirm/{confirmation_code}', [
    'as' => 'confirmation_path',
    'uses' => 'UserController@verify'
]);
Route::get('/user/{id}/{check_in_uuid}/', ['as'=>'public-check-in', 'uses'=>'UserController@publicCheckIn']);
Route::get('/home', 'HomeController@index');
Route::get('/settings', ['as'=>'user.settings', 'uses'=>'UserController@settings']);
Route::post('/user/{id}/{check_in_uuid}/', ['as'=>'check-in-with-pin', 'uses'=>'UserController@checkInWithPin']);

Route::put("/settings/email-change", ['as'=>'email-change', 'uses'=>'UserController@updateEmail']);
Route::put("/settings/name-change", ['as'=>'name-change', 'uses'=>'UserController@updateName']);
Route::put("/settings/public-profile", ['as'=>'public-profile-change', 'uses'=>'UserController@updatePublicProfile']);
Route::put("/settings/timezone-change", ['as'=>'timezone-change', 'uses'=>'UserController@updateTimeZone']);
Route::resource('contact','ContactController');
Route::resource('ContactInfo','ContactInfoController');
Route::resource('message','MessageController');
