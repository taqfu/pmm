<?php

namespace App;

use Auth;
use DateInterval;
use DateTime;
use Mail;
use \App\Mail\ConfirmationEmail;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    public static function has_it_been_more_than_an_hour_since_last_one($message_id){
        $last_confirmation = Confirmation::fetch_last($message_id);
        $date = new Datetime($last_confirmation->created_at);
        $now = new DateTime();
        $date->add(new DateInterval('PT1H'));
        if ($date<=$now){
            return true;
        }
        return false;

    }
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
    public static function fetch_last($message_id){
        return Confirmation::where('message_id', $message_id)
          ->orderBy('created_at', 'desc')->first();
    }
    public static function need_to_confirm($message_id){
        $message = Message::find($message_id);
        $last_confirmation = Confirmation::fetch_last($message_id);
        if ((substr($message->confirm_period, 0, 1)==0)
          || (substr($message->confirm_period, 0, 1)
          <=$last_confirmation->iteration)){
            return false;
        } else if (substr($message->confirm_period, 0, 1)<$last_confirmation->iteration ) {
            var_dump("ERROR: too many confirmations");
        }
        if (Confirmation::is_it_time($message, $last_confirmation)){
            $confirmation = new Confirmation;
            $confirmation->message_id = $message_id;
            $confirmation->iteration = $last_confirmation->iteration+1;
            $confirmation->save();
        }
        return true;
    }

    public static function send_multiple($user){
        $next_message = Message::fetch_next_message_going_out($user->id);
        if ($next_message==null){
            return;
        }
        $num_of_days = Message::fetch_num_of_days_until_msg_is_sent($next_message->id);
        Mail::to($user->email)->send(new ConfirmationEmail($user->confirmations, $next_message, $num_of_days, $user));

    }
}
