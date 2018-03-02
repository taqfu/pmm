<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Auth;
use DateTimeZone;
use Validator;
class UserController extends Controller
{
    public function checkInWithPin(Request $request, $id, $check_in_uuid){
        $user = User::find($id);
        if ($user==null || ($user!=null && ($user->check_in_uuid != $check_in_uuid || $user->public_check_in==0))){
            return "Sorry. There is nothing here.";
        }
        if ($request->pin == $user->pin){
            return view ("User.check-in-success");
        }
        return view('User.check-in-fail');

    }
    public function publicCheckIn($id, $check_in_uuid){
        $user = User::find($id);
        if ($user==null || ($user!=null && ($user->check_in_uuid != $check_in_uuid || $user->public_check_in==0))){
            return "Sorry. There is nothing here.";
        }
        if ($user->public_check_in==1){
            return view ("User.check-in-with-pin");
        }
        if ($user->public_check_in==2){
            return view ("User.check-in-success");
        }
    }

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
    public function updatePublicProfile(Request $request){
        $validator = Validator::make($request->all(), [
          'publicCheckIn' => 'required|integer|min:0|max:2',
        ]);
        if ($request->publicCheckIn == "1" && $request->pin !=NULL
          && (strlen($request->pin) != 4 || !is_numeric($request->pin))){
            return back()->withErrors(['pin'=>'Pin needs to be 4 numbers.']);
        }
        $user = User::find(Auth::user()->id);
        $user->public_check_in = $request->publicCheckIn;
        if ($request->publicCheckIn==0){
            $user->pin = null;
            $user->check_in_uuid = null;
            $user->save();
            return back();
        }
        if ($request->publicCheckIn == 1){
            $user->pin = $request->pin;
        }
        $user->check_in_uuid = uniqid();
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
