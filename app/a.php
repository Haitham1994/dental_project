<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class a extends Model
{
    protected $table="as";
    public function agetfunction()
    {
        return $this->belongsTo(m::class, 'm_id');
        // return $this->belongsTo('App\m','m_id');
// }
// public function phone()
// {
//     return $this->hasOne(m::class);
// }
    }
}
