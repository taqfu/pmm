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
            $m->from($user->email, $user->name)
              ->to($email->send_to)
              ->subject('E-mail from ' . $user->name . " sent using Words Prevail");
        });
        $message = Message::find($message->id);
        $message->sent_at = date("Y-m-d H:i:s");
        $message->save();
    }
}
