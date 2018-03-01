<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Mail;
use App\Mail\AutomaticEmail;
class Email extends Model
{
    public static function sendOut($message){
        $email = Email::find($message->ref_id);
        $user = User::find($email->user_id);
        Mail::to($email->send_to)->send(new AutomaticEmail($user, $email));

        $message = Message::find($message->id);
        $message->sent_at = date("Y-m-d H:i:s");
        $message->save();
    }
}
