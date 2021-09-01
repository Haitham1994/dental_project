<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
protected $table="comments";
public function posts()
{
return $this->belongsTo(post::class);


}
}
