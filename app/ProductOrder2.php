<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder2 extends Model
{
    public $table = "product_order2s";
    protected $primaryKey = 'id';
    protected $fillable = [
        'customer_name','order_total','user_id','order_code','order_date'
    ];

    public function productorderdetail2()
    {
        return $this->belongsToMany('App\OrderDetail2','order_detail2s','order_id','product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
