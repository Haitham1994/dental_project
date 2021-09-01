<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class workshop extends Model
{
public $table="workshops";
protected $fillable=['c_name','p_name','p_price','pull','quantity','date'];
}
