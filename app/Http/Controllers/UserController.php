<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Auth;
use DateTimeZone;

class UserController extends Controller
{
    public function settings(){
        return View('User.settings');
    }
    public function updateEmail(Request $request){
        $this->validate($request, [
            'newEmail'=>'required|email'
        ]);
        $user = User::find(Auth::user()->id);
        $user->email = $request->newEmail;
        $user->save();
        return back();
    }
    public function updateName(Request $request){
        $this->validate($request, [
            'newName'=>'required|string'
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->newName;
        $user->save();
        return back();

    }
    public function updateTimeZone(Request $request){
        $this->validate($request, [
            'timezone'=>'required|string'
        ]);
        $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        $clear=false;
        foreach ($tzlist as $timezone){
            if ($timezone==$request->timezone){
                $clear=true;
            }
        }
        if($clear){
            $user = User::find(Auth::user()->id);
            $user->timezone = $request->timezone;
            $user->save();
            return back();
        } else {
            return back()->withErrors(["timezone"=>'This time zone does not exist.']);
        }
    }
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
        return redirect("/?verified=1");
    }
}
