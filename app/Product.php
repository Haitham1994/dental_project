<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";
    protected $fillable = ['cat_id','p_name','sale_price'];

    public function catogerys()
    {
        return $this->belongsTo(Catogery::class,'cat_id');
    }

    public function orderdatail()
    {
        return $this->belongsToMany(OrderDetail::class,'order_details');
    }
    
}
