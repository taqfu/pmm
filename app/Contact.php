<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function infos(){
        return $this->belongsTo('App\ContactInfo');
    }
}
