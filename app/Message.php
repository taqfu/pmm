<?php

namespace App;
use DateInterval;
use DateTime;

use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    //

    public static function checkAll(){
        $messages = Message::where('check_in_due', '>', date( 'Y-m-d H:i:s'))->whereNotNull('activated_at')->get();
        foreach($messages as $message){
            if ($message->ref_type=="email" && !Confirmation::need_to_confirm($message->id)){                
                Email::sendOut($message);
            }
        }

    }
}
