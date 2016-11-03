<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function infos($id){
       return ContactInfo::where("contact_id", $id)->where('user_id', Auth::user()->id)->get(); 
    }
}
