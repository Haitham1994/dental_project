<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diabeteshoistory extends Model
{
    public function bookingdiabeteshoistory(){
        return $this->belongsTo('App\booking1','b_id');
    }

     public function dia(){
        return $this->hasMany('App\mustafa','foreign_key','local_key','dia_id');
    }
}
