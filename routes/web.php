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
                return view('welcome', [
            ]);
            } else if (Auth::user()){
                User::check_in(Auth::user()->id);
                return view('welcome', [
                    "messages"=>Message::where('user_id', Auth::user()->id)
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

Route::get('/home', 'HomeController@index');

Route::resource('contact','ContactController');
Route::resource('ContactInfo','ContactInfoController');
Route::resource('message','MessageController');
