<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peep extends Model
{
    public function peeps(){
        return $this->hasMany('App\mustafa','foreign_key','local_key','p_id');
    }
}
