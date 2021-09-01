<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patienhoistory extends Model
{
    public $table="patienhoistories";
    protected $fillable=['b_id','overblood'];
    
    public function bookingpatienfile()
    {
        return $this->belongsTo('App\booking1', 'b_id');
    }

    public function pnotes()
    {
        return $this->belongsTo('App\note', 'not_id');
    }

    public function pdia()
    {
        return $this->belongsTo('App\diabeteshoistory', 'dia_id');
    }

    public function pow()
    {
        return $this->belongsTo('App\owmanhoistory', 'ow_id');
    }

    public function peep()
    {
        return $this->belongsTo('App\peep', 'p_id');
    }

    // public function pow()
    // {
    //     return $this->belongsTo('App\diabeteshoistory', 'ow_id');
    // }
}