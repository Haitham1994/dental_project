<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'cat_name','depart_name','quntity','price'
    ];
}
