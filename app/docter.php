<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docter extends Model
{
    protected $fillable = [
        'doc_name','doc_gender','doc_nation','doc_address','doc_age','doc_spec','doc_degree','doc_phone'
    ];
}
