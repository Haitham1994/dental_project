<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pill extends Model
{
 protected $fillable=['b_id','cash','pull'];
 public function booking(){
    return $this->belongsTo('App\booking1','b_id');
}
}
