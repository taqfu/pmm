<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use DateTime;
use DateInterval;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function check_in($id){
        $messages = Message::where('user_id', $id)->where('sent_at', null)->where('activated_at', '!=', null)->get();
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
            $confirmation=new Confirmation;
            $confirmation->message_id = $message->id;
            $confirmation->iteration = 0;
            $confirmation->created_at = date("Y-m-d H:i:s");
            $confirmation->save();
        }
    }
}
