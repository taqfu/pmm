<?php

namespace App;
use DateInterval;
use DateTime;

use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    //
    public static function check_in_user($user_id){
        $messages = Message::where('sent_at', null)->where('activated_at', '!=', null)->get();
        foreach($messages as $message){
            $new_check_in = new DateTime();
            if (substr($message->check_in_period, 1, 1)=="d"){
                $new_check_in
                  ->add(new DateInterval('P' . substr($message->check_in_period, 0, 1) . 'D'));
            } else if (substr($message->check_in_period, 1, 1)=="w"){
                $new_check_in
                  ->add(new DateInterval('P' . substr($message->check_in_period, 0, 1) . 'W'));
            }
            $message->check_in_due = $new_check_in->format("Y-m-d H:i:s");
            $message->save();
        }
    }
    public static function checkAll(){
        $messages = Message::where('check_in_due', '<', date( 'Y-m-d H:i:s'))->where('activated_at', '!=', null)->get();
        foreach($messages as $message){
            if ($message->ref_type=="email" && !Confirmation::need_to_confirm($message->id)){
                Email::sendOut($message);
            }
        }

    }
}
