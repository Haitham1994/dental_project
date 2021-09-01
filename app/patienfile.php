<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patienfile extends Model

{
    protected $fillable=['b_id','imag'];
    public function bookingpatienfile(){
        return $this->belongsTo('App\booking1','b_id');
    }
}
