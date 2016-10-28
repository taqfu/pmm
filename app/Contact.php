<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function info(){
        return $this->belongsTo('App\ContactInfo');
    }
}
