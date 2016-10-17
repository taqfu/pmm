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
                $m->to($email->send_to, Auth::user()->name . "c/o Words Prevail")->subject('E-mail from ' . Auth::user()->name . " sent using Words Prevail");
        });
    }
}
