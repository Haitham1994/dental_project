<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Check extends Model
{
    use SoftDeletes;
    public $table = "checks";
    protected $primaryKey = 'id';
    protected $fillable = ['company_id','price','check_date'];
    protected $dates= ['deleted_at'];
    public function catogery()
    {
    return $this->belongsTo(Catogery::class);
    }

}
