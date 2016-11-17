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
        'name', 'email', 'password', 'confirmation_code'
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
            $last_confirmation = Confirmation::fetch_last($message->id);
            if (Confirmation::has_it_been_more_than_an_hour_since_last_one($message->id)){
                $confirmation=new Confirmation;
                $confirmation->message_id = $message->id;
                $confirmation->iteration = 0;
                $confirmation->created_at = date("Y-m-d H:i:s");
                $confirmation->save();
            } else if ($last_confirmation->iteration==0){
                $last_confirmation->created_at = date("Y-m-d H:i:s");
                $last_confirmation->save();
            }
        }
    }
    public static function local_time($timezone, $timestamp){
        if ($timezone == Config::get('app.timezone')){
            return $timestamp;
        }
      $original_timezone = date("Z");
      date_default_timezone_set($timezone);
      $timezone = date("Z");
      date_default_timezone_set(Config::get('app.timezone'));
      return $timestamp - ($original_timezone-$timezone);
    }
    public static function local_now($date_format){
        if (Auth::user()->timezone == Config::get('app.timezone')){
            return date($date_format);
        }
        $original_timezone = date("Z");
        date_default_timezone_set(Auth::user()->timezone);
        $timezone = date("Z");
        date_default_timezone_set(Config::get('app.timezone'));
        return date($date_format, time() - ($original_timezone-$timezone));

    }
}
