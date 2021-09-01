<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class labresult extends Model
{
    public $table="labresults";
    protected $fillable=['b_id','d_id','p_id'];

    public function bookinglabresult()
    {
        return $this->belongsTo('App\booking1', 'b_id');
    }

    public function dantellabresult()
    {
        return $this->belongsTo('App\booking1', 'd_id');
    }

    public function productlabresult()
    {
        return $this->belongsTo('App\booking1', 'p_id');
    }
}
