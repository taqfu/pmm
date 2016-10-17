<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    //
    public static function checkAll(){
        $messages = Message::where('check_in_due', '<', date( 'Y-m-d H:i:s'))->get();
        foreach($messages as $message){
            if ($message->ref_type=="email"){
                Email::sendOut($message);
            }
        }

    }
}
