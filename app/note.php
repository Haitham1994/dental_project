<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{  public function note(){
    return $this->hasMany('App\mustafa','foreign_key','local_key','not_id');
}

}
