<?php

namespace App;

use Auth;
use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    public static function is_it_time_to_send_another($message, $last_confirmation){
        $date = new Datetime($last_confirmation->created_at);
        $now = new DateTime();
        if (substr($message->confirm_period, 1, 1)=="d"){
            $date->add(new DateInterval('P1D'));
        } else if (substr($message->confirm_period, 1, 1)=="w"){
            $date->add(new DateInterval('P1W'));
        }
        if($date<=$now){
            var_dump("A confirmation message needs to be sent. Please write code.");
            Auth::user()->confirmation++;
            return true;
        }
        return false;
    }
    public static function need_to_confirm($message_id){
        $message = Message::find($message_id);
        $last_confirmation = Confirmation::where('message_id', $message_id)
          ->orderBy('created_at', 'desc')->first();
        if ((substr($message->confirm_period, 0, 1)==0)
          || (substr($message->confirm_period, 0, 1)
          ==$last_confirmation->iteration)){
            return false;
        }
        if (Confirmation::is_it_time_to_send_another($message, $last_confirmation)){
            //Uncomment
            //Confirmation::send(Auth::user()->email);
            //$last_confirmation->iteration++;
            //$last_confirmation->save();
        }
    }
    public static function send($email){
        echo "Confirmation email sent!";
        Mail::send('email.confirmation', [], function ($m) use ($email) {
            $m->to($email, "Words Prevail")
              ->subject(Auth::user()->name . "! 
              Please check into Words Prevail before your messages are sent out.");
        });
    }
}
