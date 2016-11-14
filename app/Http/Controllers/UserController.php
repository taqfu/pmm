<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Auth;

class UserController extends Controller
{
    //
    public function verify($email, $confirmation_code){
        if( ! $confirmation_code){
            return View('errors.confirmationInvalid');
        }

        $user = User::where('email', $email)->where('confirmation_code', $confirmation_code)->first();

        if ( ! $user){
            return View('errors.userDoesNotExist', [
                'email'=>$email,
                'confirmation_code'=>$confirmation_code,
            ]);
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        Auth::loginUsingId($user->id);
        return redirect("/");
    }
}
