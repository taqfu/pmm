<?php

namespace App;
use Auth;
use DateInterval;
use DateTime;

use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    //
    public static function email_already_active($email_address){
        $messages = Message::whereNull('sent_at')->where('ref_type', 'email')
          ->where('user_id', Auth::user()->id)->get();
        foreach ($messages as $message){
            $email = Email::find($message->ref_id);
            if ($email->send_to==$email_address){
                return true;
            }
        }
        return false;
    }
    public static function checkAll(){
        $messages = Message::where('check_in_due', '<', date( 'Y-m-d H:i:s'))
          ->whereNull('sent_at')->get();
        foreach($messages as $message){
            $last_confirmation = Confirmation::fetch_last($message->id);
            if ($message->ref_type=="email" && !Confirmation::need_to_confirm($message->id) && Confirmation::is_it_time($message, $last_confirmation)){
                Email::sendOut($message);
            }
        }

    }
    public static function fetch_next_message_going_out($user_id){
        $next_message=null;
        $messages = Message::where('user_id', $user_id)->whereNull('sent_at')
          ->where('check_in_due', '<', date( 'Y-m-d H:i:s'))->get();
        foreach($messages as $message){
            $num_of_days = fetch_num_of_days_until_msg_is_sent($message->id);
            if (!isset($lowest_amount_of_time) || 
              $num_of_days<$lowest_amount_of_time){
                $lowest_amount_of_time = $num_of_days;
                $next_message = $message;
            }
        }
        return $next_message;
    }
    public static function fetch_num_of_days_until_msg_is_sent($id){
        $message = Message::find($id);
        $last_confirmation = Confirmation::fetch_last($id);
        $num_of_day_left_to_confirm = substr($message->confirm_period, 0, 1) 
          - $last_confirmation->iteration;
        $modifier=1;
        if (substring($message->confirm_period, 1, 1)=="w") {
            $modifier=7;
        }
        $num_of_days_left_to_confirm*=$modifier;
        return $num_of_days_left_to_confirm + $modifier;
        
        
        
    }
}
