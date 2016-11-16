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
        var_dump(count($messages));
        foreach($messages as $message){
            $last_confirmation = Confirmation::fetch_last($message->id);
            if ($message->ref_type=="email" && !Confirmation::need_to_confirm($message->id) && Confirmation::is_it_time($message, $last_confirmation)){
                Email::sendOut($message);
            }
        }

    }

}
