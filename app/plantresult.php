<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class plantresult extends Model
{
    protected $fillable = ['pl_name','pl_doname','product_name','product_price','pl_relation','pl_reduction','pl_center','date'];

}
