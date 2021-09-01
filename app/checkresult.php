<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class checkresult extends Model
{
public $table="checkresults";
protected $fillable=['c_name','p_name','p_price','pull','date'];
}
