<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expens extends Model
{
    protected $fillable = ['e_name','e_price','e_dec','e_date','username'];
}
