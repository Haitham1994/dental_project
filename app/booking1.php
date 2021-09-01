<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking1 extends Model
{
    // public $table="booking1s";
    protected $fillable=['do_name','p_name','p_gender','p_nation','p_address','p_age','p_job','p_doc',
                         'p_phone','p_datein','p_dateexit','p_day','p_wating','username','pull','dis',
                         'net','all_amount','relation_doc','docter','center','leftover','date'];

                         public function pill (){
                            return $this->hasMany('App\pill','foreign_key','local_key','b_id');
                        }

                        public function patienhoistory (){
                            return $this->hasMany('App\mustafa','foreign_key','local_key','b_id');
                        }
                        public function patienfile (){
                            return $this->hasMany('App\mustafa','foreign_key','local_key','b_id');
                        }
                        public function owmanhoistory (){
                            return $this->hasMany('App\mustafa','foreign_key','local_key','b_id');
                        }

                        public function note(){
                            return $this->hasMany('App\mustafa','foreign_key','local_key','b_id');
                        }
                        public function diabeteshoistory(){
                            return $this->hasMany('App\mustafa','foreign_key','local_key','b_id');
                        }

                        public function dental(){
                            return $this->hasMany('App\mustafa','foreign_key','local_key','b_id');
                        }



}

