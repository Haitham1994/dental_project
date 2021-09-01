<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class owmanhoistory extends Model
{

     public function ows(){
        return $this->hasMany('App\mustafa','foreign_key','local_key','ow_id');
    }
}
