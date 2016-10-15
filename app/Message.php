<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public state function checkAll(){
        var_dump(count(Message::where('check_in_due', '>', 0)->get()));

    }
}
