<?php

namespace App;

use Auth;
use DateInterval;
use DateTime;
use Mail;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    public static function is_it_time($message, $last_confirmation){
        $date = new Datetime($last_confirmation->created_at);
        $now = new DateTime();
        if (substr($message->confirm_period, 1, 1)=="d"){
            $date->add(new DateInterval('P1D'));
        } else if (substr($message->confirm_period, 1, 1)=="w"){
            $date->add(new DateInterval('P1W'));
        }
        if($date<=$now){
            $user = User::find($message->user_id);
            $user->confirmations++;
            $user->save();
            return true;
        }
        return false;
    }
    public static function daily(){
        $users = User::where('confirmations', '>', 0)->get();
        foreach($users as $user){
            Confirmation::send_multiple($user);
            $user->confirmations=0;
            $user->save();
        }
    }
    public static function need_to_confirm($message_id){
        $message = Message::find($message_id);
        $last_confirmation = Confirmation::where('message_id', $message_id)
          ->orderBy('created_at', 'desc')->first();
        if ((substr($message->confirm_period, 0, 1)==0)
          || (substr($message->confirm_period, 0, 1)
          ==$last_confirmation->iteration)){
            return false;
        } else if (substr($message->confirm_period, 0, 1)<$last_confirmation->iteration ) {
            var_dump("ERROR: too many confirmations");
        }
        if (Confirmation::is_it_time($message, $last_confirmation)){
            $confirmation = new Confirmation; 
            $confirmation->message_id = $message_id;
            $confirmation->iteration = $last_confirmation->iteration++;
            $confirmation->save();
        }
    }
        
    public static function send_multiple($user){
        echo "Confirmation email sent!";
        Mail::send('email.confirmation', 
          ['num_of_messages'=>$user->confirmations], 
          function ($m) use ($user) {
            $m->to($user->email, "Words Prevail")->subject($user->name . "! 
              Please log into Words Prevail before your messages are sent out.");
        });
    }
}
