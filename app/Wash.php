<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wash extends Model
{
    protected $fillable = [
        'wash_type'
    ];

    public function orderdetails()
    {
        return $this->belongsTo('App\OrderDetails');
    }
}
