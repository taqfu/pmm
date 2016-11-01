<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Mail;

class Email extends Model
{
    public static function sendOut($message){
        $email = Email::find($message->ref_id);
        Mail::send('email.template', ['body'=>$email->body], function ($m) use ($email) {
            $user = User::find($email->user_id);
            $m->to($email->send_to, $user->name . " c/o Words Prevail")
              ->subject('E-mail from ' . $user->name . " sent using Words Prevail");
            
        });
    }
}
