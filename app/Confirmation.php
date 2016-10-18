<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    public static function any($message_id){
        $message = Message::find($message_id);
        if (substr($message->confirm_period, 0, 1)==0){
            return false;
        }
        var_dump(Confirmation::where('message_id', $message_id)->orderBy('created_at', 'desc')->first());


    }
}
