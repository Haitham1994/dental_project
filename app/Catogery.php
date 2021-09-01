<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catogery extends Model
{
    public $table = "catogery";
    protected $primaryKey = 'id';
    protected $fillable = ['catogry_name'];
    public function products()
    {
        return $this->hasMany(Product::class,'cat_id');
    }
    public function check()
    {
        return $this->belongsTo('App\Check','checks','company_id');
    }
}
