<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    public $table = "companies";
    protected $primaryKey = 'id';
    protected $fillable = [
        'company_name'
    ];

    public function order()
    {
        return $this->belongsTo('App\ProductOrder','product_orders','company_id');
    }

}